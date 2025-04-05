data "aws_availability_zones" "available" {
  state = "available"
}

locals {
  # Convert VPC CIDR to network address and prefix length
  # Ex: vpc_cidr = "10.0.0.0/24"

  # Get two availability zones from the region
  # Ex: ["ap-southeast-1a", "ap-southeast-1b"]
  availability_zones = slice(data.aws_availability_zones.available.names, 0, 2)

  # Calculate subnet CIDR blocks for each AZ
  # private_subnet_cidr = ["10.0.0.0/26", "10.0.0.64/26"]
  private_subnet_cidr = [
    for i in range(length(local.availability_zones)) :
    cidrsubnet(var.vpc_cidr, 2, i)
  ]

  # public_subnet_cidr = ["10.0.0.128/26", "10.0.0.192/26"]
  public_subnet_cidr = [
    for i in range(length(local.availability_zones)) :
    cidrsubnet(var.vpc_cidr, 2, i + 2)
  ]
}

resource "aws_vpc" "main" {
  cidr_block           = var.vpc_cidr
  enable_dns_hostnames = true
  enable_dns_support   = true

  tags = {
    Name        = "${var.environment}-vpc"
    Environment = var.environment
  }
}

resource "aws_internet_gateway" "main" {
  vpc_id = aws_vpc.main.id

  tags = {
    Name        = "${var.environment}-igw"
    Environment = var.environment
  }
}

resource "aws_subnet" "private" {
  count             = length(local.availability_zones)
  vpc_id            = aws_vpc.main.id
  cidr_block        = local.private_subnet_cidr[count.index]
  availability_zone = local.availability_zones[count.index]

  tags = {
    Name        = "${var.environment}-private-subnet-${count.index + 1}"
    Environment = var.environment
  }
}

resource "aws_subnet" "public" {
  count                   = length(local.availability_zones)
  vpc_id                  = aws_vpc.main.id
  cidr_block              = local.public_subnet_cidr[count.index]
  availability_zone       = local.availability_zones[count.index]
  map_public_ip_on_launch = true

  tags = {
    Name        = "${var.environment}-public-subnet-${count.index + 1}"
    Environment = var.environment
  }
}
