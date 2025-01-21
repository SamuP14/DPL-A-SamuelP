# Configuración de DNS

## 1. Actualización del repositorio y paquetes
Ejecutamos los siguientes comandos para actualizar e instalar los paquetes:
```bash
sudo apt update
sudo apt upgrade
```

## 2. Instalación del paquete Bind9
Instalamos Bind9 con:
```bash
sudo apt install bind9 bind9-utils
```

Comprobamos que funciona:
```bash
systemctl status bind9
```

## 3. Permisos del Firewall

Permitimos de forma sencilla en el Firewall local el acceso al puerto y
protocolo que utiliza Bind9:
```bash
sudo ufw allow bind9
```

## 4. Configuración mínima de Bind9
Editamos el siguiente fichero:
```bash
sudo nano /etc/bind/named.conf.options
```

Añadiremos lo siguiente, sustituyendo las opciones que ya están por defecto por las nuevas:
```
listen-on { any; };
allow-query { localhost; 10.10.20.0/24; };
forwarders {
    8.8.8.8;
    8.8.4.4;
};
dnssec-validation no;
```

## 5. Obligar el uso único de IPv4
```bash
sudo nano /etc/default/named
```
Modificamos la línea dejándola así:
```bash
OPTIONS="-u bind -4"
```

## 6. Comprobar la configuración
```bash
sudo named-checkconf
sudo systemctl restart bind9
systemctl status bind9
```

## 7. Agregar las zonas
```bash
sudo nano /etc/bind/named.conf.local
```

Añadimos lo siguiente:
```
zone "networld.cu" IN {
    type master;
    file "/etc/bind/zonas/db.networld.cu";
};
zone "20.10.10.in-addr.arpa" {
    type master;
    file "/etc/bind/zonas/db.10.10.20";
};
```

Creamos el directorio:
```bash
sudo nano /etc/bind/zonas
```

Creamos las zonas directa e inversa:
```bash
sudo nano /etc/bind/zonas/db.networld.cu
```
Añadimos lo siguiente:

```
$TTL 1D
@ IN SOA ns1.networld.cu. admin.networld.cu. (
    1 ; Serial
    12h ; Refresh
    15m ; Retry
    3w ; Expire
    2h ) ; Negative Cache TTL
; Registros NS
    IN NS ns1.networld.cu.
ns1 IN A 10.10.20.13
www IN A 10.10.20.13
```

```bash
sudo nano /etc/bind/zonas/db.10.10.20
```
Añadimos lo siguiente:

```
$TTL 1d ;
@ IN SOA ns1.networld.cu admin.networld.cu. (
    20210222 ; Serial
    12h ; Refresh
    15m ; Retry
    3w ; Expire
    2h ) ; Negative Cache TTL
;
@ IN NS ns1.networld.cu.
1 IN PTR www.networld.cu.
```

## 8. Comprobar la configuración

```bash
sudo named-checkzone networld.cu /etc/bind/zonas/db.networld.cu
sudo named-checkzone db.20.10.10.in-addr.arpa /etc/bind/zonas/db.10.10.20
```

Reiniciamos el servicio:

```bash
sudo systemctl restart bind9
```

Para acceder, pondremos la ip en el navegador de otro equipo.