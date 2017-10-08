#!/bin/bash

chown -R nginx:appserver /usr/local/nginx

exec /usr/local/nginx/sbin/nginx
