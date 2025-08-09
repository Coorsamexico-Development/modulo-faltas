FROM php:8.3-fpm-alpine

# Definir argumentos y variables de entorno
ARG UID=1000
ARG GID=1000
ENV TZ=UTC

ENV VITE_APP_NAME="Quantum"
ENV VITE_PUSHER_APP_KEY="8ae9982ee5b0b679f68b"
ENV VITE_PUSHER_APP_CLUSTER="us2"

# Instalar dependencias en una sola capa
RUN apk add --no-cache \
    bash libpng-dev libxml2-dev zip unzip curl sqlite supervisor npm libzip-dev cronie nginx wget && \
    docker-php-ext-install mysqli pdo pdo_mysql zip gd pcntl && \
    mkdir -p /run/nginx /var/log/supervisor /app

# Copiar configuraciones
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Instalar Composer y Node.js
RUN wget https://getcomposer.org/composer.phar -O /usr/local/bin/composer && chmod +x /usr/local/bin/composer && \
    npm install -g npm

# Copiar la aplicación
COPY . /app
RUN chown -R www-data: /app

# Instalar dependencias de PHP y Node.js
RUN cd /app && \
    composer install --ignore-platform-reqs --optimize-autoloader --no-dev && \
    npm ci && \
    npm run build

# Optimizar Laravel
RUN cd /app && \
    php artisan storage:link && \
    php artisan view:cache && \
    php artisan route:cache && \
    php artisan event:cache

# Comando de inicio
CMD ["sh", "/app/docker/startup.sh"]