#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
fi

php-fpm -D
nginx -g "daemon off;"
