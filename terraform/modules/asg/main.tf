locals {
  instance_type = "t2.micro"
}

resource "aws_launch_template" "lt_web_server" {
  name          = "${var.environment}-lt_web_server"
  instance_type = local.instance_type
  image_id      = var.ami_id

  tags = {
    Name        = "${var.environment}-lt_web_server"
    Environment = var.environment
  }
}

resource "aws_autoscaling_group" "asg_web_server" {
  name                      = "${var.environment}-asg"
  max_size                  = 2
  min_size                  = 1
  health_check_grace_period = 300 # Time to wait for the instance to be healthy before scaling
  health_check_type         = "ELB"
  force_delete              = true
  vpc_zone_identifier       = var.private_subnet_ids

  launch_template {
    id      = aws_launch_template.lt_web_server.id
    version = "$Latest"
  }
}
