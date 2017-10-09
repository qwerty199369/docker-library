FROM ubuntu:16.04

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


ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/mysql/conf/generated.my.cnf  /etc/my.cnf

ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/nginx-php-mysql-redis/docker_run.sh  /docker_run.sh

RUN chmod +x /docker_run.sh

RUN sed -r -i -e "s/archive.ubuntu.com/mirrors.163.com/g" /etc/apt/sources.list
RUN sed -r -i -e "s/security.ubuntu.com/mirrors.163.com/g" /etc/apt/sources.list

RUN apt-get -y update           \
&& apt-get -y upgrade           \

&& apt-get -y install wget      \
gcc                             \
g++                             \
automake                        \
autoconf                        \
libtool                         \
make                            \
cmake                           \
libedit-dev                     \
libeditline-dev                 \
libldb-dev                      \
libldap2-dev                    \
libsasl2-dev                    \
zlib1g-dev                      \
libpcre3-dev                    \
libfreetype6-dev                \
libpng12-dev                    \
libevent-dev                    \
libmcrypt-dev                   \
libjpeg-dev                     \
libjemalloc-dev                 \
libxml2-dev                     \
libbz2-dev                      \
libcurl3-dev                    \
libc6-dev                       \
libc-client2007e-dev            \
libglib2.0-dev                  \
openssl                         \
libssl-dev                      \
libbison-dev                    \
libncurses5-dev                 \
libgd-dev                       \
libfl-dev                       \
libwebp-dev                     \
libasprintf-dev                 \
libgmp-dev                      \
libaio-dev                      \
libreadline-dev                 \
librecode-dev                   \
libxslt1-dev                    \
libicu-dev                      \
zip                             \
libzip-dev                      \
libgeoip-dev                    \
libatomic-ops-dev               \
libacl1-dev                     \
libenchant-dev                  \
libkrad-dev                     \
libkrb5-dev                     \
libldap2-dev                    \
libaspell-dev                   \
libpspell-dev                   \
libtidy-dev                     \
libpq-dev                       \
p7zip                           \
liblz4-dev                      \

&& apt-get clean

RUN CPU_NUM=`cat /proc/cpuinfo | grep processor | wc -l`                    \

&& ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h             \
&& ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so           \
&& ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so           \

&& groupadd appserver                                                       \
&& useradd -g appserver -M -d /usr/local/nginx nginx -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/php   php   -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/mysql mysql -s /sbin/nologin       \
&& useradd -g appserver -M -d /usr/local/redis redis -s /sbin/nologin       \

&& cd /usr/local/src                                                        \

&& wget https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz            \
&& wget https://www.openssl.org/source/openssl-${OPENSSL_VERSION}.tar.gz    \
&& wget https://ftp.pcre.org/pub/pcre/pcre-${PCRE_VERSION}.tar.gz           \
&& wget http://zlib.net/zlib-${ZLIB_VERSION}.tar.gz                         \
&& tar -zxvf nginx-${NGINX_VERSION}.tar.gz                                  \
&& tar -zxvf openssl-${OPENSSL_VERSION}.tar.gz                              \
&& tar -zxvf pcre-${PCRE_VERSION}.tar.gz                                    \
&& tar -zxvf zlib-${ZLIB_VERSION}.tar.gz                                    \

&& wget http://cn2.php.net/distributions/php-${PHP_VERSION}.tar.gz          \
&& tar -zxvf php-${PHP_VERSION}.tar.gz                                      \

&& wget http://ideas-cdn-src.oss-cn-beijing.aliyuncs.com/assets/softs/percona-server-${PERCONA_VERSION}.tar.gz \
&& wget http://ideas-cdn-src.oss-cn-beijing.aliyuncs.com/assets/softs/boost_${BOOST_VERSION}.tar.gz \
&& tar -zxvf percona-server-${PERCONA_VERSION}.tar.gz                       \
&& tar -zxvf boost_${BOOST_VERSION}.tar.gz                                  \

&& wget http://download.redis.io/releases/redis-${REDIS_VERSION}.tar.gz     \
&& tar -zxvf redis-${REDIS_VERSION}.tar.gz                                  \

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
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/nginx/conf/nginx.conf \
&& yes | cp ./nginx.conf  /usr/local/nginx/conf/nginx.conf          \
&& rm -rf ./nginx.conf                                              \

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
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/php-fpm.conf \
&& yes | cp ./php-fpm.conf      /usr/local/php/etc/                 \
&& rm -rf ./php-fpm.conf                                            \

&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/www.conf \
&& yes | cp ./www.conf          /usr/local/php/etc/php-fpm.d/       \
&& rm -rf ./www.conf                                                \

&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf2/php.ini \
&& yes | cp ./php.ini           /usr/local/php/lib/                 \
&& rm -rf ./php.ini                                                 \

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

&& /usr/local/mysql/bin/mysqld --defaults-file=/etc/my.cnf          \
--initialize-insecure                                               \
--user=mysql                                                        \
--basedir=/usr/local/mysql                                          \
--datadir=/usr/local/mysql/datadir                                  \

&& rm -rf                       /usr/local/mysql/mysql-test         \

&& chown -R mysql:appserver     /usr/local/mysql                    \
&& /usr/local/mysql/support-files/mysql.server start                \
&& chmod 777 /tmp/mysql.sock                                        \
&& /usr/local/mysql/support-files/mysql.server stop                 \
&& chown -R mysql:appserver    /usr/local/mysql                     \






&& cd /usr/local/src/redis-${REDIS_VERSION}                                 \
&& make -j${CPU_NUM} && make PREFIX=/usr/local/redis install                \

&& mkdir /usr/local/redis/working_dir                                       \

&& cd /usr/local/src                                                        \
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/redis/conf2/redis.conf \
&& yes | cp ./redis.conf                /usr/local/redis/conf_file.conf     \
&& rm -rf   ./redis.conf                                                    \

&& chown -R redis:appserver             /usr/local/redis                    \
&& /usr/local/redis/bin/redis-server    /usr/local/redis/conf_file.conf     \
&& /usr/local/redis/bin/redis-cli       shutdown                            \


&& rm -rf /usr/local/src/*

EXPOSE 80 443

CMD ["/docker_run.sh"]
