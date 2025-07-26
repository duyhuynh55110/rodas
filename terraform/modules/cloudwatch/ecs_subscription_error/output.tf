output "subscription_filter_name" {
  description = "The name of the CloudWatch subscription filter"
  value       = aws_cloudwatch_log_subscription_filter.error_logs_filter.name
}

output "subscription_filter_id" {
  description = "The ID of the CloudWatch subscription filter"
  value       = aws_cloudwatch_log_subscription_filter.error_logs_filter.id
}
