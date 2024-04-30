# Use an official PHP runtime as a parent image
FROM php:7.4-apache

RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd

RUN docker-php-ext-install mysqli pdo pdo_mysql gd

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git \
        unzip \
        && \
    rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN composer require phpmailer/phpmailer

COPY www/ .

EXPOSE 80

CMD ["apache2-foreground"]