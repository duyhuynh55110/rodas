variable "filter_name" {
  description = "Name of the subscription filter"
  type        = string
  default     = "error-logs-filter"
}

variable "filter_pattern" {
  description = "The filter pattern to match in the logs"
  type        = string
  default     = "ERROR"
}

variable "log_group_name" {
  description = "The name of the CloudWatch log group to monitor"
  type        = string
}

variable "lambda_function_arn" {
  description = "ARN of the Lambda function to trigger when ERROR logs are detected"
  type        = string
}
