/*===========================
          Provider
============================*/

provider "aws" {
  region = var.aws_region # Change this to your desired region
  #   profile = var.aws_profile
}
