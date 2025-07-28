/*================================
      AWS Security group
=================================*/

resource "aws_security_group" "sg" {
  name        = var.name
  description = var.description
  vpc_id      = var.vpc_id

  dynamic "ingress" {
    for_each = var.ingress_rules != null ? var.ingress_rules : []
    content {
      protocol        = ingress.value.protocol
      from_port       = ingress.value.from_port
      to_port         = ingress.value.to_port
      cidr_blocks     = ingress.value.cidr_blocks != null ? ingress.value.cidr_blocks : null
      security_groups = ingress.value.security_groups != null ? ingress.value.security_groups : null
    }
  }

  egress {
    from_port   = var.egress_port
    to_port     = var.egress_port
    protocol    = "-1"
    cidr_blocks = var.cidr_blocks_egress
  }

  tags = merge({
    Name = var.name
  }, var.common_tags)
}
