FROM ubuntu:16.04

ENV MYSQL_VERSION          5.7.19
ENV PERCONA_VERSION        5.7.19-17
ENV BOOST_VERSION          1_59_0
ENV BOOST_NORMAL_VERSION   1.59.0
ENV MYSQL_PASS             ahgui6348u29q3eikwjedksw

COPY ./conf/generated.my.cnf      /etc/my.cnf

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
p7zip                           \
liblz4-dev                      \

&& ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h             \
&& ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so           \
&& ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so           \

&& groupadd appserver                                                       \
&& useradd -g appserver -M -d /usr/local/mysql mysql -s /sbin/nologin       \

&& cd /usr/local/src                                                        \
&& wget http://ideas-cdn-src.oss-cn-beijing.aliyuncs.com/assets/softs/percona-server-${PERCONA_VERSION}.tar.gz \
&& wget https://jaist.dl.sourceforge.net/project/boost/boost/${BOOST_NORMAL_VERSION}/boost_${BOOST_VERSION}.tar.gz \
&& tar -zxvf percona-server-${PERCONA_VERSION}.tar.gz               \
&& tar -zxvf boost_${BOOST_VERSION}.tar.gz                          \

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

# Initializing the Data Directory Manually Using mysqld. [https://dev.mysql.com/doc/refman/5.7/en/data-directory-initialization-mysqld.html]
&& /usr/local/mysql/bin/mysqld --defaults-file=/etc/my.cnf          \
--initialize-insecure                                               \
--user=mysql                                                        \
--basedir=/usr/local/mysql                                          \
--datadir=/usr/local/mysql/datadir                                  \

&& yes | cp /usr/local/mysql/support-files/mysql.server /etc/init.d/mysqld \
&& chmod +x /etc/init.d/mysqld                                      \

&& cd /usr/local/src                                                \
&& rm -rf                       /usr/local/src/*                    \
&& rm -rf                       /usr/local/mysql/mysql-test         \

&& chown -R mysql:appserver     /usr/local/mysql                    \
&& service mysqld start                                             \

&& chmod 777 /tmp/mysql.sock                                        \
&& /usr/local/mysql/bin/mysqladmin -uroot password ${MYSQL_PASS}    \
&& /usr/local/mysql/bin/mysql -uroot -p${MYSQL_PASS} -e "CREATE DATABASE test_db1 DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci"                        \
&& /usr/local/mysql/bin/mysql -uroot -p${MYSQL_PASS} -e "CREATE DATABASE test_db2 DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci"                        \

&& service mysqld stop                                              \
&& chown -R mysql:appserver    /usr/local/mysql

EXPOSE 3306

CMD ["mysqld"]
