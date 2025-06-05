# FROM php:8.3.4-fpm-alpine3.19
FROM php:8.3-fpm-alpine

# Copy the php config file
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
# # Instala o Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN composer install

# Copy the application code
COPY . /app

VOLUME ["/app"]
