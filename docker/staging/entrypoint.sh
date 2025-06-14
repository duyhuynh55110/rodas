#!/bin/sh

WORKDIR=/var/www/admin

cd $WORKDIR

# start supervisord
# supervisord -c /etc/supervisor/supervisord.conf

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

composer dump-autoload

php-fpm -F
