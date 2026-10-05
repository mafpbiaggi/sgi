FROM php:5.6-apache
RUN docker-php-ext-install pdo pdo_mysql && a2enmod rewrite

WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

USER www-data
