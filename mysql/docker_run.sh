#!/bin/bash

chown -R mysql:appserver /usr/local/mysql

exec /usr/local/mysql/support-files/mysql.server start
