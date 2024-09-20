# CREAR UNA RAMA  v0.2

Para crear una nueva rama v0.2 y posicionarse en ella en Git:

--> git checkout -b v0.2

Esto crea la rama y automáticamente nos cambia a ella.
Para verificar que estamos en la rama correcta usamos el siguiente comando:

--> git branch

Esto mostrará la lista de ramas locales y destacará en cuál estamos actualmente.

# AÑADIR  EL FICHERO 2.txt

Creamos el fichero 2.txt desde línea de comandos:

--> touch 2.txt

Para comprobar que se haya creado podemos usar el comando ls.

# CREAR UNA RAMA REMOTA v0.2

Para guardar los cambios, haremos un git add y un git commit como siempre:

--> git add .
--> git commit -m "Describe los cambios realizados"

Para que se pueda empujar el cambio al repositorio remoto, cambiaremos un poco la
sintaxis del push:

--> git push origin v0.2

Esto subirá la rama v0.2 al remoto (normalmente llamado origin). Para ver las ramas que existen en el remoto, podemos ejecutar los siguientes comandos:

--> git fetch
--> git branch -r

# MERGE DIRECTO

Primero, nos aseguraremos de estar en la rama main:

--> git checkout main

Una vez en la rama master, realiza el merge con la rama v0.2:

--> git merge v0.2

Si hay conflictos, Git te los indicará. En este caso se nos muestra lo siguiente:

--> CONFLICTO (modificar / eliminar): tarea1_1.md eliminado en v0.2 y modificado en HEAD. Versión HEAD de tarea1_1.md restante en el árbol.
-->Fusión automática falló; arregle los conflictos y luego realice un commit con el resultado.

Debemos corregirlos manualmente. Luego de resolverlos, anos aseguraremos de añadir los archivos modificados y confirmar el merge:

--> git add <archivo_resuelto>
--> git commit
--> git push origin main

# MERGE CON CONFLICTO

Ahora vamos a forzar un conflicto. Para ello, primero nos colocaremos en la rama main:

--> git checkout main

Luego, editamos el fichero 1.txt y añadimos el texto Hola con este comando:

--> echo "Hola" > 1.txt

Podemos comprobar que se ha guardado correctamente:

--> cat 1.txt

Después, hacemos el commit de los cambios:

--> git add 1.txt
--> git commit -m "Añadido 'Hola' en el fichero 1.txt en master"

Ahora, cambiamos a la rama v0.2:

--> git checkout v0.2

Luego, editamos el fichero 1.txt y añadimos el texto Hola con este comando:

--> echo "Adios" > 1.txt

Podemos comprobar que se ha guardado correctamente:

--> cat 1.txt

Después, hacemos el commit de los cambios:

--> git add 1.txt
--> git commit -m "Añadido 'Adios' en el fichero 1.txt en v0.2"

Ahora, nos posicionaremos de nuevo en la rama principal:

--> git checkout main

Al hacerlo, nos indica lo siguiente:

--> error: Los siguientes archivos sin seguimiento en el árbol de trabajo serán sobrescritos al actualizar el árbol de trabajo:
--> 	1.txt
--> Por favor, muévelos o elimínalos antes de cambiar de rama.
--> Abortando

Para solucionarlo, en la rama actual, que debería ser v0.2, haremos lo siguiente:

--> Cambiado a rama 'main'
--> Tu rama está adelantada a 'origin/main' por 1 commit.
-->   (usa "git push" para publicar tus commits locales)

Intentaremos realizar el merge:

--> git merge v0.2

Nos devolverá lo siguiente:

--> Auto-fusionando 1.txt
--> CONFLICTO (agregar/agregar): Conflicto de fusión en 1.txt
--> Fusión automática falló; arregle los conflictos y luego realice un commit con el resultado.

Para arreglar el error, haremos lo siguiente:
En la rama main, modificaremos el fichero de esta forma:

--> echo "Hola - Adios" > 1.txt

Guardamos los cambios y nos movemos a v0.2:

--> git add 1.txt 
--> git commit -m "Resolviendo conflicto"
--> git checkout v0.2

Repetimos lo mismo en esta rama:

--> echo "Hola - Adios" > 1.txt
--> git add 1.txt 
--> git commit -m "Resolviendo conflicto"

Volvemos a la rama principal:

--> git checkout main

Nos dirá lo siguiente:

--> Cambiado a rama 'main'
--> Tu rama está adelantada a 'origin/main' por 1 commit.
-->   (usa "git push" para publicar tus commits locales)

Trataremos de hacer el merge:

--> git merge v0.2

Nos debería dar el siguiente resultado:

--> Merge made by the 'ort' strategy.

Habremos logrado resolver el conflicto.

# LISTADO DE RAMAS

Para listar las ramas que no han sido fusionadas:

--> git branch --no-merged

Para listar las ramas que sí han sido fusionadas:

--> git branch --merged

# BORRAR RAMA

Primero, nos cambiaremos a la rama v0.2 si no lo estamos ya:

--> git checkout v0.2

Luego, crearemos la etiqueta v0.2:

--> git tag -a v0.2 -m "Versión 0.2"

Con esto hemos creado la etiqueta con la descripción indicada entre comillas.
Ahora empujamos la etiqueta al repositorio remoto:

--> git push origin refs/tags/v0.2

Para eliminar la rama en local, usaremos el siguiente comando desde la rama main:

--> git branch -d v0.2

Nos devolverá lo siguiente:

--> Eliminada la rama v0.2 (era 04d0cd5).

Para eliminar la rama en remoto, usaremos el siguiente comando:

--> git push origin --delete refs/heads/v0.2

Nos devolverá lo siguiente:

--> To https://github.com/SamuP14/DPL-A-SamuelP
--> - [deleted]         v0.2

Ahora, si nos dirigimos al repositorio remoto, veremos que ha desaparecido la rama v0.2

# LISTADO DE CAMBIOS

Para listar los commits junto con sus ramas y tags en Git, podemos usar el siguiente comando:

--> git log --decorate --oneline --all

# CREAR UNA ORGANIZACIÓN

1. Iniciar sesión en GitHub:
Iremos a GitHub e iniciaremos sesión con nuestra cuenta, si aún no lo hemos hecho.

2. Acceder a la sección de organizaciones:
Haremos clic en nuestra foto de perfil en la esquina superior derecha y seleccionaremos "Your organizations" (Tus organizaciones).

3. Crear una nueva organización:
Haremos clic en el botón "New organization" (Nueva organización).
Seleccionaremos un plan (puede ser el gratuito).
Completamos la información requerida, como el nombre de la organización. Para nuestro caso, ingresaremos: 

orgdpl-SamuP14.

4. Configurar la organización:
Completaremos los detalles adicionales como la descripción y las preferencias de visibilidad.

5. Finalizar:
Haremos clic en "Create organization" (Crear organización) para finalizar el proceso.

# CREAR EQUIPOS

1. Iniciar sesión en GitHub:
Iremos a GitHub e iniciaremos sesión con nuestra cuenta, si aún no lo hemos hecho.
Haremos clic en nuestra foto de perfil en la esquina superior derecha y seleccionaremos tu organización (orgdpl-SamuP14).

2. Ir a la configuración de equipos de la organización:
Haremos clic en la pestaña "Teams" (Equipos) en la parte superior de la página de la organización.

3. Crear el equipo "administradores":
Hacemos clic en "New team" (Nuevo equipo).
Nombramos el equipo "administradores".
Configuramos los permisos como "Admin" para que tengan más control sobre los repositorios.

4. Crear el equipo "colaboradores":
Repetiremos el proceso haciendo clic en "New team" (Nuevo equipo) nuevamente.
Nombramos el equipo "colaboradores".
Configuramos los permisos como "Write" o "Read" (menos permisos que el administrador).

5. Finalizar:
Debemos asegurarnos de revisar los permisos y la configuración de cada equipo para garantizar que estén configurados correctamente.

Para añadir miembros a los equipos, seguiremos los siguientes pasos:

1. Ir a la sección de equipos:
Haremos clic en la pestaña "Teams" (Equipos) en la barra lateral izquierda.

2. Seleccionar el equipo "administradores":
Buscamos y hacemos clic en el equipo "administradores".

3. Agregar miembros al equipo:
Buscamos la opción "Add a member" (Agregar un miembro) o "Manage team" (Gestionar equipo).
Escribimos el nombre de usuario de GitHub de los miembros que querramos añadir.

4. Confirmar los cambios:
Después de añadir a todos los miembros, guardaremos los cambios si es necesario.

Para el grupo de colaboradores es exactamente igual, por lo que no debería suponer ningún problema.

# CREAR UN index.html

Usaremos un editor de texto o un comando para crear el archivo.
Guardamos los cambios y empujamos al repositorio remoto:

--> git add index.html
--> git commit -m "Añadir index.html para GitHub Pages"
--> git push

Para habilitar GitHub Pages en la interfaz web, iremos a nuestro repositorio en GitHub, y en la pestaña de configuración iremos a la sección "Pages", seleccionamos la rama que contiene el html, en este caso main, y guardamos los cambios.

Después de configurarlo, nos darán un enlace donde podremos ver nuestra página, el cual es el siguiente:

https://samup14.github.io/DPL-A-SamuelP/


