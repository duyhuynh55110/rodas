variable "name" {
  description = "Name prefix for the RDS resources"
  type        = string
}

variable "allocated_storage" {
  description = "The allocated storage in gigabytes"
  type        = number
  default     = 20
}

variable "storage_type" {
  description = "The type of storage to use"
  type        = string
  default     = "gp2"
}

variable "engine" {
  description = "The database engine to use"
  type        = string
  default     = "mysql"
}

variable "engine_version" {
  description = "The engine version to use"
  type        = string
  default     = "8.0"
}

variable "instance_class" {
  description = "The instance type of the RDS instance"
  type        = string
  default     = "db.t3.micro"
}

variable "replica_instance_class" {
  description = "The instance type of the RDS replica instance"
  type        = string
  default     = "db.t3.micro"
}

# ------- Connection information -------
variable "database_name" {
  description = "The name of the database to create"
  type        = string
}

variable "username" {
  description = "Username for the master DB user"
  type        = string
  sensitive   = true
}

variable "password" {
  description = "Password for the master DB user"
  type        = string
  sensitive   = true
}

variable "parameter_group_family" {
  description = "The family of the DB parameter group"
  type        = string
  default     = "mysql8.0"
}

variable "subnet_ids" {
  description = "A list of VPC subnet IDs for the DB subnet group"
  type        = list(string)
}

variable "security_group_id" {
  description = "The ID of the security group for the RDS instance"
  type        = string
}

variable "skip_final_snapshot" {
  description = "Determines whether a final DB snapshot is created before the DB instance is deleted"
  type        = bool
  default     = true
}

variable "deletion_protection" {
  description = "If the DB instance should have deletion protection enabled"
  type        = bool
  default     = false
}

variable "backup_retention_period" {
  description = "The days to retain backups for"
  type        = number
  default     = 7
}

variable "primary_availability_zone" {
  description = "The AZ where the primary instance will be created"
  type        = string
}

variable "replica_availability_zone" {
  description = "The AZ where the replica instance will be created"
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(string)
  default     = {}
}

variable "app_env" {
  description = "Application environment (prod, dev, staging, etc.)"
  type        = string
}
