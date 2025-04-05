variable "environment" {
  description = "Environment name (e.g., dev, test)"
  type        = string
}

variable "security_group_id" {
  description = "Security group ID"
  type        = string
}

variable "vpc_id" {
  description = "VPC ID"
  type        = string
}

variable "public_subnet_ids" {
  description = "Public subnet IDs"
  type        = list(string)
}

