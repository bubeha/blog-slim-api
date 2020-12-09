ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm-alpine

RUN apk update && apk add --no-cache $PHPIZE_DEPS

CMD ["php-fpm"]
