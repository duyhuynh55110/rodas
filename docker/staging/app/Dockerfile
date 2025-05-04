# === Stage 1: Composer dependencies ===
FROM php:8.2-cli AS composer

# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    supervisor \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    zip \
    sockets \
    pdo_mysql \
    soap \
    bcmath \
    gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.8.4 && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /app

# Only copy files needed for dependency resolution
COPY packages/Base ./packages/Base
COPY composer.json composer.lock ./

# Cache dependencies unless they change
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# === Stage 2: Node.js build (for Laravel Mix or Vite) ===
# FROM node:16 AS frontend

# WORKDIR /app

# # Same strategy: cache based on lock file
# # Copy necessary files for build
# COPY package.json package-lock.json ./
# COPY webpack.mix.js ./
# COPY resources ./resources
# COPY public ./public

# RUN npm install \
#     && npm run prod

# === Stage 3: PHP FPM ===
FROM php:8.2-fpm as php-fpm

# Set working directory
WORKDIR /var/www/html

# Copy vendor dependencies from cache
COPY composer.json composer.lock ./
COPY --from=composer /app/vendor ./vendor

# Copy node_modules dependencies from cache
# COPY package.json package-lock.json ./
# COPY --from=frontend /app/node_modules ./node_modules

# Copy all source files
COPY . .

# Permissions
RUN chmod -R 777 storage && chmod -R 777 bootstrap/cache

COPY ./docker/app/config/php/php.ini /usr/local/etc/php/php.ini
ADD ./docker/workers/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD ./docker/workers/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf
ADD ./docker/workers/supervisord.conf /etc/supervisor/supervisord.conf

# Make it executable
COPY docker/app/staging/entrypoint.sh ./entrypoint.sh
RUN chmod u+x ./entrypoint.sh

# Run script after container started
ENTRYPOINT [ "sh", "./entrypoint.sh"]

EXPOSE 9000
