/*===========================
     Terraform variables
============================*/

variable "app_name" {
  description = "The name of the application"
  type        = string
}

variable "app_env" {
  description = "The environment of the application"
  type        = string
}

variable "aws_region" {
  description = "The AWS region"
  type        = string
}

# ------- Networking -------
variable "vpc_cidr" {
  description = "CIDR block for the VPC (e.g., 10.0.0.0/16)"
  type        = string
}

# ------- Security Group -------
variable "public_access_cidr" {
  description = "List of CIDR blocks allowed to access the public ALB (typically 0.0.0.0/0 for public access)"
  type        = list(string)
}

variable "admin_restricted_cidr" {
  description = "List of CIDR blocks with restricted access to admin resources (typically your own IP address)"
  type        = list(string)
}

variable "ssh_ingress_port" {
  description = "Port on which the SSH ingress rule will be applied"
  type        = number
  default     = 22
}
# ------- ALB configuration -------
variable "alb_ingress_port" {
  description = "Port on which the ALB will accept incoming (80: HTTP, 443: HTTPS)"
  type        = number
}

# ------- ECS configuration -------
variable "ecs_task_cpu" {
  description = "CPU units for the ECS task"
  type        = number
}

variable "ecs_task_memory" {
  description = "Memory for the ECS task in MiB"
  type        = number
}

variable "server_min_capacity" {
  description = "Minimum capacity for ECS autoscaling"
  type        = number
}

variable "server_max_capacity" {
  description = "Maximum capacity for ECS autoscaling"
  type        = number
}

variable "server_container_name" {
  description = "Name for the server container"
  type        = string
  default     = "rodas-server"
}

variable "admin_container_name" {
  description = "Name for the admin container"
  type        = string
  default     = "rodas-admin"
}

variable "allow_ecs_exec" {
  description = "Whether to allow ECS execute command functionality"
  type        = bool
}

variable "bastion_key_name" {
  description = "SSH key name to use for the bastion host"
  type        = string
}

/*===========================
     Environment variables. Use for Terraform runtime environment.
============================*/
variable "APP_KEY" {
  description = "It serves as a cryptographic key used by Laravel for secure data encryption and decryption"
  type        = string
}

# ------- Database configuration -------
variable "DB_PORT" {
  description = "Port on which the database accepts connections"
  type        = number
  default     = 3306
}

variable "DB_NAME" {
  description = "The name of the database"
  type        = string
  default     = "rodas"
}

variable "DB_USERNAME" {
  description = "Username for the database"
  type        = string
  sensitive   = true
}

variable "DB_PASSWORD" {
  description = "Password for the database"
  type        = string
  sensitive   = true
}
