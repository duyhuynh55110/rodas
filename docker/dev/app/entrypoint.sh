#!/bin/sh
WORKSPACE="/var/www/admin"

cd $WORKSPACE

# migration
php artisan migrate

# create storage link
php artisan storage:link

# generate app key
php artisan key:generate

# Build css, jss file for Laravel mix
npm run development

# start supervisord
# supervisord -c /etc/supervisor/supervisord.conf

# start php-fpm
php-fpm -F
