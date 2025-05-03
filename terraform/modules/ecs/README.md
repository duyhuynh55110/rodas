# What is Amazon Elastic Container Service?

Amazon Elastic Container Service (Amazon ECS) is a fully managed container orchestration service that helps you easily deploy, manage, and scale containerized applications.

## What is ECS?

ECS allows you to run Docker containers on a cluster of EC2 or AWS Fargate instances without needing to manage the infrastructure. It supports two launch types:

-   **EC2 Launch Type**: You manage the EC2 instances that run your containers.
-   **Fargate Launch Type**: AWS manages the infrastructure; you only define the container specs.

## How ECS Works

### 1. **Container Definition**

You define your application container using a **Docker image**. This image is stored in a container registry such as Amazon ECR or Docker Hub.

### 2. **Task Definition**

You create a **Task Definition**, a blueprint that tells ECS:

-   What Docker image to use
-   How much CPU/memory to allocate
-   Port mappings
-   Environment variables

### 3. **Service**

A **Service** runs and maintains a specified number of task instances. It ensures your application is highly available and scalable. ECS automatically restarts failed tasks.

### 4. **Cluster**

A **Cluster** is a logical grouping of EC2 or Fargate infrastructure where ECS tasks run.

### 5. **Scheduling**

ECS schedules tasks across available infrastructure based on your service definition, task placement strategies, and resource availability.

## 🔧 Architecture Overview

```text
+------------------+      +------------------+
|  Task Definition |      |  Docker Image    |
+------------------+      +------------------+
         |                         |
         v                         v
+------------------+      +------------------+
|     Service      | ---> |   Amazon ECR     |
+------------------+      +------------------+
         |
         v
+------------------+
|     Cluster      |
| (EC2 or Fargate) |
+------------------+
         |
         v
+------------------+
| Running Task(s)  |
+------------------+
