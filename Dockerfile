FROM heroku/heroku:16-build as build
WORKDIR /app
COPY . /app
RUN \
  mkdir -p /tmp/buildpack/php /tmp/build_cache /tmp/env && \
  git clone https://github.com/heroku/heroku-buildpack-php.git /tmp/buildpack/php && \
  STACK=heroku-16 /tmp/buildpack/php/bin/compile /app /tmp/build_cache /tmp/env && \
  rm /tmp/buildpack/php /tmp/build_cache /tmp/env

FROM heroku/heroku:16
COPY --from=build /app /app
WORKDIR /app
RUN useradd -m heroku && chown -R heroku .
USER heroku
ENV \
  HOME=/app \
  PATH="/app/.heroku/php/bin:/app/.heroku/php/sbin:$PATH:/app/vendor/bin"
CMD vendor/bin/heroku-php-apache2 -C apache2-wordpress.conf wordpress/
