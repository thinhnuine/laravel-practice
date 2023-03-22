FROM php:8.1-fpm

COPY php.ini-development /usr/local/etc/php/php.ini
RUN apt-get update && \
  apt-get install -y --no-install-recommends \
  ca-certificates \
  curl \
  xz-utils \
  git \
  libgmp-dev \
  unzip \
  libzip-dev \
  lsb-release \
  ffmpeg \
  libmemcached-dev
RUN pecl install memcached
RUN docker-php-ext-enable memcached
RUN docker-php-ext-install pdo_mysql

# php composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# php-fpm config
#COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
WORKDIR /app