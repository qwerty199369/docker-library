FROM ubuntu:16.04

ENV PHP_VERSION  7.1.10

RUN CPU_NUM=`cat /proc/cpuinfo | grep processor | wc -l`                                \

&& sed -r -i -e "s/archive.ubuntu.com/mirrors.sohu.com/g" /etc/apt/sources.list         \

&& apt-get -y update            \
&& apt-get -y upgrade           \

&& apt-get -y install git       \
vim                             \
wget                            \
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
snmp                            \
libsnmp-dev                     \
libtidy-dev                     \
libpq-dev                       \
p7zip                           \
p7zip-full                      \
liblz4-dev                      \

&& ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h             \
&& ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so           \
&& ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so           \

&& groupadd appserver                                                       \
&& useradd -g appserver -M -d /usr/local/php php -s /sbin/nologin           \

&& cd /usr/local/src                                                \
&& wget http://cn2.php.net/distributions/php-${PHP_VERSION}.tar.gz  \
&& tar -zxvf php-${PHP_VERSION}.tar.gz                              \

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
--with-snmp                                                         \
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
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf/php-fpm.conf \
&& yes | cp ./php-fpm.conf      /usr/local/php/etc/                 \
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf/www.conf \
&& yes | cp ./www.conf          /usr/local/php/etc/php-fpm.d/       \
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/php/conf/php.ini \
&& yes | cp ./php.ini           /usr/local/php/lib/                 \

&& ls /usr/local/php/etc/                                           \
&& ls /usr/local/php/etc/php-fpm.d/                                 \
&& ls /usr/local/php/lib/                                           \

&& rm -rf /usr/local/src/*                                          \

&& chown -R php:appserver        /usr/local/php                     \
&& /usr/local/php/sbin/php-fpm                                      \
&& chown -R php:appserver         /usr/local/php                    \
&& kill -INT `cat /usr/local/php/var/run/php-fpm.pid`

EXPOSE 9000

CMD ["chown -R php:appserver /usr/local/php && /usr/local/php/sbin/php-fpm"]
