FROM php:7.0-apache

MAINTAINER Pascal Liniger <pascal.liniger@gmail.com>

# Enable rewrite module
RUN a2enmod rewrite

# Setup phpunit
RUN apt-get update && apt-get install -y wget libfreetype6-dev libjpeg62-turbo-dev libpng12-dev \
	&& wget https://phar.phpunit.de/phpunit.phar \
	&& chmod +x phpunit.phar \
	&& mv phpunit.phar /usr/bin/phpunit

# Install mysqli
RUN docker-php-ext-install mysqli

# Install gd
RUN docker-php-ext-install gd 

COPY runTests.sh /usr/bin/runTests

