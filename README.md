# wordpress-nginx-php5/7-mysql

## Installation

1. Create images for php5 and php7
 - cd php5 && sudo docker build -t 'private/wordpress-php5' .
 - cd php7 && sudo docker build -t 'private/wordpress-php7' . 
 !!! Keep in mind that configurations for Nginx is also located in this folder
 TBD: Default configuration can be chnaged on fly (via 'sed':-)
2. Create image for 'Wordpress' (last version)
 -  sudo docker build -t 'private/wordpress[5/7]' .
 !!! Keep in mind that main image in Docker file have to be chnaged manualy depend on your needs
 TBD: Can be automated in future
3. Run Docker conteiner
 - sudo docker run -p 80:80 -p 2222:22 --name wordpress-nginx-php -d private/wordpress5
4. Wait till Nginx is started (2-3 sec)
 - http://127.0.0.1:80

Update:
For uploading WP content/settings/DB follwoing command have to be used (not done yet for DB):
sudo docker run --volume /home/root4u/wordpress_nginx_php/wp-content/:/usr/share/nginx/www/ -p 80:80 -p 2222:22 --name docker-name -d private/wordpress5
For final solution have to be implement DB but not only the content. For now "Db connection error is occuring"


Tips:
 - Check running conteiners:
    $ sudo docker ps

 - You can also SSH to your container on 127.0.0.1:2222. The default password is *wordpress*
    $ ssh -p 2222 wordpress@127.0.0.1
 - Check logs
    $ sudo docker logs wordpress-nginx-php
