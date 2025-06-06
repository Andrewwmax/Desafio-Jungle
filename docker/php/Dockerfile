# FROM php:8.3.4-fpm-alpine3.19
FROM php:8.3-fpm-alpine

WORKDIR /app

# Copy the php config file
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY . /app

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --prefer-dist --no-scripts --no-interaction

# Copy the application code

VOLUME ["/app"]
