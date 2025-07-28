/*==============================================================
                Lambda Function send message to queue
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

# Allow lambda send message to SQS queue
resource "aws_iam_policy" "lambda_send_sqs" {
  name        = "${var.function_name}-send-sqs"
  description = "Policy for Lambda to access SQS"

  policy = jsonencode({
    Version = "2012-10-17",
    Statement = [
      {
        Effect   = "Allow",
        Action   = "sqs:SendMessage",
        Resource = [data.aws_sqs_queue.queue.arn]
      },
    ]
  })

  tags = merge(
    var.common_tags,
    {
      Name = "${var.function_name}-send-sqs"
    }
  )
}

# Attach the policy to the IAM role
resource "aws_iam_role_policy_attachment" "lambda_logs_policy_attachment" {
  role       = aws_iam_role.lambda_exec_role.name
  policy_arn = aws_iam_policy.lambda_send_sqs.arn
}

# Attach the policy to the IAM role
resource "aws_lambda_function" "lambda_enqueue" {
  function_name = var.function_name
  description   = "Lambda function send message to queue"
  role          = aws_iam_role.lambda_exec_role.arn
  handler       = "index.handler"
  runtime       = "nodejs20.x"
  timeout       = 30
  memory_size   = 128

  filename         = data.archive_file.lambda_zip.output_path
  source_code_hash = data.archive_file.lambda_zip.output_base64sha256

  environment {
    variables = {
      QUEUE_URL = data.aws_sqs_queue.queue.url
    }
  }
}

# Lambda code packaging
data "archive_file" "lambda_zip" {
  type        = "zip"
  source_dir  = "${path.module}/src"                    # Directory containing index.js, node_modules, etc.
  output_path = "${path.module}/src/send-error-sqs.zip" # Specifies where the new ZIP file will be created.
  excludes    = ["send-error-sqs.zip"]                  # Exclude the existing ZIP to avoid duplication
}

data "aws_sqs_queue" "queue" {
  name = var.queue_name
}
