#!/bin/bash

# Exit on error
set -e

# Log function for debugging
log() {
    echo "[$(date -u)] $1"
}

# Validate environment variables
if [ -z "${MINIO_ROOT_USER}" ] || [ -z "${MINIO_ROOT_PASSWORD}" ]; then
    log "ERROR: MINIO_ROOT_USER or MINIO_ROOT_PASSWORD is not set"
    exit 1
fi

# Start MinIO server using official entrypoint
log "Starting MinIO server on port ${MINIO_SERVER_PORT:-8000}, console on ${MINIO_CONSOLE_PORT:-8001}"
/usr/bin/docker-entrypoint.sh server /data --address ":${MINIO_SERVER_PORT:-8000}" --console-address ":${MINIO_CONSOLE_PORT:-8001}" &

# Wait for MinIO to be ready
log "Waiting for MinIO to be ready..."
until curl -s http://localhost:${MINIO_SERVER_PORT:-8000}/minio/health/live >/dev/null; do
    log "MinIO not ready yet, retrying in 2 seconds..."
    sleep 2
done
log "MinIO is ready"

# Configure mc client
log "Configuring mc alias"
if ! mc alias set local http://localhost:${MINIO_SERVER_PORT:-8000} "${MINIO_ROOT_USER}" "${MINIO_ROOT_PASSWORD}"; then
    log "ERROR: Failed to set mc alias"
    exit 1
fi

# Create buckets
log "Creating bucket 'rodas'"
if ! mc mb local/rodas --ignore-existing; then
    log "ERROR: Failed to create bucket 'rodas'"
    exit 1
fi

# Verify buckets
log "Listing buckets to verify"
if ! mc ls local; then
    log "ERROR: Failed to list buckets"
    exit 1
fi

# Keep container running
log "MinIO setup complete, keeping container running"
wait
