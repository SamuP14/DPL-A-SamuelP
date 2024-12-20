# Instalar certificado Let's Encrypt con certbot en nginx con host virtuales

Antes de comenzar, ejecutar los siguientes comandos: `sudo su` y `cd /`

## 1. Verificar la configuración de Nginx

Antes de continuar, asegúrate de que Nginx reconoce correctamente los bloques de servidor para cada dominio y que están apuntando al puerto 80. Prueba la configuración de Nginx:

```
/# nginx -t
```

Si no hay errores, recarga el servicio:

```
/# systemctl reload nginx
```

## 2. Instalar Certbot y el complemento Nginx

Si no lo has hecho ya, instala Certbot con soporte para Nginx:

```
/# apt update
/# apt install certbot python3-certbot-nginx -y
```

## 3. Solicitar los certificados para los dominios

Ejecuta Certbot para cada dominio configurado:

1) Para `empresa1.com`:

    ```
    /# certbot --nginx -d empresa1.com -d www.empresa1.com
    ```

2) Para `empresa2.com`:

    ```
    /# certbot --nginx -d empresa2.com -d www.empresa2.com
    ```

3) Para `empresa3.com`:

    ```
    /# certbot --nginx -d empresa3.com -d www.empresa3.com
    ```

Certbot detectará automáticamente los bloques de servidor y configurará el SSL en cada uno de ellos.

## 4. Verificar los certificados

Después de instalar los certificados, accede a los dominios en un navegador para verificar que HTTPS funciona correctamente:

- https://empresa1.com
- https://empresa2.com
- https://empresa3.com

## 5. Configurar la renovación automática

Certbot configura automáticamente la renovación de los certificados. Puedes verificar que esté funcionando con un comando de prueba:

```
/# certbot renew --dry-run
```
