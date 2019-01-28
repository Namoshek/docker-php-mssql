#!/bin/sh

for version in */ ; do
    for path in $version/*/ ; do
        slug=${path/\/\//-}
        tag=${slug::-1}
        docker build -t namoshek/php-mssql:$tag $path
        docker push namoshek/php-mssql:$tag
    done
done
