FROM php:8.2-fpm

RUN apk add --no-cache bash;

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip imagemagick libmagickwand-dev --no-install-recommends \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && pecl install imagick \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-enable imagick

WORKDIR /var/www/html/croppa

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "sukhdev.mohan@gmail.com" \ 
    && git config --global user.name "Sukhdev Mohan"