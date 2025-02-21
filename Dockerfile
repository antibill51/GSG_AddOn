ARG BUILD_FROM=ghcr.io/hassio-addons/base:17.1.1

FROM ${BUILD_FROM}

# Set shell
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN \
    apk add --no-cache \
        nginx=1.26.2-r4 \
        php83-curl=8.3.17-r0 \
        php83-dom=8.3.17-r0 \
        php83-fpm=8.3.17-r0 \
        php83-iconv=8.3.17-r0 \
        php83-mbstring=8.3.17-r0 \
        php83-opcache=8.3.17-r0 \
        php83-session=8.3.17-r0 \
        php83-zip=8.3.17-r0 \
        php83=8.3.17-r0 \
        php83-mysqli \
        php83-pdo_mysql \
        mysql-client \
        python3 \
        py3-pip \
        py3-setuptools \
        py3-wheel

# Copie des fichiers de configuration
COPY rootfs/ /
COPY python /python

# Installation des dépendances Python pour MQTT et MySQL
RUN pip install --no-cache-dir paho-mqtt requests --break-system-packages

# Définition du répertoire de travail
WORKDIR /python

# Vérification des permissions 
RUN chmod +x /python/*.py
RUN chown -R nginx:nginx /var/www/gsg
