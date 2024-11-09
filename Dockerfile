FROM php:8.3.10-fpm

WORKDIR /var/www

RUN apt-get update && apt-get -f -y install build-essential unzip wget

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www

RUN chown -R www-data:www-data /var/www
