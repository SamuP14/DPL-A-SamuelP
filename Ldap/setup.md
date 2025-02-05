# Instalación y configuración de LDAP en Ubuntu

Este documento describe los pasos para instalar y configurar un servidor LDAP en Ubuntu y permitir el acceso desde otra máquina a través de un usuario creado.

---

## Requisitos previos
- Una máquina con Ubuntu (myserver.local).
- Otra máquina desde la que acceder al myserver.local.
- Privilegios de administrador (root).

---

## Pasos de instalación y configuración

### 1. Actualizar los paquetes
```bash
~$ sudo apt update -y && sudo apt upgrade -y && sudo apt dist-upgrade -y
```

### 2. Instalar el servidor LDAP (OpenLDAP) y sus herramientas
```bash
~$ sudo apt install slapd ldap-utils -y
```

Durante la instalación de `slapd`, se te pedirá:
- Configurar una contraseña para el administrador de LDAP (cn=admin).

Si no aparece el asistente de configuración, puedes configurarlo después con:
```bash
~$ sudo dpkg-reconfigure slapd
```

### 3. Verificar la instalación de LDAP
Ejecuta el siguiente comando para comprobar que el servicio LDAP está funcionando:
```bash
~$ sudo systemctl status slapd
```
El estado debe indicar que el servicio está "activo".

### 4. Configurar el dominio base (DC)
Por defecto, `slapd` se configura con un dominio base. Para modificarlo, utiliza:
```bash
~$ sudo dpkg-reconfigure slapd
```

Selecciona las opciones necesarias:
- Nombre de dominio (por ejemplo: `myserver.local`).
- Nombre de organización (por ejemplo: `informatica`).

### 5. Crear una estructura básica en LDAP

#### Crear un archivo LDIF con la estructura base
Crea un archivo llamado `ou.ldif`:
```bash
~$ sudo nano ou.ldif
```

Contenido del archivo:
```ldif
dn: ou=informatica,dc=myserver,dc=local
objectClass: organizationalUnit
ou: informatica


dn: ou=groups,dc=myserver,dc=local
objectClass: organizationalUnit
ou: groups
```

Carga la configuración al myserver.local:
```bash
~$ sudo ldapadd -x -D "cn=admin,dc=myserver,dc=local" -W -f ou.ldif
```
Ingresa la contraseña del administrador configurada anteriormente.

### 6. Crear un usuario en LDAP

#### Crear un archivo LDIF para el usuario
Crea un archivo llamado `usr.ldif`:
```bash
~$ sudo nano usr.ldif
```

Contenido del archivo:
```ldif
dn: uid=user1,ou=informatica,dc=myserver,dc=local
objectClass: inetOrgPerson
uid: user1
sn: 1
givenName: user
cn: User 1
displayName: User 1
userPassword: password123
mail: user1@myserver.local
```

Agrega el usuario al myserver.local:
```bash
~$ sudo ldapadd -x -D "cn=admin,dc=myserver,dc=local" -W -f usr.ldif
```

### 7. Probar la configuración
Autentica al usuario creado:
```bash
~$ ldapwhoami -x -D "uid=user1,ou=informatica,dc=myserver,dc=local" -w password123
```
El comando debe devolver:
```
dn:uid=user1,ou=informatica,dc=myserver,dc=local
```

---

## Acceso desde otra máquina

### 1. Instalar herramientas LDAP en la máquina cliente
En la máquina desde la que se accederá al myserver.local, instala las herramientas:
```bash
~$ sudo apt install ldap-utils
```

### 2. Probar la conexión al myserver.local
Utiliza el siguiente comando para conectarte al myserver.local:
```bash
~$ ldapsearch -x -H ldap://myserver.local -b "dc=myserver,dc=local" -D "uid=user1,ou=informatica,dc=myserver,dc=local" -w password123
```
Reemplaza `myserver.local` con la dirección IP o nombre del host de tu myserver.local.

### 3. Configurar autenticación LDAP (opcional)
Si deseas que la máquina cliente use LDAP para autenticar usuarios del sistema:
- Instala el módulo de cliente LDAP:
```bash
~$ sudo apt install libnss-ldap libpam-ldap ldap-utils
```

- Sigue las instrucciones en pantalla para configurar:
  - URL del servidor LDAP (por ejemplo: `tu_ip://myserver.local`).
  - Base DN (por ejemplo: `dc=myserver,dc=local`).
  - Usuario administrador y contraseña.

Reinicia los servicios necesarios:
```bash
~$ sudo systemctl restart nscd
sudo systemctl restart sshd
```

Ahora, los usuarios creados en LDAP podrán autenticarse en la máquina cliente.

---

## Conclusión
Con estos pasos, has instalado y configurado un servidor LDAP en Ubuntu y habilitado el acceso desde otra máquina. Puedes expandir la configuración según tus necesidades, como implementar SSL/TLS para conexiones seguras o añadir más usuarios y grupos.
