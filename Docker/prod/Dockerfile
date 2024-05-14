FROM dunglas/frankenphp

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN install-php-extensions  \
    pcntl \
    zip bcmath redis intl gd \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

COPY . /app


RUN composer install \
    --no-interaction \
    --no-dev

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--workers=16"]
