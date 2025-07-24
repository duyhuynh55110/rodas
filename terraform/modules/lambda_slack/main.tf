/*==============================================================
                Lambda Function for Slack Notifications
===============================================================*/

# IAM Role for Lambda
resource "aws_iam_role" "lambda_role" {
  name = "${var.function_name}-role"

  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Action = "sts:AssumeRole"
      Effect = "Allow"
      Principal = {
        Service = "lambda.amazonaws.com"
      }
    }]
  })

  tags = var.tags
}

# Define the IAM policy for CloudWatch Logs access
resource "aws_iam_policy" "lambda_logs_policy" {
  name        = "lambda-ecs-logs-policy"
  description = "Policy for Lambda to access CloudWatch Logs for ECS log groups"

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Effect = "Allow"
        Action = [
          "logs:StartQuery",
          "logs:GetQueryResults"
        ]
        # Resource = "arn:aws:logs:*:*:log-group:ecs/task-definition-server:*"
        Resource = "*"
      },
    ]
  })
}

# Attach the policy to the IAM role
resource "aws_iam_role_policy_attachment" "lambda_logs_policy_attachment" {
  role       = aws_iam_role.lambda_role.name
  policy_arn = aws_iam_policy.lambda_logs_policy.arn
}

# IAM Policy for Lambda basic execution
resource "aws_iam_role_policy_attachment" "lambda_basic" {
  role       = aws_iam_role.lambda_role.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AWSLambdaBasicExecutionRole"
}

# Lambda Function
resource "aws_lambda_function" "slack_notification" {
  function_name = var.function_name
  description   = "Lambda function to send notifications to Slack"
  role          = aws_iam_role.lambda_role.arn
  handler       = "index.handler"
  runtime       = "nodejs20.x"
  timeout       = 30
  memory_size   = 128

  filename         = data.archive_file.lambda_zip.output_path
  source_code_hash = data.archive_file.lambda_zip.output_base64sha256

  environment {
    variables = {
      SLACK_WEBHOOK_URL = var.slack_webhook_url
      LOG_GROUP_NAME = var.log_group_name
    }
  }

  tags = var.tags
}

# Lambda code packaging
data "archive_file" "lambda_zip" {
  type        = "zip"
  source_dir  = "${path.module}/src" # Directory containing index.js, node_modules, etc.
  output_path = "${path.module}/src/app-error-notifier.zip" # Specifies where the new ZIP file will be created.
  excludes    = ["app-error-notifier.zip"] # Exclude the existing ZIP to avoid duplication
}
