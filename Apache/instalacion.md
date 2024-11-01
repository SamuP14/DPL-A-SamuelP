# Preguntas 1 y 2

## La arquitectura Web es un modelo compuesto de tres capas, ¿cuáles son y cuál es la función de cada una de ellas?

La arquitectura web se organiza en **tres capas** o niveles: **Presentación**, **Lógica** y **Datos**. A continuación detallamos la función de cada una:

### 1. Capa de Presentación
Esta capa se encarga de la **interfaz de usuario** y la **experiencia visual**. Incluye todos los elementos gráficos, controles y componentes con los que interactuamos.

- **Tecnologías**: HTML, CSS y JavaScript.
- **Función**: recibir nuestra entrada y mostrar los resultados procesados por la capa de lógica.

### 2. Capa Lógica (o Capa de Negocio)
Es el núcleo de la aplicación, donde se implementa la **lógica de negocio** y se procesan las reglas que definen el funcionamiento del sistema.

- **Tecnologías**: Python, PHP, Java, Node.js, etc.
- **Función**: interpretar los datos de la capa de presentación, procesar las solicitudes, aplicar la lógica de negocio y comunicarse con la capa de datos para acceder o manipular la información.

### 3. Capa de Datos
Esta capa maneja el **almacenamiento y organización de los datos**. Contiene las bases de datos que nos permiten realizar operaciones de manipulación y consulta de información.

- **Tecnologías**: Bases de datos relacionales (MySQL, PostgreSQL) y NoSQL (MongoDB).
- **Función**: organizar, almacenar y proteger los datos necesarios para la aplicación.

---

## Una plataforma web es el entorno de desarrollo de software empleado para diseñar y ejecutar un sitio web; destacan dos plataformas web, LAMP y WISA. Explica en qué consiste cada una de ellas.

Las plataformas **LAMP** y **WISA** son entornos de desarrollo web que incluyen un conjunto de tecnologías específicas para diseñar y ejecutar aplicaciones web.

### Plataforma LAMP
La plataforma LAMP es una combinación de tecnologías **de código abierto** ampliamente usada para el desarrollo web. Su nombre deriva de las iniciales de las siguientes herramientas:

- **L**inux: el sistema operativo.
- **A**pache: el servidor web que procesa las solicitudes y responde a los usuarios.
- **M**ySQL: el sistema de gestión de bases de datos relacional.
- **P**HP (u otros lenguajes como Perl o Python): el lenguaje de programación del lado del servidor.

> **Función**: LAMP es popular en el desarrollo de aplicaciones web de código abierto, proporcionando una estructura flexible, económica y compatible con la mayoría de servidores de Internet.

### Plataforma WISA
La plataforma WISA es un entorno de desarrollo impulsado por tecnologías de **Microsoft**. Su nombre proviene de las iniciales de las siguientes herramientas:

- **W**indows: el sistema operativo.
- **I**IS (Internet Information Services): el servidor web de Microsoft.
- **S**QL Server: el sistema de gestión de bases de datos de Microsoft.
- **A**SP.NET: el marco de desarrollo web para aplicaciones dinámicas de Microsoft.

> **Función**: WISA es ideal para aplicaciones empresariales que requieren la integración con otros productos de Microsoft, ofreciendo un entorno robusto y optimizado para Windows.

# Configuración de Servidor Web Apache y Tomcat en Ubuntu 10.04 LTS

## 1. Instalar el servidor web Apache desde la terminal

Para instalar Apache en Ubuntu, seguimos estos pasos:

~~~
# Actualizar el índice de paquetes
apt-get update

# Instalar el servidor Apache
apt-get install apache2 -y
~~~

## 2. Comprobar que está funcionando el servidor Apache desde la terminal

Una vez instalado Apache, verificamos su estado con el siguiente comando:

~~~
# Comprobar el estado del servicio Apache
service apache2 status
~~~

Otra opción es verificar que el servidor esté escuchando en el puerto 80:

~~~
# Listar los servicios que están escuchando en los puertos
netstat -tuln | grep :80
~~~

Si Apache está funcionando correctamente, deberíamos ver el puerto 80 en la salida.

## 3. Comprobar que está funcionando el servidor Apache desde el navegador

Para comprobar que el servidor Apache está funcionando desde el navegador, abrimos un navegador web e ingresamos la dirección IP de nuestra máquina o localhost en la barra de direcciones:

http://localhost

Si Apache está funcionando, deberíamos ver la página de inicio predeterminada de Apache.

## 4. Cambiar el puerto por el cual está escuchando Apache, pasándolo al puerto 82

Para cambiar el puerto de Apache, editamos el archivo de configuración y cambiamos el puerto predeterminado de 80 a 82:

~~~
# Editar el archivo de configuración de Apache
nano /etc/apache2/ports.conf
~~~

Buscamos la línea:

~~~
Listen 80
~~~

y la cambiamos por:

~~~
Listen 82
~~~

Luego, editamos el archivo de configuración de nuestro sitio en:

~~~
nano /etc/apache2/sites-enabled/000-default
~~~

En este archivo, cambiamos también el puerto 80 a 82 en la siguiente línea:

~~~
<VirtualHost *:82>
~~~

Guardamos y cerramos el archivo, luego reiniciamos Apache para aplicar los cambios:

~~~
# Reiniciar Apache
service apache2 restart
~~~

Para comprobar que Apache está escuchando en el puerto 82, ejecutamos:

~~~
netstat -tuln | grep :82
~~~

Ahora, en el navegador web, accedemos a http://localhost:82 para confirmar que Apache se está ejecutando en el nuevo puerto.

## 5. Instalar el servidor de aplicaciones Tomcat

Para instalar Tomcat en Ubuntu, seguimos los siguientes pasos:

1. Descargar Tomcat: Podemos descargar la última versión de Tomcat 7 compatible con Ubuntu 10.04 desde la [página oficial](https://tomcat.apache.org/download-70.cgi).

~~~
# Cambia a la carpeta /opt
cd /opt

# Descarga la versión de Tomcat 7 con wget (reemplaza URL con la URL de descarga directa)
wget https://archive.apache.org/dist/tomcat/tomcat-7/v7.0.109/bin/apache-tomcat-7.0.109.tar.gz

# Extrae el archivo
tar -xvf apache-tomcat-7.0.109.tar.gz

# Cambia el nombre de la carpeta para facilitar el acceso
mv apache-tomcat-7.0.109 tomcat7
~~~

2. Iniciar Tomcat:

~~~
# Navega a la carpeta de Tomcat y ejecuta el script de inicio
cd /opt/tomcat7/bin
./startup.sh
~~~

3. Verificar que Tomcat está funcionando:

Para verificar que Tomcat está funcionando, abrimos nuestro navegador y vamos a la siguiente URL:

http://localhost:8080

Deberíamos ver la página de inicio de Apache Tomcat si todo está funcionando correctamente.

## Conclusión

Ahora tenemos Apache configurado en el puerto 82 y el servidor Tomcat ejecutándose en el puerto 8080 en nuestra máquina con Ubuntu 10.04 LTS.
