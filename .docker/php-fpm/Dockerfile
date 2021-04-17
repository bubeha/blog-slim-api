ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm-alpine

ARG XDEBUG_VERSION

RUN apk update && apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-$XDEBUG_VERSION \
    && docker-php-ext-enable xdebug

COPY ./etc/php.ini /usr/local/etc/php/conf.d/php.ini

CMD ["php-fpm"]
