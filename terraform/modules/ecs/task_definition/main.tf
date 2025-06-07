/*====================================
      AWS ECS Task definition
=====================================*/
locals {
  log_group_name = "/ecs/${var.family}"
}

resource "aws_ecs_task_definition" "ecs_task_definition" {
  family                   = var.family
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]
  cpu                      = var.cpu
  memory                   = var.memory
  execution_role_arn       = var.execution_role_arn
  task_role_arn            = var.task_role_arn

  container_definitions = templatefile("${path.module}/container_definitions.json.tftpl", {
    log_group_name = local.log_group_name
    region = var.region

    server_container_name = var.server_container_name
    server_image_uri      = var.server_image_uri
    server_container_cpu  = var.server_container_cpu
    server_container_memory = var.server_container_memory
    server_container_memory_reservation = var.server_container_memory_reservation
    server_container_port = var.server_container_port
    server_host_port      = var.server_host_port

    admin_container_name = var.admin_container_name
    admin_image_uri      = var.admin_image_uri
    admin_container_cpu  = var.admin_container_cpu
    admin_container_memory = var.admin_container_memory
    admin_container_memory_reservation = var.admin_container_memory_reservation
    admin_container_port = var.admin_container_port

    ssh_port = var.ssh_port
    allow_ecs_exec = var.allow_ecs_exec
  })
}
