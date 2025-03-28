FROM php:8.2.1-fpm as php

RUN apt-get update && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx libonig-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath curl opcache mbstring

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY --chown=www-data:www-data . .

RUN chown -R www-data:www-data /app && chmod -R 775 /app

RUN usermod --uid 1000 www-data \
    && groupmod --gid 1000 www-data

ENTRYPOINT [ "docker/entrypoint.sh" ]