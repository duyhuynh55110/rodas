output "hosted_zone_id" {
  description = "The hosted zone ID"
  value       = data.aws_route53_zone.main.zone_id
}

output "name_servers" {
  description = "The name servers for the hosted zone"
  value       = data.aws_route53_zone.main.name_servers
}

output "zone_arn" {
  description = "The ARN of the hosted zone"
  value       = data.aws_route53_zone.main.arn
}
