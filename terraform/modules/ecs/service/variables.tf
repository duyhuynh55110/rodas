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

variable "enable_execute_command" {
  description = "Whether to enable Amazon ECS Exec for the tasks within the service."
  type = bool
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
  description = "ARN of the Load Balancer target group to associate with the service"
  type        = string
}

variable "container_name" {
  description = "Name of the container to associate with the load balancer (as it appears in a container definition)"
  type        = string
}

variable "container_port" {
  description = "Port on the container to associate with the load balancer"
  type        = string
}
