/*===========================
    Backend configuration for production environment
============================*/

terraform {
  cloud {
    organization = "duyhuynh55110"

    workspaces {
      project = "rodas"
      name = "prod-rodas"
    }
  }
}
