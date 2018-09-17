FROM ubuntu:17.10

ENV DEBIAN_FRONTEN noninteractive

RUN apt-get update && \
	apt-get install -y --no-install-recommends apt-utils \
	software-properties-common \
	python-software-properties \
	language-pack-en-base && \
	LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php && \
	apt-get update && apt-get upgrade -y

RUN apt-get install -y \
   curl \
   git \
   nano \
   sudo \
   unzip \
   supervisor \
   nginx \
   cron \
   mc \
   wget

# install php
RUN apt-get install -y \
	php7.1-fpm \
	php7.1-mysql \
	php7.1-curl \
	php7.1-gd \
	php7.1-intl \
	php7.1-mcrypt \
	php-memcache \
	php7.1-json \
	php7.1-xml \
	php7.1-mbstring \
	php7.1-soap \
	php7.1-zip \
	php7.1-cli \
	php-imagick

# cleanup
RUN apt-get remove --purge -y software-properties-common \
	python-software-properties && \
	apt-get autoremove -y && \
	apt-get clean && \
	apt-get autoclean

# install composer
RUN curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# nginx configuration
RUN sed -i -e"s/worker_processes  1/worker_processes 5/" /etc/nginx/nginx.conf && \
	sed -i -e"s/keepalive_timeout\s*65/keepalive_timeout 2/" /etc/nginx/nginx.conf && \
	sed -i -e"s/keepalive_timeout 2/keepalive_timeout 2;\n\tclient_max_body_size 128m;\n\tproxy_buffer_size 256k;\n\tproxy_buffers 4 512k;\n\tproxy_busy_buffers_size 512k/" /etc/nginx/nginx.conf && \
	echo "daemon off;" >> /etc/nginx/nginx.conf

# php-fpm configuration
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" /etc/php/7.1/fpm/php.ini && \
	sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 100M/g" /etc/php/7.1/fpm/php.ini && \
	sed -i -e "s/post_max_size\s*=\s*8M/post_max_size = 100M/g" /etc/php/7.1/fpm/php.ini && \
	sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.1/fpm/php-fpm.conf && \
	sed -i -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/pm.max_children = 5/pm.max_children = 9/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/pm.start_servers = 2/pm.start_servers = 3/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/pm.min_spare_servers = 1/pm.min_spare_servers = 2/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/pm.max_spare_servers = 3/pm.max_spare_servers = 4/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/pm.max_requests = 500/pm.max_requests = 200/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "/pid\s*=\s*\/run/c\pid = /run/php7.1-fpm.pid" /etc/php/7.1/fpm/php-fpm.conf && \
	sed -i -e "s/;listen.mode = 0660/listen.mode = 0750/g" /etc/php/7.1/fpm/pool.d/www.conf && \
	sed -i -e "s/memory_limit\s*=\s*128M/memory_limit = 512M/g" /etc/php/7.1/fpm/php.ini

# configs
RUN mkdir -p /var/www/ssl
COPY ./docker/nginx.conf /etc/nginx/sites-available/default
COPY ./docker/nginx_ssl.conf /etc/nginx/sites-available/default_ssl
COPY ./docker/supervisord.conf /etc/supervisord.conf

# cron
COPY ./docker/crontasks /etc/cron.d/crontasks
RUN chmod 600 /etc/cron.d/crontasks

COPY ./docker/docker-entrypoint /usr/local/bin/
RUN chmod 755 /usr/local/bin/docker-entrypoint

RUN mkdir -p /run/php

EXPOSE 80 443

ENTRYPOINT ["docker-entrypoint"]
