
resource "aws_sqs_queue" "queue" {
  name                      = var.queue_name
  delay_seconds             = var.delay_seconds
  message_retention_seconds = 86400 # 1 day
  max_message_size          = var.max_message_size

  tags = merge({
    Name = var.queue_name
  }, var.common_tags)
}
