FROM php:7-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
  pandoc \
  texlive \
  lmodern

WORKDIR /var/www
