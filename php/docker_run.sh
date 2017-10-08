#!/bin/bash

chown -R php:appserver /usr/local/php

exec /usr/local/php/sbin/php-fpm
