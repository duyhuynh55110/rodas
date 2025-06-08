/*===========================
    Parameter Store Module
============================*/

resource "aws_ssm_parameter" "parameter" {
  for_each = var.parameters

  name        = "/${var.prefix}/${each.key}"
  description = lookup(each.value, "description", null)
  type        = lookup(each.value, "type", "String")
  value       = each.value.value
  tier        = lookup(each.value, "tier", "Standard")
  
  tags = merge(
    var.common_tags,
    {
      Name = "${var.prefix}-${each.key}"
    }
  )
}