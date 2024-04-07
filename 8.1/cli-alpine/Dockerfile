FROM php:8.1-cli-alpine

ENV ACCEPT_EULA=Y

# Install prerequisites required for tools and extensions installed later on.
RUN apk add --update bash gnupg less libpng-dev libzip-dev nano nodejs npm su-exec unzip

# Install yarn as global npm package.
RUN npm install -g yarn

# Install prerequisites for the sqlsrv and pdo_sqlsrv PHP extensions.
RUN curl -O https://download.microsoft.com/download/3/5/5/355d7943-a338-41a7-858d-53b259ea33f5/msodbcsql18_18.3.2.1-1_amd64.apk \
    && curl -O https://download.microsoft.com/download/3/5/5/355d7943-a338-41a7-858d-53b259ea33f5/mssql-tools18_18.3.1.1-1_amd64.apk \
    && curl -O https://download.microsoft.com/download/3/5/5/355d7943-a338-41a7-858d-53b259ea33f5/msodbcsql18_18.3.2.1-1_amd64.sig \
    && curl -O https://download.microsoft.com/download/3/5/5/355d7943-a338-41a7-858d-53b259ea33f5/mssql-tools18_18.3.1.1-1_amd64.sig \
    && curl https://packages.microsoft.com/keys/microsoft.asc  | gpg --import - \
    && gpg --verify msodbcsql18_18.3.2.1-1_amd64.sig msodbcsql18_18.3.2.1-1_amd64.apk \
    && gpg --verify mssql-tools18_18.3.1.1-1_amd64.sig mssql-tools18_18.3.1.1-1_amd64.apk \
    && apk add --allow-untrusted msodbcsql18_18.3.2.1-1_amd64.apk mssql-tools18_18.3.1.1-1_amd64.apk \
    && rm *.apk *.sig

# Retrieve the script used to install PHP extensions from the source container.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Install required PHP extensions and all their prerequisites available via apt.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions bcmath ds exif gd intl opcache pcntl pcov pdo_sqlsrv redis sqlsrv zip

# Downloading composer and marking it as executable.
RUN curl -o /usr/local/bin/composer https://getcomposer.org/composer-stable.phar \
    && chmod +x /usr/local/bin/composer

# Setting the work directory.
WORKDIR /var/www
