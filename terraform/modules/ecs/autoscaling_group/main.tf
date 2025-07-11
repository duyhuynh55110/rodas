/*====================================
        AWS ECS Autoscaling
=====================================*/

# ------- AWS Autoscaling target to link the ECS cluster and service -------
resource "aws_appautoscaling_target" "ecs_target" {
  min_capacity       = var.min_capacity
  max_capacity       = var.max_capacity
  # Resource type and unique identifier string for the resource associated with the scaling policy.
  resource_id        = "service/${var.cluster_name}/${var.name}"
  scalable_dimension = "ecs:service:DesiredCount"
  service_namespace  = "ecs"

  lifecycle {
    ignore_changes = [
      role_arn,
    ]
  }
}

# ------- AWS Autoscaling policy using CPU allocation -------
resource "aws_appautoscaling_policy" "cpu" {
  name               = "ecs_scale_cpu_service_${var.name}"
  resource_id        = aws_appautoscaling_target.ecs_target.resource_id
  scalable_dimension = aws_appautoscaling_target.ecs_target.scalable_dimension
  service_namespace  = aws_appautoscaling_target.ecs_target.service_namespace
  policy_type        = "TargetTrackingScaling"

  target_tracking_scaling_policy_configuration {
    target_value       = 50
    scale_in_cooldown  = 60
    scale_out_cooldown = 60

    predefined_metric_specification {
      predefined_metric_type = "ECSServiceAverageCPUUtilization"
    }
  }
}

# ------- AWS Autoscaling policy using memory allocation -------
resource "aws_appautoscaling_policy" "memory" {
  name               = "ecs_scale_memory_service_${var.name}"
  resource_id        = aws_appautoscaling_target.ecs_target.resource_id
  scalable_dimension = aws_appautoscaling_target.ecs_target.scalable_dimension
  service_namespace  = aws_appautoscaling_target.ecs_target.service_namespace
  policy_type        = "TargetTrackingScaling"

  target_tracking_scaling_policy_configuration {
    target_value       = 50
    scale_in_cooldown  = 60
    scale_out_cooldown = 60

    predefined_metric_specification {
      predefined_metric_type = "ECSServiceAverageMemoryUtilization"
    }
  }
}
