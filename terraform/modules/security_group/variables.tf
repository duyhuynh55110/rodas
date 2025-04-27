variable "name" {
  description = "Name of the security group."
  type        = string

  validation {
    condition     = can(regex(".*-sg$", var.name))
    error_message = "The 'name' must end with '-sg'."
  }
}

variable "description" {
  description = "Security group description"
  type        = string
}

variable "vpc_id" {
  description = "The ID of the VPC where the security group will take place"
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}

# ------- Ingress setting -------
variable "ingress_port" {
  description = "Number of the port to open in the ingress rules"
  type        = number
}

variable "security_groups" {
  description = "List of security group Group Names if using EC2-Classic, or Group IDs if using a VPC"
  type        = list(any)
  default     = null
}

variable "cidr_blocks_ingress" {
  description = "An ingress block of CIDR to grant access to"
  type        = list(any)
  default     = null
}

# ------- Egress setting -------
variable "egress_port" {
  description = "Number of the port to open in the egress rules"
  type        = number
  default     = 0
}

variable "cidr_blocks_egress" {
  description = "An ingress block of CIDR to grant access to"
  type        = list(any)
  default     = ["0.0.0.0/0"]
}
