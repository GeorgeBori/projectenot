FROM php:8.2.7-fpm

RUN apt-get update \
    && apt-get install --no-install-recommends -y \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
        libpng-dev \
        libpq-dev \
        libmemcached-dev \
        libmagickwand-dev \
        libfreetype6-dev \
        cron \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install -j$(nproc) \
        intl \
        pdo_mysql \
        pdo_pgsql \
        opcache \
        zip \
        gd

RUN pecl install imagick && docker-php-ext-enable imagick

RUN pecl install apcu && docker-php-ext-enable apcu

RUN pecl install memcached && docker-php-ext-enable memcached

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN echo "expose_php=off" > /usr/local/etc/php/conf.d/disable_expose_php.ini

RUN echo "apc.enable_cli=1" > /usr/local/etc/php/conf.d/apc_cli.ini

RUN set -eux; \
    composer install --optimize-autoloader --no-dev;

COPY ./docker/php-fpm/currencyFetchJob /etc/cron.d/currencyFetchJob

RUN chmod 0644 /etc/cron.d/currencyFetchJob

RUN crontab /etc/cron.d/currencyFetchJob

COPY ./docker/php-fpm/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

CMD ["docker-entrypoint.sh"]
