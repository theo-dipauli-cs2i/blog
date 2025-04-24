FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"
ENV NODE_LTS=16

# Nodejs
RUN curl -sSL --fail https://deb.nodesource.com/setup_${NODE_LTS}.x | bash -

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \ 
        php8.2-intl \ 
        php8.2-mcrypt \ 
        php8.2-mysql \ 
        php8.2-pgsql \ 
        php8.2-xdebug \
        apt-utils \
        nodejs; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
