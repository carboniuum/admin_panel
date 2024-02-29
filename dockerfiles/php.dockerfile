FROM php:8.0-fpm-alpine

WORKDIR /var/www/html

COPY laravel .

RUN docker-php-ext-install pdo pdo_mysql

ENV PHPUSER=laravel

RUN addgroup -g 1000 ${PHPUSER} && adduser -G ${PHPUSER} -g ${PHPUSER} -s /bin/sh -D ${PHPUSER}

USER ${PHPUSER}
