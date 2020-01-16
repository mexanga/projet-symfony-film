#!/bin/sh

cp .env.docker .env
composer dumpa
composer install
npm install
docker cp . symfony-film-web:/var/www/project
docker-compose up --build -d
docker exec -it symfony-film-web bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"
docker cp ./public/index.php symfony-film-web:/var/www/project/public/index.php
