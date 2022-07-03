#!/bin/bash
WORKSPACE="/var/www/rodas-admin"

chmod -R 777 $WORKSPACE/storage
chmod -R 777 $WORKSPACE/bootstrap

cd $WORKSPACE

# mix assets
npm install
npm run prod

# install package
composer install

# migration
php artisan migrate

# start supervisord
# supervisord -c /etc/supervisor/supervisord.conf

# start php-fpm
php-fpm -F
