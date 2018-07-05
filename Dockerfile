FROM heroku/heroku:16-build as build
WORKDIR /app
COPY . /app
RUN mkdir -p /tmp/buildpack/php /tmp/build_cache /tmp/env
RUN git clone https://github.com/heroku/heroku-buildpack-php.git /tmp/buildpack/php
RUN STACK=heroku-16 /tmp/buildpack/php/bin/compile /app /tmp/build_cache /tmp/env

FROM heroku/heroku:16
COPY --from=build /app /app
ENV HOME /app
WORKDIR /app
RUN useradd -m heroku
RUN chown -R heroku .
USER heroku
ENV PATH="/app/.heroku/php/bin:/app/.heroku/php/sbin:${PATH}:/app/vendor/bin"
CMD vendor/bin/heroku-php-apache2 -C apache2-wordpress.conf wordpress/
