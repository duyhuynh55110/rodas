FROM nginx:1.24-alpine

VOLUME ["/var/cache/nginx", "/var/run", "/etc/nginx/conf.d"]

COPY ./docker/dev/nginx/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80
