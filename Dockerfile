FROM php:8.2.15-alpine
WORKDIR /var/www

RUN set -eux \
    && apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .
EXPOSE 80
CMD composer install --optimize-autoloader && php -S 0.0.0.0:80 -t public