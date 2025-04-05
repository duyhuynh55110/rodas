variable "environment" {
  description = "The environment name (e.g., dev, prod)"
  type        = string
}

variable "aws_region" {
  description = "The AWS region"
  type        = string
}

variable "aws_profile" {
  description = "The AWS profile to use"
  type        = string
}
