/*===========================
    Backend Configuration
============================*/

terraform {
  cloud {
    organization = "duyhuynh55110" # Your organization name

    workspaces {
      project = "rodas"                # Your project name
      name    = "${var.app_env}-rodas" # Your workspace name
    }
  }
}
