FROM php:7-apache
RUN docker-php-ext-install mysqli
RUN a2enmod authn_dbd
RUN a2enmod rewrite
RUN apt-get update
RUN pecl uninstall redis
RUN apt-get install -y apache2-utils libaprutil1-dbd-mysql
RUN pecl install redis
RUN docker-php-ext-enable redis
RUN mkdir -p /var/www/my-html/uploads/
RUN chown root /var/www/my-html/uploads/ && chmod -R 777 /var/www/my-html/uploads/
RUN apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN apt-get install -y sendmail libpng-dev
RUN docker-php-ext-install gd
RUN apt-get -y install tnef \
	&& rm -rf /var/lib/apt/lists/* \
	&& curl -o jpgraph.tar.gz -SL "https://jpgraph.net/download/download.php?p=55" \
	&& mkdir -p /var/www/html/jpgraph \
	&& tar -xzf jpgraph.tar.gz --strip-components=1 -C /var/www/html/jpgraph \
	&& rm jpgraph.tar.gz
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY composer.json /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --prefer-source --no-interaction