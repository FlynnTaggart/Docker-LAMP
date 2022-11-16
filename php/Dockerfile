FROM php:8-apache
RUN docker-php-ext-install mysqli
RUN a2enmod authn_dbd
RUN a2enmod rewrite
RUN apt-get update
RUN pecl uninstall redis
RUN apt-get install -y apache2-utils libaprutil1-dbd-mysql
RUN pecl install redis
RUN docker-php-ext-enable redis