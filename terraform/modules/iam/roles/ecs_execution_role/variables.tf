variable "name" {
  description = "The name for the ECS execution role"
  type        = string
}

variable "ecr_resource" {
  description = "A list of ECR repository ARNs to include in role policy."
  type        = list(string)
}

variable "log_group_resource" {
  description = "A list of CloudWatch ARNs to include in role policy."
  type        = list(string)
}