# Download mc in Alpine stage
FROM alpine:latest AS downloader
RUN apk add --no-cache curl
RUN curl -L https://dl.min.io/client/mc/release/linux-amd64/mc -o /mc && chmod +x /mc

# Final MinIO image
FROM minio/minio:latest
COPY --from=downloader /mc /usr/local/bin/mc

# Copy entrypoint to run set up script
COPY docker/dev/minio/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh


