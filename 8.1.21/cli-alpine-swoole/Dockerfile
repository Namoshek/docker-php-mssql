FROM namoshek/php-mssql:8.1.21-cli-alpine

# Install the Swoole PHP extension.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions swoole
