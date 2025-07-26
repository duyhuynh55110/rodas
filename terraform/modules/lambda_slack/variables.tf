variable "function_name" {
  description = "Name of the Lambda function"
  type        = string
}

variable "slack_webhook_url" {
  description = "Slack webhook URL for sending notifications"
  type        = string
  sensitive   = true
}

variable "log_group_name" {
  description = "Name for log group which handle logging for this task definition"
  type        = string
}

variable "queue_arn" {
  description = "ARN of the SQS queue that triggers the Lambda function"
  type = string
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}

