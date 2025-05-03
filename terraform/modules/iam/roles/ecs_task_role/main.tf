/*===========================================
      AWS IAM Role for ECS
============================================*/

resource "aws_iam_role" "ecs_task_role" {
  name               = var.name
  assume_role_policy = <<EOF
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Sid": "",
      "Effect": "Allow",
      "Principal": {
        "Service": "ecs-tasks.amazonaws.com"
      },
      "Action": "sts:AssumeRole"
    }
  ]
}
EOF
  tags = {
    Name = var.name
  }

  lifecycle {
    create_before_destroy = true
  }
}

# ------- IAM Policies -------
resource "aws_iam_policy" "policy_for_ecs_task_role" {
  name        = "Policy-${var.name}"
  description = "IAM Policy for Role ${var.name}"
  policy      = file("modules/iam/policies/ecs-task-role-policy.json")

  lifecycle {
    create_before_destroy = true
  }
}

# ------- IAM Policies Attachments -------
resource "aws_iam_role_policy_attachment" "ecs_attachment" {
  policy_arn = aws_iam_policy.policy_for_ecs_task_role.arn
  role       = aws_iam_role.ecs_task_role.name

  lifecycle {
    create_before_destroy = true
  }
}
