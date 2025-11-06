FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

# system dependencies
RUN apt-get update && apt-get install -y curl wget git zip unzip ca-certificates gnupg

# node
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# php
RUN apt-get install -y php8.3-common php8.3-cli php8.3-mbstring php8.3-zip php8.3-xml php8.3-tokenizer php8.3-curl php8.3-dom php8.3-gd

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY package.json composer.json ./

RUN npm install
RUN npx playwright install chromium --with-deps

RUN composer install --no-scripts --no-autoloader --no-interaction

COPY . .

RUN composer dump-autoload --optimize
