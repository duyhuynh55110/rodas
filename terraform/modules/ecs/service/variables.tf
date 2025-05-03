variable "name" {
  description = "Name of the service"
  type        = string
}

variable "ecs_cluster_id" {
  description = "Cluster ID which will host the service"
  type        = string
}

variable "task_definition_arn" {
  description = "The ARN of the task definition"
  type        = string
}

variable "desired_count" {
  description = "Number of instances of the task definition to place and keep running"
  type        = string
}

# ------- Network configuration -------
variable "security_group_arn" {
  description = "Network configuration for the service"
  type        = string
}

variable "subnet_ids" {
  description = "Subnets associated with the task or service"
  type        = list(string)
}

# ------- Load Balancer setting -------
variable "target_group_arn" {
  description = "The full ARN of the target group or groups associated with the VPC Lattice configuration"
  type        = string
}

variable "container_name" {
  description = "The name of the container"
  type        = string
}

variable "container_port" {
  description = "value of the container port"
  type        = string
}
