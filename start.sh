#!/bin/sh

cp .env.docker .env
composer clear-cache
composer dumpa
sudo composer install
sudo npm install
sudo docker cp . symfony-film-web:/var/www/project
sudo docker-compose up --build -d
sudo docker exec -it symfony-film-web bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"
sudo docker cp ./public/index.php symfony-film-web:/var/www/project/public/index.php
