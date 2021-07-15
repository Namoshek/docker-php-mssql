FROM php:8.0-cli-alpine3.13

ENV ACCEPT_EULA=Y

# Install prerequisites required for tools and extensions installed later on.
RUN apk add --update bash gnupg libpng-dev libzip-dev nano nodejs npm su-exec unzip

# Install yarn as global npm package.
RUN npm install -g yarn

# Install prerequisites for the sqlsrv and pdo_sqlsrv PHP extensions.
RUN curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.7.1.1-1_amd64.apk \
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.7.1.1-1_amd64.apk \
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.7.1.1-1_amd64.sig \
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.7.1.1-1_amd64.sig \
    && curl https://packages.microsoft.com/keys/microsoft.asc  | gpg --import - \
    && gpg --verify msodbcsql17_17.7.1.1-1_amd64.sig msodbcsql17_17.7.1.1-1_amd64.apk \
    && gpg --verify mssql-tools_17.7.1.1-1_amd64.sig mssql-tools_17.7.1.1-1_amd64.apk \
    && apk add --allow-untrusted msodbcsql17_17.7.1.1-1_amd64.apk mssql-tools_17.7.1.1-1_amd64.apk \
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
