#!/bin/bash
# To remove Docker containers first
docker-compose down

# Build Docker images
docker-compose build

# Start containers in detached mode
docker-compose up -d
