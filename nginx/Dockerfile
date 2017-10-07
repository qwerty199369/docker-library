FROM ubuntu:16.04

ENV NGINX_VERSION       1.13.5
ENV OPENSSL_VERSION     1.0.2l
ENV PCRE_VERSION        8.41
ENV ZLIB_VERSION        1.2.11

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
&& useradd -g appserver -M -d /usr/local/nginx nginx -s /sbin/nologin       \

&& cd /usr/local/src                                                        \
&& wget https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz            \
&& wget https://www.openssl.org/source/openssl-${OPENSSL_VERSION}.tar.gz    \
&& wget https://ftp.pcre.org/pub/pcre/pcre-${PCRE_VERSION}.tar.gz           \
&& wget http://zlib.net/zlib-${ZLIB_VERSION}.tar.gz                         \

&& tar -zxvf nginx-${NGINX_VERSION}.tar.gz                                  \
&& tar -zxvf openssl-${OPENSSL_VERSION}.tar.gz                              \
&& tar -zxvf pcre-${PCRE_VERSION}.tar.gz                                    \
&& tar -zxvf zlib-${ZLIB_VERSION}.tar.gz                                    \

&& cd /usr/local/src/nginx-${NGINX_VERSION}                             \
&& ./configure --prefix=/usr/local/nginx                            \
--user=nginx                                                        \
--group=appserver                                                   \
--with-zlib=/usr/local/src/fast-server/zlib-${ZLIB_VERSION}         \
--with-pcre=/usr/local/src/fast-server/pcre-${PCRE_VERSION}         \
--with-pcre-jit                                                     \
--with-openssl=/usr/local/src/fast-server/openssl-${OPENSSL_VERSION} \
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
&& cat                    /usr/local/nginx/conf/nginx.conf          \

&& rm -rf /usr/local/src/*                                          \

&& chown -R nginx:appserver        /usr/local/nginx                 \
&& /usr/local/nginx/sbin/nginx -t                                   \
&& /usr/local/nginx/sbin/nginx                                      \
&& chown -R nginx:appserver         /usr/local/nginx                \
&& /usr/local/nginx/sbin/nginx -s stop

EXPOSE 80 443

CMD ["/usr/local/nginx/sbin/nginx"]
