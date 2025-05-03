#!/bin/sh
WORKSPACE="/var/www/html"

# migration
# php artisan migrate

# create storage link
php artisan storage:link

# generate app key
php artisan key:generate

php-fpm -F
