# ------- Domain URL -------
output "application_url" {
  description = "URL to access your application"
  value       = "https://${var.domain_name}"
}
