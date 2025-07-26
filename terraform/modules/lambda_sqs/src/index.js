const { SQSClient, SendMessageCommand } = require("@aws-sdk/client-sqs");

const sqs = new SQSClient({});
const QUEUE_URL = process.env.QUEUE_URL;

exports.handler = async (event) => {
    try {
        const messageBody = JSON.stringify(event);

        const params = {
            QueueUrl: QUEUE_URL,
            MessageBody: messageBody,
            DelaySeconds: 60, // Log Insight have a delay in displaying logs after they are ingested. That why should delay before trigger
        };

        await sqs.send(new SendMessageCommand(params));
        console.log("Message sent to SQS");

        return { statusCode: 200, body: "OK" };
    } catch (error) {
        console.error("Failed to send message to SQS", error);
        throw error;
    }
};
