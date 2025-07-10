variable "name" {
  description = "Name of the Load Balancer."
  type        = string
}

variable "load_balancer_type" {
  description = "Type of load balancer to create. Possible values are application, gateway, or network. The default value is application."
  type        = string
}

variable "ingress_port" {
  description = "The port on which the load balancer is listening"
  type        = number
}

variable "security_group_id" {
  description = "Security group IDs"
  type        = string
}

variable "subnet_ids" {
  description = "Public subnet IDs"
  type        = list(string)
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}

# ------- Target Group setting -------
variable "vpc_id" {
  description = "VPC ID"
  type        = string
}

variable "certificate_arn" {
  description = "ARN of the SSL certificate for HTTPS listener"
  type        = string
}
