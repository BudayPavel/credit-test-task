FROM php:8.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apt-get update \
    && apt-get install -y \
        librabbitmq-dev \
        libssh-dev \
        libzip-dev \
        unzip \
        git \
        wget \
        libpq-dev \
        libxslt-dev \
        libgcrypt-dev \
        libicu-dev \
    && docker-php-ext-install \
        bcmath \
        pdo \
        pdo_pgsql \
        pgsql \
        sockets \
        pdo_mysql \
        pcntl \
        zip \
        xsl \
        intl \
    && docker-php-ext-configure \
        intl \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb.so \
    && wget https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    && chmod u+x ./install-php-extensions \
    && ./install-php-extensions redis amqp gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && mkdir -p /var/www/app/var/files \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && echo memory_limit = -1 >> /usr/local/etc/php/conf.d/docker-php-limit.ini

WORKDIR /app
