/*==============================================================
      AWS Application Load Balancer + Target groups
===============================================================*/

locals {
  http_port     = var.ingress_port
  http_protocol = var.ingress_port == 80 ? "HTTP" : "HTTPS"
}

# ------- Create Load Balancer -------
resource "aws_lb" "lb" {
  name               = var.name
  internal           = false
  load_balancer_type = var.load_balancer_type
  security_groups    = [var.security_group_id]
  subnets            = var.subnet_ids

  tags = merge(
    {
      Name = var.name
    },
    var.common_tags
  )
}

# ------- Target Groups -------
resource "aws_lb_target_group" "http" {
  name        = "${var.name}-http-tg"
  port        = local.http_port
  protocol    = local.http_protocol
  vpc_id      = var.vpc_id
  target_type = "ip"

  # Must config rule for health check
  health_check {
    port                = local.http_port
    protocol            = local.http_protocol
    healthy_threshold   = "5"
    unhealthy_threshold = "2"
    interval            = "30"
    matcher             = "200"
    path                = "/"
    timeout             = "5"
  }

  lifecycle {
    create_before_destroy = true
  }

  tags = merge(
    {
      Name = "${var.name}-http-tg"
    },
    var.common_tags
  )
}

# ------- Load Balancer listener for HTTP -------
resource "aws_lb_listener" "http" {
  load_balancer_arn = aws_lb.lb.arn
  port              = local.http_port
  protocol          = local.http_protocol

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.http.arn
  }
}
