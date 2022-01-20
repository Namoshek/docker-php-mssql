FROM namoshek/php-mssql:8.1-fpm-alpine

# Install the Swoole PHP extension.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions swoole
