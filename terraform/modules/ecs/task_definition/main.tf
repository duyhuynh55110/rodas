/*====================================
      AWS ECS Task definition
=====================================*/

resource "aws_ecs_task_definition" "ecs_task_definition" {
  family                   = var.family
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]
  cpu                      = var.cpu
  memory                   = var.memory
  execution_role_arn       = var.execution_role_arn
  task_role_arn            = var.task_role_arn

  container_definitions = templatefile("${path.module}/container_definitions.json", {
    family = var.family
    region = "ap-southeast-1"

    server_container_name = var.server_container_name
    server_image_uri      = var.server_image_uri

    admin_container_name = var.admin_container_name
    admin_image_uri      = var.admin_image_uri
  })
}

# ------- CloudWatch Logs groups to store ecs-containers logs -------
resource "aws_cloudwatch_log_group" "TaskDF-Log_Group" {
  name              = "/ecs/task-definition-${var.family}"
  retention_in_days = 30
}
