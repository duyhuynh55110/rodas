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
  description = "name for log group which handle logging for this task definition"
  type        = string
}

variable "tags" {
  description = "A map of tags to add to all resources"
  type        = map(string)
  default     = {}
}
