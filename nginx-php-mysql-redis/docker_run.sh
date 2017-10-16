#!/bin/bash

chown -R nginx:appserver  /usr/local/nginx
chown -R php:appserver    /usr/local/php
chown -R mysql:appserver  /usr/local/mysql
chown -R redis:appserver  /usr/local/redis

# start mysql
if [ -z "$(ls -A /usr/local/mysql/datadir)" ]; then
   /usr/local/mysql/bin/mysqld --defaults-file=/etc/my.cnf --initialize-insecure --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/datadir
   sleep 1s
fi

/usr/local/mysql/support-files/mysql.server start
sleep 1s
chmod 777 /tmp/mysql.sock

# start php-fpm
/usr/local/php/sbin/php-fpm

# start redis-server
/usr/local/redis/bin/redis-server /usr/local/redis/conf_file.conf

exec /usr/local/nginx/sbin/nginx -g "daemon off;"
