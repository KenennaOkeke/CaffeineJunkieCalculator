Technology: Javascript, Vue.js, Laravel, and PHP. 

This project's goal is to help you estimate the amount of caffiene you are consuming a day.

## Initial Setup

In general, this is what we want to do:

Pull the repository onto the machine
Change the name of the example env file to .env
Add DB credentials (create a blank DB and a new user)

Run these commands:
```
composer install
npm install
```

and run these commands afterward (and everytime you pull from origin):
```
npm run prod
composer dump-autoload
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
php artisan cache:clear
php artisan view:clear 
php artisan view:cache
php artisan optimize:clear
```
I reccomend a LEMP stack with PHP 8 and MySQL 8. Use PHP CGI

This is a sample nginx config:
```
server {
    listen 80;
    listen [::]:80;
    server_name caffeinesimulator.kenenna.com;
    server_tokens off;
    root /home/caffeinesimulator.kenenna.com/public;

    # ssl_certificate;
    # ssl_certificate_key;

    #ssl_protocols
    #ssl_ciphers
    #ssl_prefer_server_ciphers
    #ssl_dhparam

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/caffeinesimulator.kenenna.com-error.log error;

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
 }
```

Once configured, go to the web server's index url "/".
