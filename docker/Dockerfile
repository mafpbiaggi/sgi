# syntax=docker/dockerfile:1.7

# =============================================================================
# Stage 0: base PHP
# =============================================================================
FROM php:8.5.12-apache AS base
COPY --from=ghcr.io/mlocati/php-extension-installer:2 /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql zip bcmath intl

# =============================================================================
# Stage 1: dependências PHP + geração do Wayfinder
# =============================================================================
FROM base AS vendor

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN --mount=type=cache,target=/tmp/composer-cache \
    composer install \
        --no-dev --no-interaction --no-progress \
        --no-scripts --no-autoloader --prefer-dist

COPY artisan ./
COPY bootstrap/ bootstrap/
COPY config/ config/
COPY routes/ routes/
COPY app/ app/
COPY database/ database/

RUN mkdir -p storage/framework/views storage/framework/cache/data storage/framework/sessions storage/logs \
    && composer dump-autoload --optimize --no-dev --no-scripts \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && php artisan route:clear \
    && php artisan wayfinder:generate --with-form

# =============================================================================
# Stage 2: build do frontend
# =============================================================================
FROM node:24.12-alpine AS assets

WORKDIR /app

COPY package.json pnpm-lock.yaml pnpm-workspace.yaml ./

RUN --mount=type=cache,target=/pnpm/store \
    corepack enable \
    && corepack install \
    && pnpm install --frozen-lockfile --store-dir /pnpm/store

COPY vite.config.* tsconfig*.json ./
COPY public/ public/
COPY resources/ resources/

COPY --from=vendor /var/www/html/resources/js/actions ./resources/js/actions
COPY --from=vendor /var/www/html/resources/js/routes ./resources/js/routes
COPY --from=vendor /var/www/html/resources/js/wayfinder ./resources/js/wayfinder

ENV SKIP_WAYFINDER=1

RUN pnpm run build

# =============================================================================
# Stage 3: runtime PHP/Apache
# =============================================================================
FROM base AS runtime

RUN a2enmod rewrite headers expires

COPY build-utils/opcache-prod.ini /usr/local/etc/php/conf.d/opcache-prod.ini
COPY build-utils/php-limits.ini /usr/local/etc/php/conf.d/php-limits.ini
COPY build-utils/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY --chmod=755 build-utils/entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

COPY --from=vendor /var/www/html/vendor ./vendor
COPY VERSION artisan composer.json ./
COPY bootstrap/ bootstrap/
COPY config/ config/
COPY database/ database/
COPY routes/ routes/
COPY resources/views/ resources/views/
COPY public/ public/
COPY --from=assets /app/public/build ./public/build
COPY app/ app/

RUN mkdir -p \
        storage/logs \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/app/public \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && ln -sfn /var/www/html/storage/app/public /var/www/html/public/storage

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    APACHE_DOCUMENT_ROOT=/var/www/html

RUN apt-get remove --purge -y linux-libc-dev \
    && rm -rf /var/lib/apt/lists/*

USER www-data
EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]