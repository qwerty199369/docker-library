#!/bin/bash

chown -R redis:appserver /usr/local/redis

exec /usr/local/redis/bin/redis-server /usr/local/redis/conf_file.conf
