FROM nginx:1.20.0-alpine as admin-webserver

VOLUME ["/var/cache/nginx", "/var/run", "/etc/nginx/conf.d"]

COPY ./docker/nginx/staging/app.conf /etc/nginx/nginx.conf
EXPOSE 80
