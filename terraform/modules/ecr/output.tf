output "repository_url" {
  value = data.aws_ecr_repository.ecr_repository.repository_url
}

output "repository_arn" {
  value = data.aws_ecr_repository.ecr_repository.arn
}
