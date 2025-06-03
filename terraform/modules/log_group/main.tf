resource "aws_cloudwatch_log_group" "log_group" {
  name              = var.name
  retention_in_days = 30
}
