ARG PHP_VERSION

FROM php:${PHP_VERSION}-cli-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /application
