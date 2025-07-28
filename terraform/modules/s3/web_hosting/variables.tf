variable "bucket_name" {
  description = "Name of the S3 bucket"
  type        = string
}

variable "app_domain" {
  description = "App domain use to make alias for Cloudfront distribution"
  type        = string
}

variable "certificate_arn" {
  description = ""
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to resources"
  type        = map(string)
  default     = {}
}
