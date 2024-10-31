# Guía de Alojamiento de Páginas en InfinityFree desde XAMPP

En esta guía, describimos los pasos que seguimos para alojar nuestro proyecto web, desarrollado en un servidor local XAMPP, en un servidor remoto de InfinityFree.

---

## Requisitos Previos

1. **XAMPP**: Proyecto en funcionamiento en nuestro servidor local (localhost).
2. **Cuenta en InfinityFree**: Nos registramos en [InfinityFree](https://www.infinityfree.net/).
3. **Cliente FTP**: Utilizamos el cliente [FileZilla](https://filezilla-project.org/) para facilitar la transferencia de archivos.

---

## Pasos Realizados para Alojar en InfinityFree

### Paso 1: Preparación de los Archivos en XAMPP

1. Confirmamos que el proyecto funciona correctamente en `localhost` usando XAMPP.
2. Localizamos la carpeta del proyecto dentro de `htdocs` (generalmente en `C:\xampp\htdocs\nombre_del_proyecto`).
3. Comprimimos los archivos para una carga más sencilla o seleccionamos directamente los archivos a subir.

### Paso 2: Creación de un Nuevo Sitio Web en InfinityFree

1. Iniciamos sesión en [InfinityFree](https://www.infinityfree.net/).
2. Navegamos a la sección **Create Account**.
3. Seleccionamos un nombre de dominio gratuito o utilizamos un dominio propio.
4. Completamos la configuración inicial de la cuenta en InfinityFree.

### Paso 3: Obtención de los Detalles de FTP

1. En el panel de InfinityFree, seleccionamos el sitio web que creamos.
2. Accedimos a **Account Details** para obtener los detalles de conexión FTP:
   - **Servidor FTP**
   - **Nombre de usuario**
   - **Contraseña**

### Paso 4: Subida de los Archivos a través de Cliente FTP o Administrador de Archivos

#### Uso de FileZilla

1. Abrimos FileZilla e ingresamos los detalles de conexión FTP proporcionados.
   - **Host**: Servidor FTP de InfinityFree.
   - **Usuario** y **Contraseña**: Obtenidos en el Paso 3.
2. Nos conectamos y navegamos a la carpeta `htdocs` en el servidor.
3. Arrastramos los archivos desde `htdocs` en XAMPP y los soltamos en `htdocs` del servidor.

### Paso 5: Configuración de la Base de Datos

Para aquellos proyectos que requieran una base de datos, como en este caso, realizamos los siguientes pasos:

1. En InfinityFree, creamos una base de datos desde la sección **MySQL Databases** e ingresamos los detalles en el archivo de configuración del proyecto.
2. Exportamos la base de datos local desde XAMPP:
   - Accedimos a `phpMyAdmin` en XAMPP.
   - Seleccionamos la base de datos y clicamos en **Exportar**.
3. Importamos la base de datos en InfinityFree:
   - En InfinityFree, ingresamos a **phpMyAdmin** y seleccionamos la base de datos creada.
   - Realizamos la importación del archivo SQL exportado previamente.

### Paso 6: Verificación del Sitio Web

1. Con los archivos subidos, verificamos el acceso al sitio usando nuestro dominio.
2. En caso de errores de conexión a la base de datos, revisamos las credenciales y el archivo de conexión para confirmar que estén correctos.
