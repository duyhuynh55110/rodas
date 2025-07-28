variable "bucket_name" {
  description = "Name of the S3 bucket"
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to resources"
  type        = map(string)
  default     = {}
}

variable "allowed_origins" {
  description = "List of allowed origins for CORS"
  type        = list(string)
  default     = ["*"]
}

variable "ecs_task_role_arn" {
  description = "ARN of the ECS task role that needs access to the bucket"
  type        = string
}
