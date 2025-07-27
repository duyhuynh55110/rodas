const zlib = require("zlib");
const util = require("util");
const {
    CloudWatchLogsClient,
    StartQueryCommand,
    GetQueryResultsCommand,
} = require("@aws-sdk/client-cloudwatch-logs");
const https = require("https");

// Promisify zlib.gunzip for async/await
const gunzip = util.promisify(zlib.gunzip);

// Initialize AWS CloudWatch Logs client
const logsClient = new CloudWatchLogsClient({ region: 'ap-southeast-1' });

// Configuration
const SLACK_WEBHOOK_URL = process.env.SLACK_WEBHOOK_URL;
const LOG_GROUP_NAME = process.env.LOG_GROUP_NAME;

// Parse and decode CloudWatch Logs subscription filter data from SQS message
async function getLogData(sqsMessage) {
    try {
        const subscriptionFilterData = JSON.parse(sqsMessage.body);

        if (!subscriptionFilterData.awslogs || !subscriptionFilterData.awslogs.data) {
            throw new Error("Invalid subscription filter structure: awslogs.data not found");
        }

        // Decode base64 and decompress gzip
        const compressedData = Buffer.from(subscriptionFilterData.awslogs.data, "base64");
        const decompressedData = await gunzip(compressedData);
        const logData = JSON.parse(decompressedData.toString("utf-8"));

        // Extract first log event to get requestId
        const logEvents = logData.logEvents || [];
        if (logEvents.length === 0) {
            throw new Error("No log events found");
        }

        // Parse message format: [time][requestId] message
        const firstEvent = logEvents[0];
        const message = firstEvent.message || "";
        const match = message.match(/^\[([^\]]+)\]\[([^\]]+)\]\s*(.*)$/);
        if (!match) {
            throw new Error("Log message format invalid");
        }

        return {
            logGroup: logData.logGroup || "Unknown",
            logStream: logData.logStream || "Unknown",
            timestamp: new Date(firstEvent.timestamp),
            requestId: match[2], // Extract requestId from [time][requestId] message
            message: match[3], // Extract actual message
        };
    } catch (error) {
        console.error("Error parsing log data:", error);
        throw new Error(`Failed to parse log data: ${error.message}`);
    }
}

// Query CloudWatch Logs Insights using requestId
async function queryLogsInsights(logData) {
    const startTime = new Date(logData.timestamp.getTime() - 5 * 60 * 1000); // 10 minutes before
    const endTime = new Date(logData.timestamp.getTime() + 5 * 60 * 1000); // 10 minutes after
    const queryParams = {
        queryString: `fields @message | filter @message like /${logData.requestId}/ | sort @timestamp desc | limit 50`,
        startTime: startTime.getTime(), // Convert to seconds
        endTime: endTime.getTime(), // Convert to seconds
        logGroupNames: [LOG_GROUP_NAME],
    };

    try {
        // Start the query
        const startQueryCommand = new StartQueryCommand(queryParams);
        const queryResponse = await logsClient.send(startQueryCommand);
        const queryId = queryResponse.queryId;
        if (!queryId) {
            throw new Error("Failed to start query: No queryId returned");
        }
        console.log("Query ID:", queryId);

        // Poll for query results
        let results;
        let attempts = 0;
        const maxAttempts = 30; // Increased to allow up to 90 seconds
        const pollInterval = 3000; // 3 seconds

        do {
            await new Promise((resolve) => setTimeout(resolve, pollInterval));
            const getQueryResultsCommand = new GetQueryResultsCommand({ queryId });
            results = await logsClient.send(getQueryResultsCommand);
            attempts++;

            if (results.status === "Complete") {
                break;
            } else if (results.status === "Failed" || results.status === "Cancelled") {
                throw new Error(`Query failed with status: ${results.status}`);
            }
        } while (attempts < maxAttempts);

        if (results.status !== "Complete") {
            throw new Error(`Query did not complete within ${maxAttempts * pollInterval / 1000} seconds`);
        }

        if (!results.results || results.results.length === 0) {
            console.warn("No log results found for queryId:", queryId);
            return [];
        }

        return results.results.map((row) => ({
            message: row.find((field) => field.field === "@message")?.value || "",
        }));
    } catch (error) {
        console.error("Error querying logs:", error);
        throw new Error(`Failed to query CloudWatch Logs Insights: ${error.message}`);
    }
}

// Format Slack message
function formatSlackMessage(logData, logEntries) {
    const logText =
        logEntries.length > 0
            ? "```\n" +
              logEntries.map((log) => log.message).join("\n") +
              "\n```"
            : "No related log entries found.";

    return {
        blocks: [
            {
                type: "section",
                text: {
                    type: "mrkdwn",
                    text: `*CloudWatch Log Event*\n*Log Group*: ${
                        logData.logGroup
                    }\n*Log Stream*: ${logData.logStream}\n*Request ID*: ${
                        logData.requestId
                    }\n*Timestamp*: ${logData.timestamp.toISOString()}`,
                },
            },
            {
                type: "section",
                text: {
                    type: "mrkdwn",
                    text: `*Recent Logs:*\n${logText}`,
                },
            },
        ],
    };
}

// Send message to Slack
async function sendToSlack(message) {
    return new Promise((resolve, reject) => {
        const request = https.request(
            SLACK_WEBHOOK_URL,
            {
                method: "POST",
                headers: { "Content-Type": "application/json" },
            },
            (res) => {
                if (res.statusCode === 200) {
                    resolve();
                } else {
                    reject(new Error(`Slack API error: ${res.statusCode}`));
                }
            }
        );

        request.on("error", (error) => {
            console.error("Error sending to Slack:", error);
            reject(new Error("Failed to send message to Slack"));
        });

        request.write(JSON.stringify(message));
        request.end();
    });
}

// Main Lambda handler
exports.handler = async (event) => {
    try {
        // Process each SQS message
        for (const record of event.Records) {
            // Parse and decode subscription filter data from SQS message
            const logData = await getLogData(record);

            // Query logs using requestId
            const logEntries = await queryLogsInsights(logData);

            // Format Slack message
            const slackMessage = formatSlackMessage(logData, logEntries);

            // Send to Slack
            await sendToSlack(slackMessage);
        }

        return {
            statusCode: 200,
            body: JSON.stringify({
                message: "Successfully processed SQS messages and sent to Slack",
            }),
        };
    } catch (error) {
        console.error("Lambda execution error:", error);
        return {
            statusCode: 500,
            body: JSON.stringify({ error: error.message }),
        };
    }
};
