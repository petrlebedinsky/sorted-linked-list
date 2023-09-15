FROM php:8.1-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN pecl install xdebug &&  \
    docker-php-ext-enable xdebug

CMD tail -f /dev/null
