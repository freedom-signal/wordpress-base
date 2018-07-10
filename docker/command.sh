#!/bin/bash

set -e
set -x

function wait-for-database() {
  until nc -z -v -w30 db 3306
  do
    echo "Waiting for database connection..."
    sleep 1
  done
}

function set-up-wordpress() {
  composer wordpress-setup-core-install -- \
    --title="WordPress on Heroku" \
    --admin_user=admin \
    --admin_password=admin \
    --admin_email=admin@example.com \
    --url="http://localhost/" || true
}

function finalize-wordpress-setup() {
  composer wordpress-setup-finalize || true
}

function run-wordpress() {
  vendor/bin/heroku-php-apache2 -C apache2-wordpress.conf wordpress/
}

wait-for-database
set-up-wordpress
finalize-wordpress-setup
run-wordpress
