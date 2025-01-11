# Configuración de Servidor Web y Base de Datos con LAMP

## 1. Actualización del repositorio y paquetes
Ejecutamos los siguientes comandos para actualizar e instalar los paquetes:
```bash
sudo apt update
sudo apt upgrade
```

## 2. Instalación del servidor Apache
Instalamos Apache con:
```bash
sudo apt install apache2
```

## 3. Instalación del servidor de base de datos MariaDB
### Instalación
Ejecutamos:
```bash
sudo apt install mariadb-server mariadb-client
```
Verificamos que el servicio esté activo:
```bash
sudo systemctl status mariadb
```

Habilitamos el inicio automático en el arranque:
```bash
sudo systemctl enable mariadb
```

### Comprobación de la versión
```bash
mariadb --version
```

### Ejecución del script de seguridad
Configuramos la seguridad:
```bash
sudo mysql_secure_installation
```

### Nota sobre `unix_socket`
MariaDB usa `unix_socket` para autenticarse, lo que permite a los usuarios del sistema operativo iniciar sesión sin contraseña. Esto es útil para tareas administrativas y aumenta la seguridad en configuraciones locales.

### Verificación de acceso
Probamos el acceso con la nueva contraseña:
```bash
mysql -u root -p
```

### Creación de un usuario
Creamos un nuevo usuario:
```sql
CREATE USER 'developer'@'localhost' IDENTIFIED BY '5t6y7u8i';
GRANT ALL PRIVILEGES ON *.* TO 'developer'@'localhost';
FLUSH PRIVILEGES;
```

Verificamos el login:
```bash
mysql -u developer -p
```

## 4. Instalación de la última versión de PHP
Instalamos PHP 8.3 y módulos comunes:
```bash
sudo apt install php
```

Habilitamos el módulo:
```bash
sudo a2enmod php8.3
sudo systemctl restart apache2
```

Verificamos la versión instalada:
```bash
php --version
```

### Probando scripts PHP
Creamos un archivo `info.php`:
```bash
sudo nano /var/www/html/info.php
```
Con el contenido:
```php
<?php phpinfo(); ?>
```
Accedemos a `http://<IP>/info.php`

## 4.1 Ejecutando código PHP en Apache con PHP-FPM
Deshabilitamos el módulo PHP Apache:
```bash
sudo a2dismod php8.3
```

Instalamos y configuramos PHP-FPM:
```bash
sudo apt install php8.3-fpm
sudo a2enmod proxy_fcgi setenvif
sudo a2enconf php8.3-fpm
sudo systemctl restart apache2
```

Actualizamos la página `info.php` para verificar el cambio a FPM/FastCGI.
