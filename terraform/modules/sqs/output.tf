output "queue_arn" {
  description = "ARN of the SQS queue"
  value       = aws_sqs_queue.queue.arn
}

output "queue_name" {
  description = "Name of the SQS queue"
  value       = aws_sqs_queue.queue.name
}

