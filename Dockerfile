ARG BUILD_FROM=ghcr.io/hassio-addons/base:latest

FROM ${BUILD_FROM}

# Set shell
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN \
    apk add --no-cache \
        nginx \
        php83-curl \
        php83-dom \
        php83-fpm \
        php83-iconv \
        php83-mbstring \
        php83-opcache \
        php83-session \
        php83-zip \
        php83 \
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
RUN chmod -R +x /etc/s6-overlay/s6-rc.d/