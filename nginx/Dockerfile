FROM ubuntu:16.04

ENV NGINX_VERSION       1.13.5
ENV OPENSSL_VERSION     1.0.2l
ENV PCRE_VERSION        8.41
ENV ZLIB_VERSION        1.2.11

ADD https://raw.githubusercontent.com/qwerty199369/docker-library/master/nginx/docker_run.sh  /docker_run.sh

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

&& rm -rf /usr/local/src/*                                          \

&& chown -R nginx:appserver        /usr/local/nginx                 \
&& /usr/local/nginx/sbin/nginx -t                                   \
&& /usr/local/nginx/sbin/nginx                                      \
&& chown -R nginx:appserver         /usr/local/nginx                \
&& /usr/local/nginx/sbin/nginx -s stop

EXPOSE 80 443

CMD ["/docker_run.sh"]
