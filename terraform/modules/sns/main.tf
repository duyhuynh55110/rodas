/*==============================================================
                SNS Topic for CloudWatch Alarm Notifications
===============================================================*/

resource "aws_sns_topic" "alarm_notifications" {
  name = var.topic_name
  tags = var.common_tags
}

resource "aws_sns_topic_subscription" "lambda_subscription" {
  topic_arn = aws_sns_topic.alarm_notifications.arn
  protocol  = "lambda"
  endpoint  = var.lambda_function_arn
}

# Add permission for SNS to invoke the Lambda function
resource "aws_lambda_permission" "allow_sns" {
  statement_id  = "AllowExecutionFromSNS"
  action        = "lambda:InvokeFunction"
  function_name = var.lambda_function_name
  principal     = "sns.amazonaws.com"
  source_arn    = aws_sns_topic.alarm_notifications.arn
}