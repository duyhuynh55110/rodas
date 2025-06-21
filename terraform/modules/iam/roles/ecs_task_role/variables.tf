variable "name" {
  description = "The name for the ECS task role"
  type        = string
}

variable "allow_ecs_exec" {
  description = "Provide SSM in case this environment allow ECS execute command functionality"
  type        = bool
}
