# Creación e instalación de un certificado SSL en Apache2

1) Primero que nada nos colocaremos en la terminal como superuser

~~~
sudo su
~~~

2) En caso de aún no tenerlo, instalamos OpenSSl

~~~
apt install openssl
~~~

3) Para generar la clave privada, usaremos el siguiente comando

~~~
openssl genrsa -out server.key 1024
~~~

4) Luego generaremos un fichero intermedio de la siguiente manera

~~~
openssl req -new -key server.key -out server.csr
~~~

5) Finalmente, para generar el certificado haremos lo siguiente

~~~
openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
~~~

6) Ahora copiaremos los ficheros `server.key` y `server.crt` en la ruta de certificados de OpenSSL: `/etc/ssl/certs`

~~~
cp server.key /etc/ssl/certs
cp server.crt /etc/ssl/certs
~~~

7) Seguidamente, revisaremos el estado de apache2

~~~
systemctl status apache2
~~~

8) En caso de no tenerlo ya activado, habilitaremos SSL

~~~
a2enmod ssl
~~~

7) Seguidamente, reiniciaremos el servicio de apache2

~~~
systemctl restart apache2
~~~

8) Ahora añadiremos los certificados al fichero de configuración de nuestro VirtualHost

~~~
nano /etc/apache2/sites-available/prueba1.com.conf
~~~

* Una vez ahí dentro, añadiremos lo siguiente

~~~
<VirtualHost *:443>
    ServerName prueba1.com
    ServerAlias www.prueba1.com
    ServerAdmin webmaster@prueba1.com
    DocumentRoot /var/www/html/prueba1.com/public

    SSLEngine on

    SSLCertificateKeyFile /etc/ssl/certs/server.key
    SSLCertificateFile /etc/ssl/certs/server.crt

    <Directory /var/www/html/prueba1.com/public>
        Options -Indexes +FollowSymLinks
        AllowedOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/prueba1.com-error-log
    CustomLog ${APACHE_LOG_DIR}/prueba1.com-access.log combined
</VirtualHost>
~~~

9) Finalmente, reiniciaremos y revisaremos el estado de apache2

~~~
systemctl restart apache2
systemctl status apache2
~~~

Si todo ha salido correctamente, al entrar en el navegador a `prueba1.com` o `www.prueba1.com`, nos pedirá confirmar que el sitio no es seguro y añadirle una excepción, y así podremos acceder a nuestra página.