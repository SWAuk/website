FROM php:7.2-cli

# install the php zip ext so we can zip stuff
RUN apt-get update \
	&& apt-get install -y libzip-dev zip \
	&& rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-install -j$(nproc) zip

RUN mkdir /swa

ENTRYPOINT /bin/bash

WORKDIR /swa
