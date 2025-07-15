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
