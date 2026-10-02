FROM php:8.3-apache

# GD (JPEG/PNG/WebP) dla image.php
RUN apt-get update \
    && apt-get install -y --no-install-recommends libjpeg62-turbo-dev libpng-dev libwebp-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install -j"$(nproc)" gd \
    && apt-get purge -y --auto-remove libjpeg62-turbo-dev libpng-dev libwebp-dev libfreetype6-dev \
    && apt-get install -y --no-install-recommends libjpeg62-turbo libpng16-16 libwebp7 libwebpdemux2 libwebpmux3 libfreetype6 \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers expires deflate remoteip \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/php.ini "$PHP_INI_DIR/conf.d/zz-legacyevents.ini"
COPY docker/apache.conf /etc/apache2/conf-enabled/zz-legacyevents.conf

WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

RUN mkdir -p cache data assets/blog assets/Events \
    && chown -R www-data:www-data cache data assets/blog assets/Events

VOLUME ["/var/www/html/cache", "/var/www/html/data", "/var/www/html/assets/blog", "/var/www/html/assets/Events"]
EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -fsS -o /dev/null http://127.0.0.1/robots.txt || exit 1
