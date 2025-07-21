/*==============================================================
      AWS Application Load Balancer + Target groups
===============================================================*/
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
  port        = 80
  protocol    = "HTTP"
  vpc_id      = var.vpc_id
  target_type = "ip"

  # Must config rule for health check
  health_check {
    port                = 80
    protocol            = "HTTP"
    healthy_threshold   = "5"
    unhealthy_threshold = "2"
    interval            = "30"
    matcher             = "200"
    path                = "/health"
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

# ------- Load Balancer listener for HTTP (redirect to HTTPS) -------
resource "aws_lb_listener" "http" {
  load_balancer_arn = aws_lb.lb.arn
  port              = "80"
  protocol          = "HTTP"

  default_action {
    type = "redirect"

    redirect {
      port        = "443"
      protocol    = "HTTPS"
      status_code = "HTTP_301"
    }
  }
}

# ------- Load Balancer listener for HTTPS -------
resource "aws_lb_listener" "https" {
  load_balancer_arn = aws_lb.lb.arn
  port              = "443"
  protocol          = "HTTPS"
  ssl_policy        = "ELBSecurityPolicy-TLS-1-2-2017-01"
  certificate_arn   = var.certificate_arn

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.http.arn
  }
}
