FROM php:7.3-fpm

RUN apt-get update \
	&& apt-get install -y zlib1g-dev libzip-dev libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install opcache \
    && docker-php-ext-install pdo pdo_pgsql

CMD ["php-fpm", "-F"]

WORKDIR /var/www/app

COPY bin/composer bin/php-cs-fixer bin/.php_cs /usr/bin/

EXPOSE 9000