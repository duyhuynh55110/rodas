variable "environment" {
  description = "Environment name (e.g., dev, test)"
  type        = string
}

variable "vpc_cidr" {
    description = "VPC CIDR block"
    type        = string
}

variable "private_subnet_count" {
    description = "Number of private subnets to create"
    type        = number
    default     = 2
}

variable "public_subnet_count" {
    description = "Number of public subnets to create"
    type        = number
    default     = 2
}
