#!/bin/sh

for version in */ ; do
    for path in $version/*/ ; do
        slug=${path/\/\//-}
        tag=${slug::-1}
        docker build -t namoshek/php-mssql:$tag $path
    done
done
