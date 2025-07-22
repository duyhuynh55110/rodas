# ------- Route53 Hosted Zone -------
data "aws_route53_zone" "main" {
  name = var.domain_name
}

# ------- A Record pointing to Cloudfront (Vue.js application) -------
resource "aws_route53_record" "main" {
  zone_id = data.aws_route53_zone.main.zone_id
  name    = var.domain_name
  type    = "A"

  alias {
    name                   = var.cf_distribution_domain_name
    zone_id                = var.cf_distribution_hosted_zone_id
    evaluate_target_health = true
  }
}

# ------- Dynamic Route53 Records -------
resource "aws_route53_record" "dynamic" {
  for_each = var.subdomains

  zone_id = data.aws_route53_zone.main.zone_id
  name    = each.value.name
  type    = each.value.type != null ? each.value.type : "A"

  alias {
    name                   = var.alb_dns_name
    zone_id                = var.alb_zone_id
    evaluate_target_health = true
  }
}
