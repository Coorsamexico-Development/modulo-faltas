FROM php:8.3-fpm-alpine

# Definir argumentos y variables de entorno
ARG UID=1000
ARG GID=1000
ENV TZ=UTC

RUN apk add --update bash libpng-dev libxml2-dev zip unzip curl sqlite supervisor npm libzip-dev cronie


RUN apk add --no-cache nginx wget
RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd pcntl

RUN mkdir -p /run/nginx /var/log/supervisor

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php.ini /usr/local/etc/php/php.ini

# ADD https://storage.googleapis.com/cloud-sql-connectors/cloud-sql-proxy/v2.16.0/cloud-sql-proxy.linux.amd64 /cloud-sql-proxy 
# RUN chmod +x /cloud_sql_proxy


#Documento supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /app
COPY . /app

# COPY ./src /app
RUN npm install -g npm
RUN sh -c "wget https://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"

RUN chown -R www-data: /app


RUN cd /app && \
    /usr/local/bin/composer install --ignore-platform-reqs --optimize-autoloader --no-dev

RUN cd /app && \
    php artisan storage:link


RUN cd /app && \
    /usr/local/bin/npm ci
RUN cd /app && \
    /usr/local/bin/npm run build


RUN cd /app && \
    php artisan view:cache
RUN cd /app && \
    php artisan route:cache
RUN cd /app && \
    php artisan event:cache

CMD sh /app/docker/startup.sh