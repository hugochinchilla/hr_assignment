FROM php:8.0.3-alpine

RUN apk add --no-cache git unzip
RUN docker-php-ext-install mysqli pdo pdo_mysql

# install xdebug but don't enable, it's loaded in runtime with phpstorm when a debug session is used
RUN apk add --no-cache $PHPIZE_DEPS && pecl install xdebug
RUN find / -name "xdebug.so" -exec ln -s {} /usr/local/lib/php/extensions/xdebug.so \;

WORKDIR /code
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
ADD composer.json /code/
RUN composer install

ADD . /code
