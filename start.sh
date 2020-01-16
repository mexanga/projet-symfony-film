#!/bin/sh

composer dumpa
docker cp . symfony-5_web_1:/var/www/project
docker-compose up --build -d
docker exec -it symfony-5_web_1 bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"

# Pour lancer le container :
#
# sh start.sh
# docker exec -it symfony-5_web_1 bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"