/*==================================================
      AWS Networking for the whole solution
===================================================*/
# ------- Calculate subnet CIDR -------
locals {
  # Convert VPC CIDR to network address and prefix length
  # Ex:
  # vpc_cidr = "10.0.0.0/16"
  # availability_zones = ["ap-southeast-1a", "ap-southeast-1b"]

  # Divide VPC into large blocks; Subnet sizes: /20 = 4096 IPs, /22 = 1024 IPs
  isolated_block = cidrsubnet(var.vpc_cidr, 2, 0) # 10.0.0.0/18
  private_block  = cidrsubnet(var.vpc_cidr, 2, 1) # 10.0.64.0/18
  public_block   = cidrsubnet(var.vpc_cidr, 2, 2) # 10.0.128.0/18

  # Calculate subnet CIDR blocks for each AZ
  # isolated_subnets_cidr = ["10.0.0.0/20", "10.0.16.0/20"]
  isolated_subnets_cidr = [
    for i in range(length(var.availability_zones)) :
    cidrsubnet(local.isolated_block, 2, i)
  ]

  # private_subnet_cidr = ["10.0.64.0/20", "10.0.80.0/20"]
  private_subnet_cidr = [
    for i in range(length(var.availability_zones)) :
    cidrsubnet(local.private_block, 2, i)
  ]

  # public_subnet_cidr = ["10.0.128.0/22", "10.0.132.0/22"]
  public_subnet_cidr = [
    for i in range(length(var.availability_zones)) :
    cidrsubnet(local.public_block, 4, i)
  ]
}

# ------- VPC -------
resource "aws_vpc" "main" {
  cidr_block           = var.vpc_cidr
  enable_dns_hostnames = true
  enable_dns_support   = true

  tags = merge(
    {
      Name = "main-vpc"
    },
    var.common_tags
  )
}

# ------- Isolated subnets -------
resource "aws_subnet" "isolated" {
  count                   = length(var.availability_zones)
  vpc_id                  = aws_vpc.main.id
  cidr_block              = local.isolated_subnets_cidr[count.index]
  availability_zone       = var.availability_zones[count.index]
  map_public_ip_on_launch = false

  tags = merge(
    {
      Name = "isolated-subnet-${substr("abcdefghijklmnopqrstuvwxyz", count.index, 1)}"
    },
    var.common_tags
  )

  depends_on = [aws_vpc.main]
}

# ------- Private subnets -------
resource "aws_subnet" "private" {
  count                   = length(var.availability_zones)
  vpc_id                  = aws_vpc.main.id
  cidr_block              = local.private_subnet_cidr[count.index]
  availability_zone       = var.availability_zones[count.index]
  map_public_ip_on_launch = false

  tags = merge(
    {
      Name = "private-subnet-${substr("abcdefghijklmnopqrstuvwxyz", count.index, 1)}"
    },
    var.common_tags
  )

  depends_on = [aws_vpc.main]
}

# ------- Public subnets -------
resource "aws_subnet" "public" {
  count                   = length(var.availability_zones)
  vpc_id                  = aws_vpc.main.id
  cidr_block              = local.public_subnet_cidr[count.index]
  availability_zone       = var.availability_zones[count.index]
  map_public_ip_on_launch = true

  tags = merge(
    {
      Name = "public-subnet-${substr("abcdefghijklmnopqrstuvwxyz", count.index, 1)}"
    },
    var.common_tags
  )

  depends_on = [aws_vpc.main]
}

# ------- Internet Gateway -------
resource "aws_internet_gateway" "main" {
  vpc_id = aws_vpc.main.id

  tags = merge(
    {
      Name = "main-igw"
    },
    var.common_tags
  )
}

resource "aws_route" "main" {
  route_table_id         = aws_vpc.main.main_route_table_id
  gateway_id             = aws_internet_gateway.main.id
  destination_cidr_block = "0.0.0.0/0"
}

# ------- NACL -------
resource "aws_network_acl" "main" {
  vpc_id = aws_vpc.main.id

  # Allow all inbound from HTTP
  ingress {
    protocol   = "tcp"
    rule_no    = 100
    action     = "allow"
    cidr_block = "0.0.0.0/0"
    from_port  = 80
    to_port    = 80
  }

  # Allow all outbound
  egress {
    protocol   = "tcp"
    rule_no    = 100
    action     = "allow"
    cidr_block = "0.0.0.0/0"
    from_port  = 0
    to_port    = 65535
  }

  tags = merge(
    {
      Name = "main-nacl"
    },
    var.common_tags
  )
}

# ------- EIP -------
resource "aws_eip" "eip" {
  domain = "vpc"

  tags = merge(
    {
      Name = "main-eip"
    },
    var.common_tags
  )
}

# ------- NAT Gateway -------
resource "aws_nat_gateway" "nat" {
  subnet_id         = aws_subnet.public[0].id # Place at public subnet in first AZ
  connectivity_type = "public"
  allocation_id     = aws_eip.eip.id

  tags = merge(
    {
      Name = "nat-gateway"
    },
    var.common_tags
  )
}

# ------- Private Route Table -------
resource "aws_route_table" "private" {
  vpc_id = aws_vpc.main.id

  route {
    cidr_block     = "0.0.0.0/0"
    nat_gateway_id = aws_nat_gateway.nat.id
  }

  tags = merge(
    {
      Name = "private-rt"
    },
    var.common_tags
  )
}

resource "aws_route_table_association" "private" {
  count = length(var.availability_zones)

  subnet_id      = aws_subnet.private[count.index].id
  route_table_id = aws_route_table.private.id
}

# ------- Isolated Route Table -------
resource "aws_route_table" "isolated" {
  vpc_id = aws_vpc.main.id

  tags = merge(
    {
      Name = "isolated-rt"
    },
    var.common_tags
  )
}

resource "aws_route_table_association" "isolated" {
  count = length(var.availability_zones)

  subnet_id      = aws_subnet.isolated[count.index].id
  route_table_id = aws_route_table.isolated.id
}
