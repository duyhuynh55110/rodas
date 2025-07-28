/*===========================
      RDS Module
============================*/

resource "aws_db_subnet_group" "rds_subnet_group" {
  name       = "${var.name}-subnet-group"
  subnet_ids = var.subnet_ids

  tags = merge(
    var.common_tags,
    {
      Name = "${var.name}-subnet-group"
    }
  )
}

resource "aws_db_parameter_group" "rds_parameter_group" {
  name   = "${var.name}-parameter-group"
  family = var.parameter_group_family

  tags = merge(
    var.common_tags,
    {
      Name = "${var.name}-parameter-group"
    }
  )
}

resource "aws_db_instance" "primary" {
  identifier             = "${var.name}-primary"
  allocated_storage      = var.allocated_storage
  storage_type           = var.storage_type
  engine                 = var.engine
  engine_version         = var.engine_version
  instance_class         = var.instance_class
  db_name                = var.database_name
  username               = var.username
  password               = var.password
  parameter_group_name   = aws_db_parameter_group.rds_parameter_group.name
  db_subnet_group_name   = aws_db_subnet_group.rds_subnet_group.name
  vpc_security_group_ids = [var.security_group_id]
  availability_zone      = var.primary_availability_zone
  multi_az               = false
  skip_final_snapshot    = var.skip_final_snapshot
  deletion_protection    = var.deletion_protection
  backup_retention_period = var.backup_retention_period
  
  tags = merge(
    var.common_tags,
    {
      Name = "${var.name}-primary"
    }
  )
}

resource "aws_db_instance" "replica" {
  count                  = var.app_env == "prod" ? 1 : 0
  identifier             = "${var.name}-replica"
  instance_class         = var.replica_instance_class
  replicate_source_db    = aws_db_instance.primary.identifier
  vpc_security_group_ids = [var.security_group_id]
  availability_zone      = var.replica_availability_zone
  skip_final_snapshot    = var.skip_final_snapshot
  
  tags = merge(
    var.common_tags,
    {
      Name = "${var.name}-replica"
    }
  )
}