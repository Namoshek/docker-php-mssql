FROM php:7.3-fpm-stretch

ENV ACCEPT_EULA=Y

RUN apt-get update \
    && apt-get install -y gnupg2 apt-transport-https libpng-dev libzip-dev \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && apt-get install -y msodbcsql17 mssql-tools unixodbc-dev

RUN pecl install sqlsrv-5.5.0preview \
    && pecl install pdo_sqlsrv-5.5.0preview \
    && docker-php-ext-enable --ini-name 30-sqlsrv.ini sqlsrv \
    && docker-php-ext-enable --ini-name 35-pdo_sqlsrv.ini pdo_sqlsrv

RUN docker-php-ext-install bcmath pcntl gd zip
