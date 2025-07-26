/*==============================================================
                CloudWatch Subscription Filter for ECS Error Logs
===============================================================*/

# Add permission for CloudWatch Logs to invoke the Lambda function
resource "aws_lambda_permission" "allow_cloudwatch" {
  statement_id  = "AllowExecutionFromCloudWatch"
  action        = "lambda:InvokeFunction"
  function_name = var.lambda_function_arn
  principal     = "logs.amazonaws.com"
  source_arn    = "${data.aws_cloudwatch_log_group.log_group.arn}:*"
}

# Create a CloudWatch subscription filter to detect ERROR logs
resource "aws_cloudwatch_log_subscription_filter" "error_logs_filter" {
  name            = var.filter_name
  log_group_name  = var.log_group_name
  filter_pattern  = var.filter_pattern
  destination_arn = var.lambda_function_arn
  distribution    = "ByLogStream"

  depends_on = [aws_lambda_permission.allow_cloudwatch]
}

data "aws_cloudwatch_log_group" "log_group" {
  name = var.log_group_name
}


