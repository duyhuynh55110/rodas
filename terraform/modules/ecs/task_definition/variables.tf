variable "family" {
  description = "A unique name for your task definition."
  type        = string
}

variable "cpu" {
  description = "The CPU value to assign to the container, read AWS documentation for available values"
  type        = number

  validation {
    condition     = var.cpu >= 256
    error_message = "CPU value must be at least 256."
  }
}

variable "memory" {
  description = "The MEMORY value to assign to the container, read AWS documentation to available values"
  type        = number

  validation {
    condition     = var.memory >= 512
    error_message = "MEMORY value must be at least 512."
  }
}

variable "execution_role_arn" {
  description = "ARN of the task execution role that the Amazon ECS container agent and the Docker daemon can assume."
  type        = string
}

variable "task_role_arn" {
  description = "ARN of IAM role that allows your Amazon ECS container task to make calls to other AWS services."
  type        = string
  default     = null
}

# ------- Server container setting -------
variable "server_image_uri" {
  description = "Image Uri for Server container"
  type        = string
}

variable "server_container_name" {
  description = "Name for Server container"
  type        = string
}

# ------- Admin application container setting -------
variable "admin_image_uri" {
  description = "Image Uri for Admin app container"
  type        = string
}

variable "admin_container_name" {
  description = "Name for Admin app container"
  type        = string
}
