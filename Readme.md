# CREAR UNA RAMA  v0.2

Para crear una nueva rama v0.2 y posicionarse en ella en Git:

git checkout -b v0.2

Esto crea la rama y automáticamente nos cambia a ella.
Para verificar que estamos en la rama correcta usamos el siguiente comando:

git branch

Esto mostrará la lista de ramas locales y destacará en cuál estamos actualmente.

# AÑADIR  EL FICHERO 2.txt

Creamos el fichero 2.txt desde línea de comandos:

touch 2.txt

Para comprobar que se haya creado podemos usar el comando ls.

# CREAR UNA RAMA REMOTA v0.2

Para guardar los cambios, haremos un git add y un git commit como siempre:

git add .
git commit -m "Describe los cambios realizados"

Para que se pueda empujar el cambio al repositorio remoto, cambiaremos un poco la
sintaxis del push:

git push origin v0.2

Esto subirá la rama v0.2 al remoto (normalmente llamado origin). Para ver las ramas que existen en el remoto, podemos ejecutar los siguientes comandos:

git fetch
git branch -r

