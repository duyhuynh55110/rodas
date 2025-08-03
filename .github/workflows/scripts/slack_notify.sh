#!/bin/bash

send_slack_notification() {
  local color=$1
  local emoji=$2
  local status_text=$3
  local additional_text=${4:-}

  curl -X POST -H 'Content-type: application/json' --data @- "$SLACK_WEBHOOK_URL" <<EOF
{
  "attachments": [
    {
      "color": "$color",
      "blocks": [
        {
          "type": "header",
          "text": {
            "type": "plain_text",
            "text": "$emoji Deployment $status_text",
            "emoji": true
          }
        },
        {
          "type": "section",
          "fields": [
            { "type": "mrkdwn", "text": "*Application:*\nRodas" },
            { "type": "mrkdwn", "text": "*Environment:*\n${APP_ENV}" },
            { "type": "mrkdwn", "text": "*Branch:*\n${GITHUB_REF_NAME}" },
            { "type": "mrkdwn", "text": "*Commit:*\n${GITHUB_SHA}" },
            { "type": "mrkdwn", "text": "*Status:*\n${additional_text}" }
          ]
        },
        {
          "type": "context",
          "elements": [
            {
              "type": "mrkdwn",
              "text": ":hourglass_flowing_sand: *View details:* <${GITHUB_SERVER_URL}/${GITHUB_REPOSITORY}/actions/runs/${GITHUB_RUN_ID}|Run #${GITHUB_RUN_ID}>"
            }
          ]
        }
      ]
    }
  ]
}
EOF
}
