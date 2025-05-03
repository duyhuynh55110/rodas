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

variable "aws_profile" {
  description = "The AWS profile to use"
  type        = string
}
