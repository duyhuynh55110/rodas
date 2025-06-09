output "primary_endpoint" {
  description = "The endpoint of the primary database"
  value       = aws_db_instance.primary.endpoint
  sensitive   = true
}

output "primary_address" {
  description = "The hostname of the primary database instance"
  value       = aws_db_instance.primary.address
  sensitive   = true
}

output "primary_port" {
  description = "The port of the primary database"
  value       = aws_db_instance.primary.port
}

output "primary_name" {
  description = "The database name"
  value       = aws_db_instance.primary.db_name
  sensitive   = true
}

output "primary_username" {
  description = "The master username for the database"
  value       = aws_db_instance.primary.username
  sensitive   = true
}

output "replica_endpoint" {
  description = "The endpoint of the replica database"
  value       = aws_db_instance.replica.endpoint
  sensitive   = true
}

output "replica_address" {
  description = "The hostname of the replica database instance"
  value       = aws_db_instance.replica.address
  sensitive   = true
}

output "db_subnet_group_name" {
  description = "The name of the DB subnet group"
  value       = aws_db_subnet_group.rds_subnet_group.name
}