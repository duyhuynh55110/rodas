variable "name" {
  description = "Name of the Load Balancer."
  type        = string
}

variable "load_balancer_type" {
  description = "Type of load balancer to create. Possible values are application, gateway, or network. The default value is application."
  type        = string
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
  description = "ARN of the default SSL server certificate. Exactly one certificate is required if the protocol is HTTPS"
  type        = string
}
