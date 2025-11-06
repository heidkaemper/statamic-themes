FROM mcr.microsoft.com/playwright:v1.56.1-jammy

ENV TZ=Europe/Berlin
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php8.4-cli \
    php8.4-curl \
    php8.4-dom \
    php8.4-gd \
    php8.4-mbstring \
    php8.4-sockets \
    php8.4-xml \
    php8.4-zip \
    git \
    zip \
    unzip \
    tzdata \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize
