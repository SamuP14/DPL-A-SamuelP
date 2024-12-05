# VirtualHosts en Nginx

1) Nos pondremos en la terminal como superuser

    ~~~
    ~$ sudo su
    ~~~

2) Vamos a crear las carpetas que serán nuestros *hosts* virtuales en `/var/www/html/`

    ~~~
    /# mkdir -p /var/www/html/empresa1.com/public
    /# mkdir -p /var/www/html/empresa2.com/public
    /# mkdir -p /var/www/html/empresa3.com/public
    ~~~

3) Crearemos el fichero `index.html` en cada carpeta `public`

    Una manera sencilla es crearlo en una y luego copiarlo y editarlo en el resto:
    ~~~
    /# nano /var/www/html/empresa1.com/public/index.html
    /# cp /var/www/html/empresa1.com/public/index.html /var/www/html/empresa2.com/public/index.html
    /# cp /var/www/html/empresa1.com/public/index.html /var/www/html/empresa3.com/public/index.html
    /# tree /var/www/html/
    /var/www/html/
    ├── empresa1.com
    │   └── public
    │       └── index.html
    ├── empresa2.com
    │   └── public
    │       └── index.html
    ├── empresa3.com
    │   └── public
    │       └── index.html
    └── index.html

    7 directories, 4 files
    ~~~

    Cuando editemos los html, pondremos el siguiente código:
    ```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Empresa *</title>
    </head>
    <body>
        <h1>Esta es la empresa *</h1>
    </body>
    </html>
    ```
    Únicamente cambiaremos el * por el número de la empresa.

4) Debemos de darle propiedad al usuario `www-data` en todas las carpetas `.com`:

    ~~~
    /# chown -R www-data: /var/www/html/empresa1.com/
    /# chown -R www-data: /var/www/html/empresa2.com/
    /# chown -R www-data: /var/www/html/empresa3.com/
    ~~~
    Esto le dará la autoría de todo el contenido de cada carpeta al usuario `www-data`

5) Para crear los archivos de configuraciones de los *hosts* nos moveremos a la siguiente ruta:

    ~~~
    /# cd etc/nginx/sites-available/
    ~~~
    
    Vamos a crear y editar con nano el fichero de configuración de los servicios virtuales.

    ~~~
    /etc/nginx/sites-available# nano empresaX.com.conf
    ~~~

    Dentro de este fichero añadiremos lo siguiente:

    ~~~
    server {
        listen 80;
        server_name empresaX.com www.empresaX.com;

        root /var/www/html/empresaX.com/public;
        index index.html index.htm index.php;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/var/run/php/php7.4-fpm.sock; # Cambia la versión según la configuración de PHP en tu servidor
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.ht {
            deny all;
        }

        error_log /var/log/nginx/empresaX_error.log;
        access_log /var/log/nginx/empresaX_access.log;
    }

    ~~~

    Será tan fácil como cambiar `X` por el número de la empresa que estemos configurando.

    una vez finalicemos, volvemos a la carpeta root con `cd /`

6) Para habilitar los servicios, haremos lo siguiente:

    Vamos a crear un enlace de cada fichero de configuración desde `/etc/nginx/sites-available` a `/etc/nginx/sites-enabled`

    ~~~
    /# ln -s /etc/nginx/sites-available/empresa1.com.conf /etc/nginx/sites-enabled/
    /# ln -s /etc/nginx/sites-available/empresa2.com.conf /etc/nginx/sites-enabled/
    /# ln -s /etc/nginx/sites-available/empresa3.com.conf /etc/nginx/sites-enabled/
    ~~~

    Vamos a comprobarlo:

    ~~~
    /# tree /etc/nginx/sites-enabled/
    /etc/nginx/sites-enabled/
    ├── default -> /etc/nginx/sites-available/default
    ├── empresa1.com.conf -> /etc/nginx/sites-available/empresa1.com.conf
    ├── empresa2.com.conf -> /etc/nginx/sites-available/empresa2.com.conf
    └── empresa3.com.conf -> /etc/nginx/sites-available/empresa3.com.conf

    1 directory, 4 files
    ~~~

    Vemos que, efectivamente, los ficheros señalan a la carpeta `sites-available`.

    Para comprobar que el servicio de Nginx sigue funcionando correctamente, haremos lo siguiente:

    ~~~
    /# nginx -t
    nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
    nginx: configuration file /etc/nginx/nginx.conf test is successful
    ~~~

    Para recargar el servicio usaremos `reload`:

    ~~~
    /# systemctl reload nginx
    ~~~

    Si hacemos un `status` podremos ver que funciona correctamente.

    Para añadir `localhost` como un nombre de servidor válido editaremos el fichero `nginx.conf`:

    ~~~
    /# nano etc/nginx/nginx.conf 
    ~~~

    Dentro, debajo de los primeros `include` en la etiqueta `http`, añadiremos lo siguiente:

    ~~~
    server {
        listen 80;               # Escucha en el puerto 80
        server_name localhost;   # Define localhost como el nombre del servidor

        root /var/www/html;      # Define la raíz del sitio
        index index.html index.htm;

        location / {
            try_files $uri $uri/ =404;  # Manejo de rutas
        }
    }
    ~~~

    Guardamos y salimos, revisamos que esté todo bien y reiniciamos el servicio:

    ~~~
    /# nginx -t
    nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
    nginx: configuration file /etc/nginx/nginx.conf test is successful
    /# systemctl reload nginx
    ~~~

    Por último, para activar los dominios de los servicios virtuales, editaremos el fichero `/etc/hosts` de la siguiente forma:

    ~~~
    /# nano /etc/hosts
    ~~~

    Añadiremos debajo de las IPs que vienen por defecto lo siguiente:

    ~~~
    127.0.0.1 empresa1.com
    127.0.0.1 www.empresa1.com

    127.0.0.1 empresa2.com
    127.0.0.1 www.empresa2.com

    127.0.0.1 empresa3.com
    127.0.0.1 www.empresa3.com
    ~~~

    Guardamos y salimos y, si hacemos ping a cualquiera de los dominios, debería funcionar:

    ~~~
    /# ping empresa1.com
    PING empresa1.com (127.0.0.1) 56(84) bytes of data.
    64 bytes from localhost (127.0.0.1): icmp_seq=1 ttl=64 time=0.023 ms
    64 bytes from localhost (127.0.0.1): icmp_seq=2 ttl=64 time=0.030 ms
    64 bytes from localhost (127.0.0.1): icmp_seq=3 ttl=64 time=0.032 ms
    64 bytes from localhost (127.0.0.1): icmp_seq=4 ttl=64 time=0.031 ms
    ^C
    --- empresa1.com ping statistics ---
    4 packets transmitted, 4 received, 0% packet loss, time 3047ms
    rtt min/avg/max/mdev = 0.023/0.029/0.032/0.003 ms
    ~~~

    Ahora, si accedemos en el navegador tanto a `empresaX.com` como a `www.empresaX.com` deberíamos ver el html que hemos creado para cada empresa.

Con todo esto ya habremos creado 3 VirtualHosts utilizando Nginx.