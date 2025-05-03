/*===========================
          Root file
============================*/

# ------- Prepare data -------
data "aws_availability_zones" "available" {
  state = "available"
}

locals {
  availability_zones = slice(data.aws_availability_zones.available.names, 0, 2)

  common_tags = {
    Environment = var.app_env
    Application = var.app_name
  }
}

# ------- Networking -------
module "networking" {
  source = "./modules/networking"

  vpc_cidr           = "10.0.0.0/16"
  availability_zones = local.availability_zones
  common_tags        = local.common_tags
}

# ------- Creating Security Group for the ALB server -------
module "security_group_alb_server" {
  source      = "./modules/security_group"
  name        = "alb-server-sg"
  description = "Controls access to the ALB server"
  vpc_id      = module.networking.vpc_id
  common_tags = local.common_tags

  # Inbound rules
  ingress_port        = 80
  cidr_blocks_ingress = ["0.0.0.0/0"]
}

# ------- ALB (Application Load Balancer) -------
module "alb_server" {
  source             = "./modules/alb"
  name               = "alb-server"
  load_balancer_type = "application"
  security_group_id  = module.security_group_alb_server.security_group_id
  subnet_ids         = module.networking.public_subnet_ids
  vpc_id             = module.networking.vpc_id
  common_tags        = local.common_tags
}

# ------- Creating server ECR Repository to store Docker Images -------
module "ecr_server" {
  source = "./modules/ecr"
  name   = "rodas/server"
}

module "ecr_admin" {
  source = "./modules/ecr"
  name   = "rodas/admin"
}

# ------- ECS task role -------
module "ecs_task_role" {
  source = "./modules/iam/roles/ecs_task_role"
  name   = "ecs-task-role"
}

# ------- ECS execution role -------
module "ecs_execution_role" {
  source = "./modules/iam/roles/ecs_execution_role"
  name   = "ecs-execution-role"

  ecr_resource = [module.ecr_server.repository_arn, module.ecr_admin.repository_arn]
}

# ------- Creating ECS Task Definition for the server -------
module "ecs_task_definition_server" {
  source             = "./modules/ecs/task_definition"
  family             = "task-definition-server"
  execution_role_arn = module.ecs_execution_role.arn_role
  task_role_arn      = module.ecs_task_role.arn_role
  cpu                = 1024
  memory             = 2048

  server_container_name = "rodas-server"
  server_image_uri      = module.ecr_server.repository_url

  admin_container_name = "rodas-admin"
  admin_image_uri      = module.ecr_admin.repository_url
}

# ------- Creating a server Security Group for ECS tasks -------
module "security_group_ecs_task_server" {
  source      = "./modules/security_group"
  name        = "ecs-task-server-sg"
  description = "Controls access to the ECS task server"

  vpc_id = module.networking.vpc_id

  # Inbound rules
  ingress_port    = 80
  security_groups = [module.security_group_alb_server.security_group_id]
}

# ------- Creating ECS Cluster -------
module "ecs_cluster" {
  source = "./modules/ecs/cluster"
  name   = "cluster"
}

# ------- Creating ECS Service server -------
module "ecs_service_server" {
  depends_on          = [module.alb_server]
  source              = "./modules/ecs/service"
  name                = "service-server"
  ecs_cluster_id      = module.ecs_cluster.ecs_cluster_id
  task_definition_arn = module.ecs_task_definition_server.task_definition_arn
  desired_count       = 1

  # ------- Network configuration -------
  security_group_arn = module.security_group_ecs_task_server.security_group_id
  subnet_ids         = module.networking.private_subnet_ids

  # ------- Load Balancer setting -------
  target_group_arn = module.alb_server.target_group_arn
  container_name   = "rodas-server"
  container_port   = 80
}

# ------- Creating ECS Autoscaling group policies for the server application -------
module "ecs_autoscaling_group_server" {
  depends_on   = [module.ecs_service_server]
  source       = "./modules/ecs/autoscaling_group"
  name         = "service-server"
  cluster_name = module.ecs_cluster.ecs_cluster_name
  min_capacity = 1
  max_capacity = 4
}
