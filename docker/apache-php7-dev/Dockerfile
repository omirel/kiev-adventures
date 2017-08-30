FROM php:7.1-apache

MAINTAINER Ivo Bathke <ivo.bathke@gmail.com>

RUN a2enmod rewrite

RUN apt-get update -q --fix-missing
RUN apt-get upgrade -qy
RUN apt-get install -qy \
    libmcrypt4 libxml2-utils \
    libfreetype6-dev libjpeg62-turbo-dev \
libpng12-dev libxml2-dev zlib1g-dev libicu-dev zip git

RUN apt-get install -qy \
    mysql-client

RUN apt-get install -qy \
    nodejs

RUN apt-get install -qy \
    npm

RUN npm install uglifycss -g
RUN npm install uglify-js2 -g

RUN docker-php-ext-install opcache mysqli pdo pdo_mysql intl

# Install APCu
RUN pecl install apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

COPY php.ini /usr/local/etc/php/
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

RUN usermod -u 1000 www-data

RUN rm -rf /var/www/var/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mkdir -p /var/www/app /var/www/src /var/www/var /var/www/bin /var/www/web /var/www/vendor
RUN chown -R www-data /var/www
