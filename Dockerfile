ARG BUILD_FROM=ghcr.io/hassio-addons/base:17.1.1

FROM ${BUILD_FROM}

# Set shell
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN \
    apk add --no-cache \
        nginx=1.26.2-r4 \
        php83-curl=8.3.16-r0 \
        php83-dom=8.3.16-r0 \
        php83-fpm=8.3.16-r0 \
        php83-iconv=8.3.16-r0 \
        php83-mbstring=8.3.16-r0 \
        php83-opcache=8.3.16-r0 \
        php83-session=8.3.16-r0 \
        php83-zip=8.3.16-r0 \
        php83=8.3.16-r0 \
        php83-mysqli \
        php83-pdo_mysql \
        mysql-client 

# Copie des fichiers de configuration
COPY rootfs/ /

RUN echo "nameserver 1.1.1.1" > /etc/resolv.conf

RUN chown -R nginx:nginx /var/www/gsg
