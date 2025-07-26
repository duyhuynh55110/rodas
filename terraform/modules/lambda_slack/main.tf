/*==============================================================
                Lambda Function for Slack Notifications
===============================================================*/

# IAM Role for Lambda
resource "aws_iam_role" "lambda_exec_role" {
  name = "${var.function_name}-exec-role"

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

  tags = merge(
    var.common_tags,
    {
      Name = "${var.function_name}-exec-role"
    }
  )
}

# IAM Policy for Lambda basic execution
resource "aws_iam_role_policy_attachment" "lambda_basic" {
  role       = aws_iam_role.lambda_exec_role.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AWSLambdaBasicExecutionRole"
}

# Allow lambda access CloudWatch logs
resource "aws_iam_policy" "lambda_logs_policy" {
  name        = "${var.function_name}-log-policy"
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
        Resource = [
          "${data.aws_cloudwatch_log_group.log_group.arn}:*"
        ]
      },
    ]
  })

  tags = merge(
    var.common_tags,
    {
      Name = "${var.function_name}-log-policy"
    }
  )
}

# Attach the policy to the IAM role
resource "aws_iam_role_policy_attachment" "lambda_logs_policy_attachment" {
  role       = aws_iam_role.lambda_exec_role.name
  policy_arn = aws_iam_policy.lambda_logs_policy.arn
}

# IAM Policy for SQS access
resource "aws_iam_policy" "lambda_sqs_policy" {
  name        = "${var.function_name}-sqs-policy"
  description = "Policy for Lambda to access SQS queue"

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Effect = "Allow"
        Action = [
          "sqs:ReceiveMessage",
          "sqs:DeleteMessage",
          "sqs:GetQueueAttributes"
        ]
        Resource = var.queue_arn
      }
    ]
  })

  tags = merge(
    var.common_tags,
    {
      Name = "${var.function_name}-sqs-policy"
    }
  )
}

# Attach SQS policy to the IAM role
resource "aws_iam_role_policy_attachment" "lambda_sqs_policy_attachment" {
  role       = aws_iam_role.lambda_exec_role.name
  policy_arn = aws_iam_policy.lambda_sqs_policy.arn
}

# Lambda Function
resource "aws_lambda_function" "slack_notification" {
  function_name = var.function_name
  description   = "Lambda function to send notifications to Slack"
  role          = aws_iam_role.lambda_exec_role.arn
  handler       = "index.handler"
  runtime       = "nodejs20.x"
  timeout       = 30
  memory_size   = 128

  filename         = data.archive_file.lambda_zip.output_path
  source_code_hash = data.archive_file.lambda_zip.output_base64sha256

  environment {
    variables = {
      SLACK_WEBHOOK_URL = var.slack_webhook_url
      LOG_GROUP_NAME    = var.log_group_name
    }
  }
}

# Lambda code packaging
data "archive_file" "lambda_zip" {
  type        = "zip"
  source_dir  = "${path.module}/src"                        # Directory containing index.js, node_modules, etc.
  output_path = "${path.module}/src/app-error-notifier.zip" # Specifies where the new ZIP file will be created.
  excludes    = ["app-error-notifier.zip"]                  # Exclude the existing ZIP to avoid duplication
}

# Detect when queue have new message and trigger to lambda
resource "aws_lambda_event_source_mapping" "sqs_trigger" {
  event_source_arn = var.queue_arn
  function_name    = aws_lambda_function.slack_notification.arn
  batch_size       = 1
}

data "aws_cloudwatch_log_group" "log_group" {
  name = var.log_group_name
}
