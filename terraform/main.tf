/*===========================
          Root file
============================*/

# ------- Prepare data -------
data "aws_availability_zones" "available" {
  state = "available"
}

locals {
  availability_zones = slice(data.aws_availability_zones.available.names, 0, 2)

  // ECS settings
  task_definition_name = "task-definition-server"
  log_group_name       = "/ecs/${local.task_definition_name}"

  common_tags = {
    Environment = var.app_env
    Application = var.app_name
  }
}

# ------- Networking -------
module "networking" {
  source = "./modules/networking"

  vpc_cidr           = var.vpc_cidr
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
  ingress_port        = var.alb_ingress_port
  cidr_blocks_ingress = var.public_access_cidr
}

# ------- Creating Security Group for SSH access -------
module "security_group_ssh" {
  count       = var.allow_ecs_exec ? 1 : 0
  source      = "./modules/security_group"
  name        = "ssh-access-sg"
  description = "Controls SSH access to ECS containers"
  vpc_id      = module.networking.vpc_id
  common_tags = local.common_tags

  # Inbound rules
  ingress_port        = var.ssh_ingress_port
  cidr_blocks_ingress = var.admin_restricted_cidr
}

# ------- ALB (Application Load Balancer) -------
module "alb_server" {
  source             = "./modules/alb"
  name               = "alb-server"
  load_balancer_type = "application"
  ingress_port       = var.alb_ingress_port
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

# ------- Create a CloudWatch log group to handle logging for ECS container -------
module "ecs_containers_log_group" {
  source = "./modules/log_group"
  name   = local.log_group_name
}

# ------- ECS task role -------
module "ecs_task_role" {
  source = "./modules/iam/roles/ecs_task_role"
  name   = "ecs-task-role"

  allow_ecs_exec = var.allow_ecs_exec
}

# ------- ECS execution role -------
module "ecs_execution_role" {
  source = "./modules/iam/roles/ecs_execution_role"
  name   = "ecs-execution-role"

  ecr_resource       = [module.ecr_server.repository_arn, module.ecr_admin.repository_arn]
  log_group_resource = [module.ecs_containers_log_group.log_group_arn]
}

# ------- Creating ECS Task Definition for the server -------
module "ecs_task_definition_server" {
  source             = "./modules/ecs/task_definition"
  family             = local.task_definition_name
  region             = var.aws_region
  log_group_name     = module.ecs_containers_log_group.log_group_name
  execution_role_arn = module.ecs_execution_role.arn_role
  task_role_arn      = module.ecs_task_role.arn_role
  cpu                = var.ecs_task_cpu
  memory             = var.ecs_task_memory

  server_container_name = var.server_container_name
  server_image_uri      = module.ecr_server.repository_url
  server_host_port      = var.alb_ingress_port
  server_container_port = var.alb_ingress_port

  admin_container_name = var.admin_container_name
  admin_image_uri      = module.ecr_admin.repository_url

  allow_ecs_exec = var.allow_ecs_exec
}

# ------- Creating a server Security Group for ECS tasks -------
module "security_group_ecs_task_server" {
  source      = "./modules/security_group"
  name        = "ecs-task-server-sg"
  description = "Controls access to the ECS task server"

  vpc_id = module.networking.vpc_id

  # Inbound rules - only allow port 80 from ALB
  ingress_port    = var.alb_ingress_port
  security_groups = [module.security_group_alb_server.security_group_id]

  # Use additional_ingress_rules for SSH access if needed
  additional_ingress_rules = var.allow_ecs_exec ? [
    {
      protocol    = "tcp"
      from_port   = var.ssh_ingress_port
      to_port     = var.ssh_ingress_port
      cidr_blocks = var.admin_restricted_cidr
    }
  ] : null
}

# ------- Creating ECS Cluster -------
module "ecs_cluster" {
  source = "./modules/ecs/cluster"
  name   = "cluster"
}

# ------- Creating ECS Service server -------
module "ecs_service_server" {
  depends_on             = [module.alb_server]
  source                 = "./modules/ecs/service"
  name                   = "service-server"
  ecs_cluster_id         = module.ecs_cluster.ecs_cluster_id
  task_definition_arn    = module.ecs_task_definition_server.task_definition_arn
  desired_count          = 1
  enable_execute_command = var.allow_ecs_exec

  # ------- Network configuration -------
  security_group_arn = module.security_group_ecs_task_server.security_group_id
  subnet_ids         = module.networking.private_subnet_ids

  # ------- Load Balancer setting -------
  target_group_arn = module.alb_server.target_group_arn
  container_name   = var.server_container_name
  container_port   = var.alb_ingress_port
}

# ------- Creating ECS Autoscaling group policies for the server application -------
module "ecs_autoscaling_group_server" {
  depends_on   = [module.ecs_service_server]
  source       = "./modules/ecs/autoscaling_group"
  name         = "service-server"
  cluster_name = module.ecs_cluster.ecs_cluster_name
  min_capacity = var.server_min_capacity
  max_capacity = var.server_max_capacity
}
