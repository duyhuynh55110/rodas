/*==============================================================
      Bastion Host
      (A bastion host is an EC2 instance in a public subnet with an SSH-accessible public IP.)
===============================================================*/

# ------- Creating Bastion Host -------
resource "aws_instance" "bastion" {
  ami                    = var.ami
  instance_type          = var.instance_type
  subnet_id              = var.subnet_id
  vpc_security_group_ids = var.security_group_ids
  key_name               = var.key_name

  tags = merge(
    {
      Name = "bastion-host"
    },
    var.common_tags
  )
}
