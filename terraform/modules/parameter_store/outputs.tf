output "parameter_arns" {
  description = "ARNs of the created parameters"
  value       = { for k, v in aws_ssm_parameter.parameter : k => v.arn }
}

output "parameter_names" {
  description = "Names of the created parameters"
  value       = { for k, v in aws_ssm_parameter.parameter : k => v.name }
}