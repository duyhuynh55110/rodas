terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
}

provider "aws" {
  region = var.aws_region  # Change this to your desired region
  #   profile = var.aws_profile
}

module "networking" {
  source = "./modules/networking"

  environment         = "dev"
  vpc_cidr           = "10.0.0.0/24"
  private_subnet_count = 2  # This will create 2 private subnets in different AZs
  public_subnet_count  = 2  # This will create 2 public subnets in different AZs
}

module "security" {
  source      = "./modules/security"
  environment = var.environment

  vpc_id = module.networking.vpc_id
}

module "alb" {
  source      = "./modules/alb"
  environment = var.environment

  vpc_id            = module.networking.vpc_id
  public_subnet_ids = module.networking.public_subnet_ids
  security_group_id = module.security.alb_security_group_id
}

module "asg" {
    source = "./modules/asg"
    environment = var.environment

    ami_id = "ami-065a492fef70f84b1"
    private_subnet_ids = module.networking.private_subnet_ids
}
