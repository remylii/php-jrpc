FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev openssl zlib1g-dev
RUN docker-php-ext-install pdo_mysql zip

RUN apt-get install -y zip unzip vim

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /usr/src/app
COPY . .

EXPOSE 9000
