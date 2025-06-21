variable "name" {
  description = "The name for the ECS execution role"
  type        = string
}

variable "ecr_resources" {
  description = "A list of ECR repository ARNs to include in role policy."
  type        = list(string)
}

variable "log_group_resources" {
  description = "A list of CloudWatch ARNs to include in role policy."
  type        = list(string)
}

variable "parameter_store_resources" {
  description = "A list of Parameter Store ARNs to include in role policy."
  type        = list(string)
  default     = []
}
