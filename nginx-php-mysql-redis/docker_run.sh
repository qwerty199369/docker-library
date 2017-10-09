#!/bin/bash

chown -R nginx:appserver /usr/local/nginx
chown -R php:appserver   /usr/local/php
chown -R mysql:appserver /usr/local/mysql
chown -R redis:appserver /usr/local/redis

# start php-fpm
/usr/local/php/sbin/php-fpm

# start redis-server
/usr/local/redis/bin/redis-server /usr/local/redis/conf_file.conf

exec /usr/local/nginx/sbin/nginx -g "daemon off;"
