
# Configuración de Usuarios, Logs y SSL en vsFTP

Este documento describe los pasos para configurar usuarios, habilitar logs y establecer un certificado SSL en el servidor vsFTP.

## 1. Instalación de vsFTP

```bash
sudo apt update
sudo apt install vsftpd
```

## 2. Configuración de Usuarios

### Crear un usuario específico para FTP:
```bash
sudo adduser ftpuser
sudo passwd ftpuser
```

### Crear un directorio para el usuario y establecer permisos:
```bash
sudo mkdir -p /home/ftpuser/ftp
sudo chown nobody:nogroup /home/ftpuser/ftp
sudo chmod a-w /home/ftpuser/ftp

sudo mkdir -p /home/ftpuser/ftp/files
sudo chown ftpuser:ftpuser /home/ftpuser/ftp/files
```

### Configurar vsftpd para usuarios locales:
Edita el archivo de configuración:
```bash
sudo nano /etc/vsftpd.conf
```

Habilita las siguientes líneas:
```
local_enable=YES
write_enable=YES
chroot_local_user=YES
allow_writeable_chroot=YES
user_sub_token=$USER
local_root=/home/$USER/ftp
```
Reinicia el servicio:
```bash
sudo systemctl restart vsftpd
```

## 3. Configuración de Logs

Edita el archivo de configuración:
```bash
sudo nano /etc/vsftpd.conf
```

Habilita los logs detallados:
```
xferlog_enable=YES
xferlog_file=/var/log/vsftpd.log
log_ftp_protocol=YES
```

Reinicia el servicio:
```bash
sudo systemctl restart vsftpd
```

## 4. Configuración de SSL

### Generar el certificado SSL:
```bash
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/vsftpd.pem -out /etc/ssl/private/vsftpd.pem
```

### Configurar vsftpd para usar SSL:
Edita el archivo de configuración:
```bash
sudo nano /etc/vsftpd.conf
```

Habilita las siguientes líneas:
```
ssl_enable=YES
rsa_cert_file=/etc/ssl/private/vsftpd.pem
rsa_private_key_file=/etc/ssl/private/vsftpd.pem
ssl_tlsv1=YES
ssl_sslv2=NO
ssl_sslv3=NO
require_ssl_reuse=NO
ssl_ciphers=HIGH
```

### Asegurarse de que solo usuarios específicos puedan usar SSL:
```
force_local_data_ssl=YES
force_local_logins_ssl=YES
```

Reinicia el servicio:
```bash
sudo systemctl restart vsftpd
```

## 5. Verificación

### Verificar que el servicio está activo:
```bash
sudo systemctl status vsftpd
```

### Revisar los logs para comprobar el funcionamiento:
```bash
sudo tail -f /var/log/vsftpd.log
```

## Notas Adicionales
- Asegúrate de abrir los puertos 20 y 21 en el firewall.
- Si usas FTPS, asegúrate de configurar tu cliente FTP para soportar conexiones seguras.

