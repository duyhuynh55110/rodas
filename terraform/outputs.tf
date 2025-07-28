# ------- Domain URL -------
output "application_url" {
  description = "URL to access your application"
  value       = "https://${local.app_domain}"
}

output "admin_url" {
  description = "URL to access your admin console"
  value       = "https://${local.app_admin_domain}"
}
