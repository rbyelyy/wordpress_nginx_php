FROM ubuntu:14.04

# Keep upstart from complaining
RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl
RUN mkdir /var/run/sshd

# Let the conatiner know that there is no tty
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -y install screen mysql-server mysql-client nginx php-apc pwgen python-setuptools curl git unzip openssh-server openssl build-essential libcurl3 libmcrypt4 libxmlrpc-epi0 python-software-properties software-properties-common 
RUN locale-gen en_US.UTF-8 && export LANG=en_US.UTF-8 && add-apt-repository -y ppa:ondrej/php && apt-get update

# Basic Requirements
RUN apt-get -y install php7.0-fpm php7.0-cli php7.0-common php7.0-curl php7.0-fpm php7.0-gd php7.0-intl php7.0-json php7.0-mbstring php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-readline php7.0-xml php7.0-xmlrpc 
RUN apt-get -y install psmisc libmcrypt-dev mcrypt php-pear php-mysql php-mbstring php-mcrypt php-xml php-intl libmhash2 php-common php-memcached

# mysql config
RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

# nginx config
RUN sed -i -e"s/keepalive_timeout\s*65/keepalive_timeout 2/" /etc/nginx/nginx.conf
RUN sed -i -e"s/keepalive_timeout 2/keepalive_timeout 2;\n\tclient_max_body_size 100m/" /etc/nginx/nginx.conf
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# php-fpm config
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 100M/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/post_max_size\s*=\s*8M/post_max_size = 100M/g" /etc/php/7.0/fpm/php.ini
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf
RUN sed -i -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" /etc/php/7.0/fpm/pool.d/www.conf
RUN find /etc/php/7.0/cli/conf.d/ -name "*.ini" -exec sed -i -re 's/^(\s*)#(.*)/\1;\2/g' {} \;

# start php7-fm service
RUN service php7.0-fpm start

# create folders for logs
RUN mkdir -p /var/run/php
RUN mkdir -p /var/log/php-fpm

# nginx site conf
ADD ./nginx-site.conf /etc/nginx/sites-available/default

# supervisor Config
RUN /usr/bin/easy_install supervisor
RUN /usr/bin/easy_install supervisor-stdout
ADD ./supervisord.conf /etc/supervisord.conf


