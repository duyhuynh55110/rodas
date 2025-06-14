/*===========================
    Backend configuration for staging environment
============================*/

terraform {
  cloud {
    organization = "duyhuynh55110"

    workspaces {
      project = "rodas"
      tags = ["rodas"]
    }
  }
}
