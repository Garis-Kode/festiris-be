ARG NODE_VERSION=20

FROM node:20-alpine as node

FROM php:8.2-fpm-alpine
LABEL maintainer="Andrian Putra Ramadan <ramadanandrian89@gmail.com>"

ENV WWWGROUP=1000
ENV WWWUSER=1000

WORKDIR /var/www

COPY ./composer.json ./

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install some dependencies
RUN apk update && apk add --no-cache \
    build-base \
    gnupg \
    curl \
    ca-certificates \
    zip \
    unzip \
    git \
    supervisor \
    sqlite \
    libcap \
    libpng \
    python3 \
    bind-tools \
    librsvg \
    gd-dev \
    ffmpeg \
    bash \
    jq && \
    rm -rf /var/cache/apk/*

# Install PHP extensions
RUN install-php-extensions pdo_mysql \
    zip \
    exif  \
    pcntl  \
    gd  \
    mysqli \
    bcmath \
    calendar \
    intl \
    xml \
    mysqli \
    opcache \
    pdo \
    pdo_mysql \
    pgsql \
    zip \
    redis \
    pgsql \
    pdo_pgsql \
    swoole \
    igbinary \
    imagick \
    msgpack \
    memcached \
    xdebug \
    ldap \
    soap \
    pcov \
    && docker-php-ext-configure gd --with-external-gd

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "copy('https://composer.github.io/installer.sig', 'signature');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('signature'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"


# Install NodeJS
COPY --from=node /usr/lib /usr/lib
COPY --from=node /usr/local/lib /usr/local/lib
COPY --from=node /usr/local/include /usr/local/include
COPY --from=node /usr/local/bin /usr/local/bin

RUN addgroup -g 1000 www && \
    adduser -u 1000 -G www -s /bin/bash -D www

USER www

COPY --chown=www:www . /var/www

EXPOSE 9000

CMD ["php-fpm"]



