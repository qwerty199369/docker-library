### NGINX + PHP + MYSQL + REDIS
```bash
docker run \
 -v /appserver/nginx/vhosts_dir:/usr/local/nginx/vhosts_dir:rw \
 -v /appserver/mysql/datadir:/usr/local/mysql/datadir:rw \
 -p 80:80 \
 -p 443:443 \
 -d qwerty199369/nginx-php-mysql-redis:1.1.3
```

### RELOAD NGINX
```bash
docker exec -d CONTAINER /usr/local/nginx/sbin/nginx -s reload
```

### ENABLE PUBLIC ACCESS OF MYSQL
```bash
sed -r -i -e "s/127.0.0.1/0.0.0.0/g" /etc/my.cnf
/usr/local/mysql/support-files/mysql.server restart

/usr/local/mysql/bin/mysql -uroot -p
use mysql;
update `user` set `Host` = '%' where `User` = 'root' and `Host` = 'localhost';
flush privileges;
```

### COMPOSER
```bash
/usr/local/php/bin/php composer.phar update --prefer-dist --no-dev --optimize-autoloader -vvv
```

### INIT MYSQL SERVER
```bash
chown -R mysql:appserver     /usr/local/mysql

# only for initializing data directory
/usr/local/mysql/bin/mysqld --defaults-file=/etc/my.cnf             \
--initialize-insecure                                               \
--user=mysql                                                        \
--basedir=/usr/local/mysql                                          \
--datadir=/usr/local/mysql/datadir

/usr/local/mysql/support-files/mysql.server start

chmod 777 /tmp/mysql.sock

# only for set new password of mysql
/usr/local/mysql/bin/mysqladmin -uroot password
```

### REFERENCE
- [Initializing the Data Directory Manually Using mysqld](https://dev.mysql.com/doc/refman/5.7/en/data-directory-initialization-mysqld.html)
