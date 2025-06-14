variable "prefix" {
  description = "Prefix for the parameter names"
  type        = string
}

variable "parameters" {
  description = "Map of parameters to create"
  type        = map(any)
}

variable "common_tags" {
  description = "Common tags to apply to all resources"
  type        = map(string)
  default     = {}
}