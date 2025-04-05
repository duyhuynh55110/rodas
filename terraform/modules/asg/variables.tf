variable "environment" {
  type = string
}

variable "private_subnet_ids" {
  type = list(string)
}

// === Auto Scaling Group ===
variable "ami_id" {
  type = string
}
