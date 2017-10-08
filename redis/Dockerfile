FROM ubuntu:16.04

ENV REDIS_VERSION  3.2.11

ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/redis/docker_run.sh  /docker_run.sh

RUN CPU_NUM=`cat /proc/cpuinfo | grep processor | wc -l`                                \

&& sed -r -i -e "s/archive.ubuntu.com/mirrors.sohu.com/g" /etc/apt/sources.list         \

&& apt-get -y update            \
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
libsnmp-dev                     \
libtidy-dev                     \
libpq-dev                       \
liblz4-dev                      \

&& ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h             \
&& ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so           \
&& ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so           \

&& groupadd appserver                                                       \
&& useradd -g appserver -M -d /usr/local/redis redis -s /sbin/nologin       \

&& cd /usr/local/src                                                        \
&& wget http://download.redis.io/releases/redis-${REDIS_VERSION}.tar.gz     \
&& tar -zxvf redis-${REDIS_VERSION}.tar.gz                                  \

&& cd /usr/local/src/redis-${REDIS_VERSION}                                 \
&& make -j${CPU_NUM} && make PREFIX=/usr/local/redis install                \

&& mkdir /usr/local/redis/working_dir                                       \

&& cd /usr/local/src                                                        \
&& wget https://raw.githubusercontent.com/qwerty199369/docker-library/master/redis/conf/redis.conf \
&& yes | cp ./redis.conf                /usr/local/redis/conf_file.conf     \

&& rm -rf /usr/local/src/*                                                  \

&& chmod 777 /docker_run.sh                                                 \

&& chown -R redis:appserver        /usr/local/redis

EXPOSE 6379

CMD ["/docker_run.sh"]
