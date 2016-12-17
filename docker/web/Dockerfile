FROM php:7.0-apache

MAINTAINER Pascal Liniger <pascal.liniger@gmail.com>

# Install mysqli
RUN docker-php-ext-install mysqli

# Setup phpunit
RUN apt-get update && apt-get install -y wget \
	&& wget https://phar.phpunit.de/phpunit.phar \
	&& chmod +x phpunit.phar \
	&& mv phpunit.phar /usr/bin/phpunit

COPY runTests.sh /usr/bin/runTests

