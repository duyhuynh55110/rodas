variable "domain_name" {
  description = "The domain name for the hosted zone"
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
    type = string
    alias = object({
        name = string
        zone_id = string
        evaluate_target_health = optional(bool, true)
    })
  }))
}
