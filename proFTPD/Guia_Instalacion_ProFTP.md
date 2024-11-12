
# Guía de Instalación y Configuración de Servidor FTP con ProFTP

## Requisitos Previos
1. Contar con un entorno Linux.
2. Tener permisos de administrador (`sudo`).

## Pasos para la Instalación de ProFTP

1. **Acceso como Superusuario:**
   ```bash
   sudo su
   ```

2. **Actualizar Repositorios:**
   ```bash
   apt-get update
   ```

3. **Instalar ProFTP:**
   ```bash
   apt-get install proftpd
   ```
   - Si se muestra un entorno gráfico, selecciona **independiente** y presiona aceptar.

4. **Verificar el Estado del Servicio:**
   ```bash
   service proftpd status
   ```
   - Asegúrate de que el servidor esté activo.

5. **Ver la Versión de ProFTP:**
   ```bash
   proftpd -v
   ```

6. **Ver los Usuarios Creados Durante la Instalación:**
   ```bash
   cat /etc/passwd
   ```

7. **Ver Archivos Generados en la Instalación:**
   ```bash
   ls /etc/proftpd
   ```
   - El archivo principal de configuración es `proftpd.conf`.

8. **Crear una Copia de Seguridad del Archivo de Configuración:**
   ```bash
   cp /etc/proftpd/proftpd.conf /etc/proftpd/proftpd.conf.copia
   ```

9. **Editar el Archivo de Configuración con Nano:**
   ```bash
   nano /etc/proftpd/proftpd.conf
   ```
   - Es un archivo largo con muchos comentarios y líneas en blanco.

10. **Limpiar Comentarios y Líneas en Blanco con VI:**
    ```bash
    vi /etc/proftpd/proftpd.conf
    ```
    - Eliminar comentarios: `:g/^\s*#/d`
    - Eliminar líneas en blanco: `:g/^$/d`
    - Guardar y salir: `:wq`

11. **Ver Usuarios sin Permiso de Acceso FTP:**
    ```bash
    cat /etc/ftpusers
    ```

## Conexión al Servidor FTP

### Desde la Terminal
1. Ejecuta el comando:
   ```bash
   ftp ip_del_servidor_FTP
   ```
2. Ingresa el nombre de usuario y contraseña del sistema local.
3. Comandos útiles:
   - Listar archivos: `ls`
   - Mostrar directorio actual: `pwd`
   - Salir: `quit`

### Desde el Navegador
1. Ingresa en la barra de direcciones:
   ```
   ftp://dirección_ip_servidor_FTP
   ```
2. Introduce el nombre de usuario y la contraseña cuando se soliciten.

### Desde FileZilla
1. Instalar FileZilla:
   ```bash
   apt-get install filezilla
   ```
2. Abrir FileZilla:
   ```bash
   filezilla
   ```
3. Configura los siguientes parámetros:
   - Servidor: `ip_servidor`
   - Usuario: `nombre_usuario`
   - Contraseña: `password_usuario`
   - Puerto: `21`

## Configuración del Archivo proftpd.conf

1. Edita el archivo de configuración:
   ```bash
   nano /etc/proftpd/proftpd.conf
   ```
2. Cambia los siguientes valores según tu preferencia:
   - **ServerName**: `Mi servidor FTP`
   - **DeferWelcome**: `off`
   - **TimeoutIdle**: `1200`
   - **Port**: `21`
   - **MaxInstances**: `30`
   - **ShowSymlinks**: `(habilitar acceso a enlaces simbólicos)`
   - **User**: `proftpd`
   - **Group**: `nogroup`
   - **Umask**: `022 022`
   - **TransferLog**: `/var/log/proftpd/xferlog`
   - **SystemLog**: `/var/log/proftpd/proftpd.log`
3. Guarda y cierra el archivo.

## Verificar Logs de ProFTP

1. Ver las últimas 15 líneas de `proftpd.log`:
   ```bash
   tail -n 15 /var/log/proftpd/proftpd.log
   ```

2. Ver problemas de conexión (si los hay) en `xfer.log`:
   ```bash
   tail -n 15 /var/log/proftpd/xfer.log
   ```

## Personalizar Mensajes de Conexión y Error

1. Abre `proftpd.conf`:
   ```bash
   nano /etc/proftpd/proftpd.conf
   ```
2. Añade las siguientes líneas:
   ```plaintext
   AccessGrantMSG "Bienvenido al servidor FTP de (mi_nombre)"
   AccessDenyMSG "Error de entrada a mi servidor FTP"
   ```
3. Guarda y cierra.

4. **Refrescar el Servicio:**
   ```bash
   service proftpd reload
   ```

## Restringir el Acceso de Usuarios a su Directorio `/home`

1. Abre `proftpd.conf`:
   ```bash
   nano /etc/proftpd/proftpd.conf
   ```
2. Añade la línea:
   ```plaintext
   DefaultRoot ~
   ```
3. Guarda y cierra.

4. **Recarga el Servicio:**
   ```bash
   service proftpd reload
   ```

## Modificar Permisos de Umask

1. En `proftpd.conf`, verifica el valor de `Umask 022 022`.
   - Esto aplica permisos `644` para archivos y `755` para directorios creados.

2. **Prueba de Umask en el Servidor:**
   - Conéctate al servidor FTP y crea un archivo y una carpeta.
   - Verifica los permisos asignados.

3. **Requerimientos para Permisos Específicos:**
   - Para permisos `_rw_______` en archivos y `drwx______` en directorios, configura `Umask` en `077 077`.

## Creación de Usuarios Virtuales en ProFTP

1. Abre `proftpd.conf` y añade al principio:
   ```plaintext
   Include /etc/proftpd/modules.conf
   Require ValidShell off
   AuthUserFile /etc/proftpd/ftpd.passwd
   ```

2. Crea el directorio `/home` para el usuario virtual:
   ```bash
   cd /var
   mkdir ftp
   mkdir ftp/carpetauser1JSR
   ```

3. Crea un archivo vacío para el usuario virtual:
   ```bash
   touch /etc/proftpd/ftpd.passwd
   ```

4. Crea el usuario virtual:
   ```bash
   ftpasswd --passwd --name=user1JSR --uid=3000 --gid=3000 --home=/var/ftp/carpetauser1JSR --shell=/bin/false
   ```

5. **Desbloquear Usuario:**
   ```bash
   ftpasswd --passwd --name=user1JSR --unlock
   ```

6. **Prueba de Conexión con FileZilla:**
   - Servidor: `ip_servidor`
   - Usuario: `user1JSR`
   - Contraseña: contraseña asignada
   - Puerto: `21`
