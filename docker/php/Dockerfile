# FROM php:8.3.4-fpm-alpine3.19
FROM php:8.3-fpm-alpine

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivo de configuração do php-fpm
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia o projeto
COPY . /var/www/html

CMD composer install --no-interaction --prefer-dist --optimize-autoloader && php-fpm