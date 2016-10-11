FROM private/wordpress-php5

# Add system user for Wordpress
RUN useradd -m -d /home/wordpress -p $(openssl passwd -1 'wordpress') -G root -s /bin/bash wordpress \
    && usermod -a -G www-data wordpress \
    && usermod -a -G sudo wordpress \
    && ln -s /usr/share/nginx/www /home/wordpress/www

# Install Wordpress
ADD http://wordpress.org/latest.tar.gz /usr/share/nginx/latest.tar.gz
RUN cd /usr/share/nginx/ \
    && tar xvf latest.tar.gz \
    && rm latest.tar.gz


RUN mv /usr/share/nginx/html/5* /usr/share/nginx/wordpress \
    && rm -rf /usr/share/nginx/www

RUN mv /usr/share/nginx/wordpress /usr/share/nginx/www \
    && chown -R www-data:www-data /usr/share/nginx/www \
    && chmod -R 775 /usr/share/nginx/www

# Wordpress Initialization and Startup Script
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh

#NETWORK PORTS
# private expose
EXPOSE 3306
EXPOSE 80
EXPOSE 22

# volume for mysql database and wordpress install
VOLUME ["/var/lib/mysql", "/usr/share/nginx/www", "/var/run/sshd"]

CMD ["/bin/bash", "/start.sh"]
