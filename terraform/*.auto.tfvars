app_name    = "rodas"
public_access_cidr = ["0.0.0.0/0"] # Allow access from anywhere for public ALB
admin_restricted_cidr = ["0.0.0.0/0"]  # Limit IP for some services only can access by admin IP

# ------- Networking configuration -------
vpc_cidr = "10.0.0.0/16" # CIDR block for the VPC

# ------- ALB configuration -------
alb_ingress_port = 80  # HTTP port for ALB (temporary until SSL cert is validated)

# ------- ASG configuration -------
server_min_capacity = 1
server_max_capacity = 4

# ------- ECS configuration -------
ecs_task_cpu = 1024
ecs_task_memory = 2048
allow_ecs_exec = false  # Allow access ECS container to execute command
