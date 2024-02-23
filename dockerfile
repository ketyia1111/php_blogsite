FROM php:apache

WORKDIR /var/www/html

COPY . /var/www/html

RUN docker-php-ext-install pdo_mysql