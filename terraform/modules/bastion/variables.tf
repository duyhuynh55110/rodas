variable "ami" {
  description = "AMI ID to use for EC2 instance"
  type        = string
  default     = "ami-04173560437081c75"
}

variable "instance_type" {
  description = "Type of EC2 instance to create"
  type        = string
  default     = "t3.micro"
}

variable "subnet_id" {
  description = "ID of the public subnet where the EC2 instance will be launched"
  type        = string
}

variable "key_name" {
  description = "Name of the SSH key pair to use for EC2 instance"
  type        = string
}

variable "security_group_ids" {
  description = "List of security group IDs to associate with the EC2 instance"
  type        = list(string)
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}
