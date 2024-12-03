# Instalación de Nginx

1) Nos pondremos en la terminal como superuser

    ~~~
    # sudo su
    ~~~

2) Actualizamos los paquetes de apt e instalamos

    ~~~
    # apt update
    # apt install nginx
    ~~~

3) Para comprobar el estado de Nginx utilizaremos lo siguiente

    ~~~
    # nginx -t
    ~~~

    También podemos usar `systemctl`:

    ~~~
    # systemctl status nginx
    ~~~

4) Vamos a ver el contenido de la carpeta de Nginx

    Nos movemos a la carpeta `/etc/nginx`
    ~~~
    # cd /etc/nginx/
    ~~~

    Para poder ver su contenido usaremos `tree`:
    ~~~
    # tree .
    . 
    ├── conf.d
    ├── fastcgi.conf
    ├── fastcgi_params
    ├── koi-utf
    ├── koi-win
    ├── mime.types
    ├── modules-available
    ├── modules-enabled
    ├── nginx.conf
    ├── proxy_params
    ├── scgi_params
    ├── sites-available
    │   └── default
    ├── sites-enabled
    │   └── default -> /etc/nginx/sites-available/default
    ├── snippets
    │   ├── fastcgi-php.conf
    │   └── snakeoil.conf
    ├── uwsgi_params
    └── win-utf
    ~~~

    Si nos movemos a la carpeta `sites-available` podremos ver lo siguiente:
    ~~~
    # cd /etc/nginx/sites-available/
    # tree .
    .
    └── default
    ~~~

    Si nos movemos a la carpeta `sites-enabled` podremos ver lo siguiente: 
    ~~~
    # cd /etc/nginx/sites-enabled
    # ls -l
    >> total 0
    >> lrwxrwxrwx 1 root root 34 dic  3 14:53 default -> /etc/nginx/sites-available/default
    ~~~

    Si queremos ver el contenido del archivo default, basta con hacer un `cat` o usar `nano`:

    ~~~
    # cat default
    >> (contenido del fichero)
    # nano
    ~~~

5) Vamos a ver el contenido que se mostrará en la web

    Nos movemos a la carpeta `/var/www/html`
    ~~~
    # cd /var/www/html
    ~~~

    Para poder ver su contenido usaremos `tree`:
    ~~~
    # tree .
    .
    ├── index.html
    ├── index.nginx-debian.html
    └── prueba1.com
        └── public
            └── index.html
    ~~~

    Vamos a borrar los ficheros `index.html` y `index.nginx-debian.html` para crear el nuestro propio:
    ~~~
    # rm index.html
    # rm index.nginx-debian.html
    ~~~

    Para crear nuestro html, usaremos nano:
    ~~~
    # nano index.html
    ~~~

    Dentro del fichero añadiremos una etiqueta sencilla para mostrar un hola mundo:    
    ```html
    <h1>Hola mundo</h1>
    ```

    Para que se guarden los cambios, reiniciamos el servicio:
    ~~~
    systemctl restart nginx
    ~~~

    Comprobamos que esté todo ok:
    ~~~
    systemctl status nginx
    ~~~

    En el navegador iremos a `localhost` y debería aparecer nuestro html personalizado.