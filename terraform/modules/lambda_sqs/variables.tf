variable "function_name" {
  description = "Name of the Lambda function"
  type        = string
}

variable "queue_name" {
  description = "Name of queue which lambda function will send message to it"
  type        = string
}


variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}
