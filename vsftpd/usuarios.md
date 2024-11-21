# Configuración del servidor FTP utilizando vsFTP

A continuación, se detallan los pasos para configurar un servidor FTP utilizando vsFTP con las condiciones solicitadas.

## 1. Instalación de vsFTP

Si aún no tienes instalado el servidor `vsftpd` en tu servidor, instálalo con el siguiente comando:

```bash
sudo apt update
sudo apt install vsftpd
```

## 2. Crear los usuarios

Para crear los usuarios solicitados, usa los siguientes comandos. Algunos de estos usuarios tendrán restricciones específicas, como ser enjaulados en su directorio o denegados del acceso.

```bash	
sudo useradd -m usuario1
sudo useradd -m usuario2
sudo useradd -m usuario3
sudo useradd -m usuario4
sudo useradd -m usuario5
sudo useradd -m usuario6
```

Establecer contraseñas:

```bash	
sudo passwd usuario1
sudo passwd usuario2
sudo passwd usuario3
sudo passwd usuario4
sudo passwd usuario5
sudo passwd usuario6
```

## 3. Configurar enjaulamiento de usuarios

Los usuarios `usuario1` y `usuario6` estarán enjaulados en su directorio de trabajo. Para esto, edita el archivo de configuración de vsFTP.

```bash
sudo nano /etc/vsftpd.conf
```

Añadir las siguientes líneas para enjaular a los usuarios:

```bash
chroot_local_user=YES
allow_writeable_chroot=YES
```

Para que sólo los usuarios específicos estén enjaulados, agrega una lista de excepciones:

```bash
chroot_list_file=/etc/vsftpd.chroot_list
```

Luego, crea el archivo de la lista de usuarios enjaulados:

```bash
echo "usuario1" | sudo tee -a /etc/vsftpd.chroot_list
echo "usuario6" | sudo tee -a /etc/vsftpd.chroot_list
```

## 4. Desactivar acceso a algunos usuarios

Los usuarios `usuario3` y `usuario4` deben tener el acceso denegado al servidor FTP. Esto se puede hacer configurando el archivo de configuración de vsftpd para denegar el acceso a estos usuarios.

```bash
user_config_dir=/etc/vsftpd_user_conf
```

Luego, crea un archivo de configuración para cada usuario que deseas restringir. Para `usuario3` y `usuario4`, crea un archivo que contenga la línea `deny=YES` en:

```bash
sudo mkdir /etc/vsftpd_user_conf
echo "deny=YES" | sudo tee /etc/vsftpd_user_conf/usuario3
echo "deny=YES" | sudo tee /etc/vsftpd_user_conf/usuario4
```

## 5. Activar log de usuarios

Para activar el registro de usuarios, modifica el archivo de configuración de vsftpd y habilita las opciones de logging:

```bash
sudo nano /etc/vsftpd.conf
```

Añadir o asegurarse de que las siguientes líneas estén habilitadas:

```bash
xferlog_enable=YES
xferlog_file=/var/log/vsftpd.log
log_ftp_protocol=YES
```

Esto asegurará que se registre toda la actividad FTP en el archivo `/var/log/vsftpd.log`.

## 6. Cerrar la conexión después de 5 minutos de inactividad

Para cerrar las conexiones inactivas después de 5 minutos, configura el parámetro `idle_session_timeout` en el archivo de configuración de vsftpd:

```bash
sudo nano /etc/vsftpd.conf
```

Añadir la siguiente línea:

```bash
idle_session_timeout=300
```

Esto configurará el servidor para cerrar las conexiones después de 5 minutos (300 segundos) de inactividad.

## 7. Activar cifrado SSL

Para cifrar las conexiones FTP con SSL, habilita y configura SSL en el archivo de configuración `vsftpd.conf`.

```bash
sudo nano /etc/vsftpd.conf
```

Añadir las siguientes líneas para habilitar SSL:

```bash
ssl_enable=YES
allow_anon_ssl=NO
force_local_data_ssl=YES
force_local_logins_ssl=YES
ssl_tlsv1=YES
ssl_sslv2=NO
ssl_sslv3=NO
rsa_cert_file=/etc/ssl/certs/vsftpd.pem
rsa_private_key_file=/etc/ssl/private/vsftpd.key
```

Si no tienes un certificado SSL, crea uno utilizando el siguiente comando:

```bash
sudo openssl req -new -x509 -days 365 -nodes -out /etc/ssl/certs/vsftpd.pem -keyout /etc/ssl/private/vsftpd.key
```

Esto generará un certificado autofirmado. Si estás utilizando un certificado SSL válido, asegúrate de especificar las rutas correctas.

## 8. Reiniciar el servicio vsFTP

Después de realizar todos estos cambios, reinicia el servicio vsftpd para aplicar la configuración:

```bash
sudo systemctl restart vsftpd
```

## 9. Verificación

Para asegurarte de que la configuración está funcionando correctamente:

- Intenta conectarte con los usuarios `usuario1`, `usuario2`, `usuario3`, etc., y verifica que las restricciones se apliquen según lo esperado. Podremos comprobar que los enjaulamientos se han realizado correctamente.
- Revisa los logs de acceso en `/var/log/vsftpd.log`. Cualquier error a la hora de conectarse algún usuario se verá reflejado en este fichero.
- Verifica que el servidor cierre las conexiones inactivas después de 5 minutos.