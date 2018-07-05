#!/bin/bash

until nc -z -v -w30 db 3306
do
  echo "Waiting for database connection..."
  sleep 1
done

composer wordpress-setup-core-install -- \
  --title="WordPress on Heroku" \
  --admin_user=admin \
  --admin_password=admin \
  --admin_email=admin@example.com \
  --url="http://example.herokuapp.com/"

composer wordpress-setup-finalize

vendor/bin/heroku-php-apache2 -C apache2-wordpress.conf wordpress/
