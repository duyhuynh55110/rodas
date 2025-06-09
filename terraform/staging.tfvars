app_name    = "rodas"
app_env     = "staging"
aws_profile = "staging-rodas" # Replace with your profile name
aws_region  = "ap-southeast-1"
public_access_cidr = ["0.0.0.0/0"] # Allow access from anywhere for public ALB
admin_restricted_cidr = ["YOUR_IP/32"]  # Limit IP for some services only can access by admin IP
bastion_key_name = "staging-rodas-bastion" # Key pair use to access bastion host. Replace with your key pair name

# ------- Networking configuration -------
vpc_cidr = "10.0.0.0/16" # CIDR block for the VPC

# ------- ALB configuration -------
alb_ingress_port = 80  # Default protocol (HTTP/HTTPS) for ALB

# ------- ASG configuration -------
server_min_capacity = 1
server_max_capacity = 4

# ------- ECS configuration -------
ecs_task_cpu = 1024
ecs_task_memory = 2048
allow_ecs_exec = true  # Allow access ECS container to execute command
