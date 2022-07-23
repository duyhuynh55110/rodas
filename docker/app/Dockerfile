FROM php:8.1-fpm

# install libraries
RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev supervisor \
    && docker-php-ext-install zip

# install GD library (php library)
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-source extract \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/refs/tags/5.3.4.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mv phpredis-5.3.4 /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && docker-php-source delete

RUN apt-get install -y libpq-dev libmcrypt-dev default-mysql-client libxml2 libxml2-dev

RUN docker-php-ext-install pdo_mysql pdo_pgsql soap bcmath

RUN apt-get clean

# install nodejs
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# install composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

ADD ./docker/workers/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD ./docker/workers/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf
ADD ./docker/workers/supervisord.conf /etc/supervisor/supervisord.conf
