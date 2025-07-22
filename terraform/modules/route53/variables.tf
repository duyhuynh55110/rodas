variable "domain_name" {
  description = "The domain name for the hosted zone"
  type        = string
}

variable "alb_dns_name" {
  description = "DNS name of the Application Load Balancer"
  type        = string
}

variable "alb_zone_id" {
  description = "Zone ID of the Application Load Balancer"
  type        = string
}

variable "cf_distribution_domain_name" {
  description = "The domain name of the CloudFront distribution (e.g., d1234567890abcdef.cloudfront.net)."
  type        = string
}

variable "cf_distribution_hosted_zone_id" {
  description = "The hosted zone ID of the CloudFront distribution (e.g., Z2FDTNDATAQYW2)."
  type        = string
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(any)
  default     = {}
}

# ------- Subdomains -------
variable "subdomains" {
  description = "Map of subdomains with their names"
  type = map(object({
    name = string
    type = optional(string, "A")
  }))
}
