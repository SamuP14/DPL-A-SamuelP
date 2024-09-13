--> git clone https://github.com/SamuP14/DPL-A-SamuelP.git
 --> clona nuestro repositorio, el cual toma del elnace que nos aparece en la página web, en nuestro equipo.

Hemos creado el archivo tarea1_1.md en la carpeta del repositorio en local, para ahora subirlo al repositorio en línea.
Para ello, primero vamos a observar el estado de la rama en el repositorio local:
--> git status
    Esto nos mostrará lo siguiente:
-----
En la rama main

No hay commits todavía

Archivos sin seguimiento:
    (usa "git add <archivo>..." para incluirlo a lo que será confirmado)
          tarea1_1.md

no hay nada agregado al commit pero hay archivos sin seguimiento presentes (usa "git add" para hacerles seguimiento)
-----

En la terminal, el nombre del archivo aparecerá en color rojo, lo que nos indica que es un cambio sin añadir.
Para añadirlo ejecutaremos la siguiente línea:
--> git add .

Comprobaremos que se ha añadido correctamente:
--> git status
    Esto nos mostrará lo siguiente:
-----
En la rama main

No hay commits todavía

Cambios a ser confirmados:
    (usa "git rm --cached <archivo>" para sacar del área de stage)
          nuevos archivos: tarea1_1.md
-----

En la terminal, la última linea se mostrará en verde, indicando que está añadido y preparado para hacer el commit.
Para ello, ejecutaremos la siguiente línea:
--> git commit -m "commit inicial"
    Con el parámetro -m le estamos indicando el comentario que recibirá nuestro commit, en este caso que es nuestro inicial.

Puede que, como fue el caso, nos solicite identificar el autor. Para ello, ejecutaremos las siguientes líneas:
--> git config --global user.email "<tu email>"
--> git config --global user.name "<tu nombre de usuario>"

Una vez hecho, volveremos a ejecutar el comando del commit. Nos deberá aparecer algo como lo siguiente:
----
[main (commit-raíz) 2b1cb23] commit inicial
 1 file changed, 3 insertions(+)
 create mode 100644 tarea1_1.md
----

Para comprobar lo último que hemos hecho, ejecutamos el siguiente comando:
--> git log
Deberá aparecer algo así:
----
commit 2b1cb2ef1a15f1bdf0dcb141c3753226b3b91074 (HEAD -> main)
Autor: <Tu nombre de usuario> <<tu email>>
Date: Fri Sep 13 15:27:01 2024 +0100
----

Ahora, guardaremos los cambios mediante el comando PUSH en el repositorio remoto.
Para ello, simplemente utilizamos el comando push:
--> git push

Si revisamos en la web, deberíamos ver todos los archivos que hayamos subido desde nuestro repositorio local.




