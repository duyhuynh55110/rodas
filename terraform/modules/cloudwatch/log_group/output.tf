output "log_group_arn" {
  description = "The ARN of the CloudWatch log group."
  value = aws_cloudwatch_log_group.log_group.arn
}

output "log_group_name" {
  description = "The name of the CloudWatch log group."
  value = aws_cloudwatch_log_group.log_group.name
}