# Guía para Alojar Páginas en InfinityFree desde XAMPP

Este documento describe cómo alojar tu proyecto web desarrollado en XAMPP en un servidor remoto usando InfinityFree.

---

## Requisitos Previos

1. **XAMPP**: Proyecto funcionando en tu servidor local (localhost).
2. **Cuenta en InfinityFree**: Regístrate en [InfinityFree](https://www.infinityfree.net/).
3. **Cliente FTP**: Recomendado para subir archivos. Puedes usar [FileZilla](https://filezilla-project.org/) o el administrador de archivos de InfinityFree.

---

## Pasos para Alojar en InfinityFree

### Paso 1: Preparar los Archivos en XAMPP

1. Asegúrate de que tu proyecto funcione correctamente en `localhost` usando XAMPP.
2. Localiza la carpeta de tu proyecto dentro de `htdocs` (generalmente `C:\xampp\htdocs\nombre_del_proyecto`).
3. Comprime los archivos si prefieres una carga única o selecciona los archivos que deseas subir manualmente.

### Paso 2: Crear un Nuevo Sitio Web en InfinityFree

1. Inicia sesión en [InfinityFree](https://www.infinityfree.net/).
2. Ve a la sección **Create Account**.
3. Selecciona un nombre de dominio gratuito o utiliza un dominio propio.
4. Completa la configuración inicial de tu cuenta.

### Paso 3: Obtener los Detalles de FTP

1. En el panel de InfinityFree, selecciona el sitio web que creaste.
2. Haz clic en **Account Details**.
3. Copia los detalles de acceso FTP:
   - **Servidor FTP**
   - **Nombre de usuario**
   - **Contraseña**

### Paso 4: Subir los Archivos Usando un Cliente FTP o el Administrador de Archivos

#### Opción 1: Administrador de Archivos

1. En InfinityFree, selecciona **File Manager**.
2. Navega a la carpeta `htdocs` en el servidor remoto.
3. Sube los archivos comprimidos o directamente los archivos de tu proyecto.

#### Opción 2: FileZilla

1. Abre FileZilla e ingresa los detalles de conexión FTP.
   - **Host**: Servidor FTP de InfinityFree.
   - **Username** y **Password**: Obtenidos en el Paso 3.
2. Conéctate y navega a la carpeta `htdocs` en el servidor.
3. Arrastra los archivos desde la carpeta `htdocs` de tu proyecto en XAMPP y suéltalos en `htdocs` en el servidor.

### Paso 5: Configuración de Base de Datos (Opcional)

Si tu proyecto utiliza una base de datos, sigue estos pasos:

1. En InfinityFree, ve a la sección **MySQL Databases**.
2. Crea una nueva base de datos e ingresa los detalles en tu archivo de configuración.
3. Exporta tu base de datos desde XAMPP:
   - Abre `phpMyAdmin` en XAMPP.
   - Selecciona tu base de datos y haz clic en **Exportar**.
4. Importa la base de datos en InfinityFree:
   - En InfinityFree, ve a **phpMyAdmin** y selecciona la base de datos que creaste.
   - Importa el archivo SQL exportado desde XAMPP.

### Paso 6: Verificar el Sitio Web

1. Una vez cargados los archivos, accede a tu dominio para verificar que el sitio esté funcionando.
2. Si ves errores de configuración de base de datos, verifica las credenciales y el archivo de conexión.

---

## Subir la Documentación al Repositorio

1. Guarda este documento en un archivo llamado `Guía_Alojamiento_InfinityFree.md`.
2. Abre la terminal y asegúrate de estar en el directorio de tu repositorio.
3. Ejecuta los siguientes comandos:

   ```bash
   git add Guía_Alojamiento_InfinityFree.md
   git commit -m "Agrega guía de alojamiento en InfinityFree"
   git push origin main
