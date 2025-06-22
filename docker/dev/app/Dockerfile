FROM php:8.2-fpm AS php-fpm

# Set working directory
WORKDIR /var/www/admin

# === Stage 1: Composer dependencies ===
# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    supervisor \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
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

# === Stage 2: Node.js build (for Laravel Mix or Vite) ===
# install nodejs
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# Only copy files needed for dependency resolution
COPY package.json package-lock.json ./
COPY webpack.mix.js ./
COPY resources ./resources
COPY public ./public

# Install dependencies, it will be cached avoid rebuild
RUN npm install

# === Stage 3: Laravel application ===
# Copy all source files
COPY . .

# Install dependencies, it will be cached avoid rebuild
RUN composer install

# Permissions
RUN chmod -R 777 storage && chmod -R 777 bootstrap/cache

COPY ./docker/dev/app/config/php/php.ini /usr/local/etc/php/php.ini
ADD ./docker/dev/workers/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD ./docker/dev/workers/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf
ADD ./docker/dev/workers/supervisord.conf /etc/supervisor/supervisord.conf

EXPOSE 9000
