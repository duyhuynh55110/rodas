variable "family" {
  description = "A unique name for your task definition."
  type        = string
}

variable "log_group_name" {
  description = "name for log group which handle logging for this task definition"
  type        = string
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

# ------- Server container setting -------
variable "server_image_uri" {
  description = "Image Uri for Server container"
  type        = string
}

variable "server_container_name" {
  description = "Name for Server container"
  type        = string
}

variable "server_container_cpu" {
  description = "The CPU value to assign to the server container"
  type        = number
  default     = 128
}

variable "server_container_memory" {
  description = "The memory value to assign to the server container"
  type        = number
  default     = 128
}

variable "server_container_memory_reservation" {
  description = "The memory reservation value to assign to the server container"
  type        = number
  default     = 128
}

variable "server_container_port" {
  description = "The container port for the server"
  type        = number
}

variable "server_host_port" {
  description = "The host port for the server"
  type        = number
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

variable "admin_container_cpu" {
  description = "The CPU value to assign to the admin container"
  type        = number
  default     = 128
}

variable "admin_container_memory" {
  description = "The memory value to assign to the admin container"
  type        = number
  default     = 256
}

variable "admin_container_memory_reservation" {
  description = "The memory reservation value to assign to the admin container"
  type        = number
  default     = 256
}

variable "admin_container_port" {
  description = "The container port for the admin application"
  type        = number
  default     = 9000
}

# ------- Environment settings -------
variable "region" {
  description = "AWS region for the resources"
  type        = string
}

variable "allow_ecs_exec" {
  description = "Whether to allow ECS execute command functionality"
  type        = bool
  default     = false
}

# ------- Parameter Store settings -------
variable "app_name" {
  description = "Application name used for parameter store paths"
  type        = string
}

variable "app_env" {
  description = "Environment name used for parameter store paths"
  type        = string
}

variable "account_id" {
  description = "AWS account ID for constructing ARNs"
  type        = string
}

# ------- Database settings -------
variable "db_host" {
  description = "Database host"
  type        = string
}

variable "db_port" {
  description = "Database port"
  type        = string
}

variable "db_name" {
  description = "Database name"
  type        = string
}

# ------- S3 settings -------
variable "s3_bucket_name" {
  description = "S3 bucket name for application storage"
  type        = string
}
