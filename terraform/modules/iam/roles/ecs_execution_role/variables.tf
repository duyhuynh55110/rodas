variable "name" {
  description = "The name for the ECS execution role"
  type        = string
}

variable "ecr_resource" {
  description = "value"
  type        = list(string)
}
