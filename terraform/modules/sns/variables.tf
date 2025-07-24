variable "topic_name" {
  description = "Name of the SNS topic"
  type        = string
}

variable "lambda_function_arn" {
  description = "ARN of the Lambda function to subscribe to the SNS topic"
  type        = string
}

variable "lambda_function_name" {
  description = "Name of the Lambda function to subscribe to the SNS topic"
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to resources"
  type        = map(string)
  default     = {}
}