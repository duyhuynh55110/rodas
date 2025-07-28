# ------- Route53 Hosted Zone -------
data "aws_route53_zone" "main" {
  name = var.domain_name
}

# ------- Dynamic Route53 Records -------
resource "aws_route53_record" "dynamic" {
  for_each = var.subdomains

  zone_id = data.aws_route53_zone.main.zone_id
  name    = each.value.name
  type    = each.value.type

  alias {
    name                   = each.value.alias.name
    zone_id                = each.value.alias.zone_id
    evaluate_target_health = true
  }
}
