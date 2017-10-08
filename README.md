### NGINX + PHP + MYSQL + REDIS
```bash
docker run \
 -v /appserver/nginx:/appserver:rw \
 -p 80:80 \
 -d qwerty199369/fast-server-nginx:1.13.5.2 \
&& docker run \
 -v /appserver/php:/appserver:rw \
 -p 9000:9000 \
 -d qwerty199369/fast-server-php:7.1.10.3 \
&& docker run \
 -v /appserver/redis:/appserver:rw \
 -p 6379:6379 \
 -d qwerty199369/fast-server-redis:3.2.11.1
```

### MYSQL PASSWORD
```bash
/usr/local/mysql/bin/mysqladmin -uroot password
```

### REFERENCE
- [Initializing the Data Directory Manually Using mysqld](https://dev.mysql.com/doc/refman/5.7/en/data-directory-initialization-mysqld.html)
