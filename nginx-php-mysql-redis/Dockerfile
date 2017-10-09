FROM qwerty199369/image-base-ubuntu:16.04.0

MAINTAINER qwerty199369 <qwerty199369@outlook.com>

ENV NGINX_VERSION           1.13.5
ENV OPENSSL_VERSION         1.0.2l
ENV PCRE_VERSION            8.41
ENV ZLIB_VERSION            1.2.11

ENV PHP_VERSION             7.1.10

ENV MYSQL_VERSION           5.7.19
ENV PERCONA_VERSION         5.7.19-17
ENV BOOST_VERSION           1_59_0
ENV BOOST_NORMAL_VERSION    1.59.0

ENV REDIS_VERSION           3.2.11


ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/mysql/conf/generated.my.cnf \
/etc/my.cnf
ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/nginx-php-mysql-redis/docker_run.sh \
/docker_run.sh
RUN chmod +x /docker_run.sh

ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/nginx/conf/nginx.conf \
/usr/local/src/nginx_nginx.conf
ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/php-fpm.conf \
/usr/local/src/php_php-fpm.conf
ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/www.conf \
/usr/local/src/php_www.conf
ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/php.ini \
/usr/local/src/php_php.ini
ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/redis/conf2/redis.conf \
/usr/local/src/redis_redis.conf

RUN CPU_NUM=`cat /proc/cpuinfo | grep processor | wc -l`                    \

&& groupadd appserver                                                       \
&& useradd -g appserver -M -d /usr/local/nginx nginx -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/php   php   -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/mysql mysql -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/redis redis -s /sbin/nologin       \

&& cd /usr/local/src                                                        \

&& wget https://docker-assets.oss-cn-shanghai.aliyuncs.com/src/nginx/nginx-${NGINX_VERSION}.tar.gz       \
&& wget http://docker-assets.oss-cn-shanghai.aliyuncs.com/src/openssl/openssl-${OPENSSL_VERSION}.tar.gz  \
&& wget http://docker-assets.oss-cn-shanghai.aliyuncs.com/src/pcre/pcre-${PCRE_VERSION}.tar.gz           \
&& wget http://docker-assets.oss-cn-shanghai.aliyuncs.com/src/zlib/zlib-${ZLIB_VERSION}.tar.gz           \
&& tar -zxvf nginx-${NGINX_VERSION}.tar.gz                                  \
&& tar -zxvf openssl-${OPENSSL_VERSION}.tar.gz                              \
&& tar -zxvf pcre-${PCRE_VERSION}.tar.gz                                    \
&& tar -zxvf zlib-${ZLIB_VERSION}.tar.gz                                    \

&& wget https://docker-assets.oss-cn-shanghai.aliyuncs.com/src/php/php-${PHP_VERSION}.tar.gz    \
&& tar -zxvf php-${PHP_VERSION}.tar.gz                                                          \

&& wget https://docker-assets.oss-cn-shanghai.aliyuncs.com/src/percona/percona-server-${PERCONA_VERSION}.tar.gz \
&& wget https://docker-assets.oss-cn-shanghai.aliyuncs.com/src/boost/boost_${BOOST_VERSION}.tar.gz \
&& tar -zxvf percona-server-${PERCONA_VERSION}.tar.gz                                   \
&& tar -zxvf boost_${BOOST_VERSION}.tar.gz                                              \

&& wget https://docker-assets.oss-cn-shanghai.aliyuncs.com/src/redis/redis-${REDIS_VERSION}.tar.gz \
&& tar -zxvf redis-${REDIS_VERSION}.tar.gz                                              \

&& cd /usr/local/src/nginx-${NGINX_VERSION}                         \
&& ./configure --prefix=/usr/local/nginx                            \
--user=nginx                                                        \
--group=appserver                                                   \
--with-zlib=/usr/local/src/zlib-${ZLIB_VERSION}                     \
--with-pcre=/usr/local/src/pcre-${PCRE_VERSION}                     \
--with-pcre-jit                                                     \
--with-openssl=/usr/local/src/openssl-${OPENSSL_VERSION}            \
--with-threads                                                      \
--with-file-aio                                                     \
--with-http_ssl_module                                              \
--with-http_v2_module                                               \
--with-http_realip_module                                           \
--with-http_addition_module                                         \
--with-http_xslt_module                                             \
--with-http_xslt_module=dynamic                                     \
--with-http_image_filter_module                                     \
--with-http_image_filter_module=dynamic                             \
--with-http_geoip_module                                            \
--with-http_geoip_module=dynamic                                    \
--with-http_sub_module                                              \
--with-http_dav_module                                              \
--with-http_flv_module                                              \
--with-http_mp4_module                                              \
--with-http_gunzip_module                                           \
--with-http_gzip_static_module                                      \
--with-http_auth_request_module                                     \
--with-http_random_index_module                                     \
--with-http_degradation_module                                      \
--with-http_slice_module                                            \
--with-http_secure_link_module                                      \
--with-http_stub_status_module                                      \
--with-stream                                                       \
--with-stream=dynamic                                               \
--with-stream_ssl_module                                            \
--with-stream_realip_module                                         \
--with-stream_geoip_module                                          \
--with-stream_geoip_module=dynamic                                  \
--with-stream_ssl_preread_module                                    \
--with-ld-opt="-ljemalloc"                                          \

&& make -j${CPU_NUM} && make install                                \

&& mkdir /usr/local/nginx/vhosts_dir                                \

&& cd /usr/local/src                                                \
&& yes | cp ./nginx_nginx.conf  /usr/local/nginx/conf/nginx.conf    \

&& chown -R nginx:appserver        /usr/local/nginx                 \
&& /usr/local/nginx/sbin/nginx -t                                   \
&& /usr/local/nginx/sbin/nginx                                      \
&& /usr/local/nginx/sbin/nginx -s stop                              \





&& cd /usr/local/src/php-${PHP_VERSION}                             \
&& ./configure --prefix=/usr/local/php                              \
--enable-fpm                                                        \
--with-fpm-user=php                                                 \
--with-fpm-group=appserver                                          \
--disable-short-tags                                                \
--with-openssl                                                      \
--with-openssl-dir                                                  \
--with-pcre-regex                                                   \
--with-pcre-dir                                                     \
--with-zlib                                                         \
--with-zlib-dir                                                     \
--with-bz2                                                          \
--enable-calendar                                                   \
--with-curl                                                         \
--with-libxml-dir                                                   \
--enable-opcache                                                    \
--enable-exif                                                       \
--enable-ftp                                                        \
--with-gd                                                           \
--enable-gd-native-ttf                                              \
--enable-gd-jis-conv                                                \
--with-jpeg-dir                                                     \
--with-png-dir                                                      \
--with-webp-dir                                                     \
--with-xpm-dir                                                      \
--with-freetype-dir                                                 \
--with-gettext                                                      \
--with-gmp                                                          \
--with-mhash                                                        \
--with-readline                                                     \
--enable-intl                                                       \
--with-icu-dir=/usr                                                 \
--with-ldap                                                         \
--with-ldap-sasl                                                    \
--enable-mbstring                                                   \
--enable-pdo                                                        \
--enable-mysqlnd                                                    \
--with-mysqli=mysqlnd                                               \
--with-pdo-mysql=mysqlnd                                            \
--with-mysql-sock=/tmp/mysql.sock                                   \
--with-recode                                                       \
--enable-bcmath                                                     \
--enable-pcntl                                                      \
--enable-shmop                                                      \
--enable-zip                                                        \
--with-iconv                                                        \
--with-iconv-dir                                                    \
--with-libzip                                                       \
--with-pspell                                                       \
--with-tidy                                                         \
--with-libxml-dir                                                   \
--with-xmlrpc                                                       \
--enable-soap                                                       \
--enable-wddx                                                       \
--enable-sockets                                                    \
--with-xsl                                                          \
--enable-opcache                                                    \
--with-pear                                                         \

&& make -j${CPU_NUM} && make install                                \

&& cd /usr/local/src                                                \
&& yes | cp ./php_php-fpm.conf /usr/local/php/etc/php-fpm.conf      \
&& yes | cp ./php_www.conf     /usr/local/php/etc/php-fpm.d/www.conf \
&& yes | cp ./php_php.ini      /usr/local/php/lib/php.ini           \

&& chown -R php:appserver        /usr/local/php                     \
&& /usr/local/php/sbin/php-fpm                                      \
&& kill -INT `cat /usr/local/php/var/run/php-fpm.pid`               \





&& cd /usr/local/src/percona-server-${PERCONA_VERSION}              \
&& cmake -DCMAKE_INSTALL_PREFIX=/usr/local/mysql                    \
-DDEFAULT_CHARSET=utf8mb4                                           \
-DDEFAULT_COLLATION=utf8mb4_unicode_ci                              \
-DENABLED_LOCAL_INFILE=1                                            \
-DENABLED_PROFILING=1                                               \
-DENABLE_DOWNLOADS=0                                                \
-DWITH_LIBEVENT=system                                              \
-DWITH_SSL=system                                                   \
-DWITH_ZLIB=system                                                  \
-DWITH_LZ4=system                                                   \
-DWITH_EDITLINE=system                                              \
-DWITH_SYSTEMD=0                                                    \
-DSYSCONFDIR=/etc                                                   \
-DMYSQL_DATADIR=/usr/local/mysql/datadir                            \
-DTMPDIR=/usr/local/mysql/tmpdir                                    \
-DMYSQL_UNIX_ADDR=/tmp/mysql.sock                                   \
-DWITH_BOOST=/usr/local/src/boost_${BOOST_VERSION}                  \
-DMYSQL_TCP_PORT=3306                                               \
-DWITH_INNOBASE_STORAGE_ENGINE=1                                    \
-DWITH_ARCHIVE_STORAGE_ENGINE=1                                     \
-DWITH_BLACKHOLE_STORAGE_ENGINE=1                                   \
-DWITH_EXAMPLE_STORAGE_ENGINE=1                                     \
-DWITH_FEDERATED_STORAGE_ENGINE=1                                   \
-DWITH_PARTITION_STORAGE_ENGINE=1                                   \
-DWITH_PERFSCHEMA_STORAGE_ENGINE=1                                  \
-DWITH_ROCKSDB=1                                                    \
-DWITH_TOKUDB=1                                                     \
-DWITH_EXTRA_CHARSETS=all                                           \

&& make -j${CPU_NUM} && make install                                \

&& mkdir /usr/local/mysql/datadir                                   \
&& mkdir /usr/local/mysql/tmpdir                                    \

&& chown -R mysql:appserver /usr/local/mysql                        \
&& chown -R mysql:appserver /etc/my.cnf                             \

&& rm -rf                       /usr/local/mysql/mysql-test         \





&& cd /usr/local/src/redis-${REDIS_VERSION}                                 \
&& make -j${CPU_NUM} && make PREFIX=/usr/local/redis install                \

&& mkdir /usr/local/redis/working_dir                                       \

&& cd /usr/local/src                                                        \
&& yes | cp ./redis_redis.conf          /usr/local/redis/conf_file.conf     \

&& chown -R redis:appserver             /usr/local/redis                    \
&& /usr/local/redis/bin/redis-server    /usr/local/redis/conf_file.conf     \
&& /usr/local/redis/bin/redis-cli       shutdown                            \


&& rm -rf /usr/local/src/*

EXPOSE 80 443

CMD ["/docker_run.sh"]
