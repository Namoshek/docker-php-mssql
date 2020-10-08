# docker-php-mssql

Docker images based on the [official Docker PHP images](https://hub.docker.com/_/php/) with
the [Microsoft SQL Server Driver](https://github.com/Microsoft/msphpsql) already installed.

The images are built and retagged based on their corresponding upstream once a week at night.

## Usage

You can pull one of the images with `docker pull namoshek/php-mssql:<tag>`.
To run a container with an image, you can also use `docker run namoshek/php-mssql:<tag>` directly.

## Available Versions

For the moment, the primary goal of this repository is to support the following configurations:

- PHP 7.4 (based on Debian Buster) + Microsoft ODBC Driver 17 + sqlsrv + pdo_sqlsrv (FPM and CLI)
  - With nano, nodejs, npm, yarn and composer added to the CLI version
  - With bcmath, exif, gd, imagick, intl, opcache, pcntl, redis, and zip as additional PHP extensions
  - With pcov as additional PHP extension on the CLI image

The exact versions can vary from build to build.
To see a list of all available tags, please have a look at the [Docker Hub image page](https://hub.docker.com/r/namoshek/php-mssql).

### Deprecated Images

The Dockerfiles of the following images are no longer updated but images are still built automatically once a week.

- PHP 7.3 (based on Debian Stretch) + Microsoft ODBC Driver 17 + sqlsrv + pdo_sqlsrv (FPM and CLI)

## Configuration

To change the PHP configuration, have a look at [the official PHP Docker image repository](https://hub.docker.com/_/php/).

## Contributing

If you want to contribute the sources for other PHP versions, I'll appreciate it. Please send a pull request.

## License

The code is licensed under the [MIT license](LICENSE).
