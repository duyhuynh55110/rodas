# === Stage 1: Build composer dependencies ===
FROM php:8.2-cli AS composer-build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    supervisor \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
    sockets \
    pdo_mysql \
    soap \
    bcmath \
    gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.8.4 \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /app

# Copy source to run composer
COPY . .

RUN rm -f bootstrap/cache/packages.php
RUN rm -f bootstrap/cache/services.php

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# === Stage 2: Build npm dependencies for static assets ===
FROM node:20-alpine AS static-build

# Set working directory
WORKDIR /app

# Copy resource files to build
COPY . .

# Permissions
RUN chmod -R 777 public

# Remove unused folder
RUN rm -rf ./app/resources/assets/user

# Install node dependencies
RUN npm ci && npm run production

# === Stage 3: Final runtime admin container ===
FROM php:8.2-fpm AS admin-app

# Set working directory
WORKDIR /var/www/admin

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    supervisor \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
    sockets \
    pdo_mysql \
    soap \
    bcmath \
    gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy app source code
COPY . .

# Copy built vendor directory
COPY --from=composer-build /app/vendor ./vendor

# Copy built node_modules directory
COPY --from=static-build /app/node_modules ./node_modules

# Copy webpack built assets
COPY --from=static-build /app/public ./public

# Remove unused files
RUN rm -rf resources/assets/user

# Permissions
RUN chmod -R 777 storage && chmod -R 777 bootstrap/cache

COPY ./docker/staging/php.ini /usr/local/etc/php/php.ini
ADD ./docker/staging/workers/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD ./docker/staging/workers/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf
ADD ./docker/staging/workers/supervisord.conf /etc/supervisor/supervisord.conf

# Copy entrypoint and make it executable
COPY ./docker/staging/entrypoint.sh /entrypoint.sh
RUN chmod u+x /entrypoint.sh

# Run entrypoint
ENTRYPOINT [ "sh", "/entrypoint.sh" ]

EXPOSE 9000

# === Stage 4: Build static files for user site ===
FROM node:18-alpine as user-build

# Set working directory
WORKDIR /app

# Copy necessary files for install dependencies
COPY ./resources/assets/user/package.json ./resources/assets/user/package-lock.json ./
RUN npm ci

# Copy all source files
COPY ./resources/assets/user /app

# Build dist folder to run user site
RUN npm run build

# === Stage 5: Final runtime nginx container ===
FROM nginx:1.24-alpine as nginx-server

VOLUME ["/var/cache/nginx", "/var/run", "/etc/nginx/conf.d"]

# Copy Nginx config
COPY ./docker/staging/nginx.conf /etc/nginx/nginx.conf

# Copy admin public folder to auto-loading source
COPY --from=static-build ./app/public /var/www/admin/public

# Copy user source to run static
COPY --from=user-build ./app/dist /var/www/html

# 80 -> admin application
# 8080 -> user application
EXPOSE 80 8080
