variable "queue_name" {
  description = "Name of the SQS queue"
  type = string
}

variable "delay_seconds" {
  description = "Time in seconds that the delivery of all messages in the queue will be delayed"
  type = string
  default = 0
}

variable "max_message_size" {
  description = "Maximum message size in bytes (1024 bytes to 262144 bytes)"
  type = number
  default = 2048
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}
