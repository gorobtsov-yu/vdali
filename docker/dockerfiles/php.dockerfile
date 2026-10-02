FROM php:8.3-fpm

WORKDIR /var/www/

ARG UID=65432
ARG GID=65432

RUN echo "UID: ${UID}, GID: ${GID}"

RUN groupmod -g ${GID} www-data && \
    usermod -u ${UID} -g ${GID} www-data

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libicu-dev \       
    libzip-dev \ 
    libpq-dev \ 
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . /var/www

COPY docker/bin/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    sockets \
    bcmath \
    intl \
    zip

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]