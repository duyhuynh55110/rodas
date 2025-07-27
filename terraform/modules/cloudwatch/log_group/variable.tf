variable "name" {
  description = "The name of the CloudWatch log group which is handle logging ecs containers"
  type        = string
}

variable "retention_in_days" {
  description = "Specifies the number of days you want to retain log events in the specified log group"
  type = number
  default = 30
}
