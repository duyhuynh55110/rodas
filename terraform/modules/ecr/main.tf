/*=========================================
      AWS Elastic Container Repository
==========================================*/

data "aws_ecr_repository" "ecr_repository" {
  name                 = var.name
}
