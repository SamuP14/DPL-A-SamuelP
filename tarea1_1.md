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

Ahora, crearemos una carpeta privada y un fichero privado.txt, para lo cual usarremos los siguientes comandos:
--> touch privado.txt
    Crea el fichero
--> mkdir privada
    Crea la carpeta

Para que github reconozca la carpeta, debe tener algún contenido, por lo que copiaremos en ella el fichero que acabamos de crear.

Ahora, guardamos los cambios en el repositorio remoto.

Como son archivos privados, hagamos que sean ignorados por git. Para ello, crearemos el fichero .gitingnore:
--> touch .gitignore
En el explorador de archivos marcaremos la opción de mostrar los elementos ocultos, y veremos que se ha creado el fichero .gitignore y la carpeta .git

Dentro del fichero .gitignore añadiremos los elementos que querramos borrar, en este caso
    privada/
    privado.txt

Para que al guardar los cambios reconozca los elementos ocultos y no los muestre en el repositorio remoto, tendremos que borrar el caché:
--> git rm --cached privado.txt
--> git rm --cached ./privada

Ahora, si comprobamos el repositorio remoto, veremos que los elementos no se muestran, mientras que en local podemos seguir viéndolos.

Vamos a crear un fichero y un tag para el repositorio:
--> touch 1.txt
    Creamos el fichero 1.txt
--> git tag -a v0.1 -m "Version 0.1"
    Creamos la etiqueta, o tag, v0.1, y le damos la descripción "Version 0.1".

Para enviar el tag al repositorio remoto, usaremos este comando:
--> git push origin v0.1

Guardamos los cambios en el repositorio remoto y podremos ver el fichero y la etiqueta, cada cual en su respectivo apartado.

Ahora vamos a activar la autentificación en dos pasos:
En el apartado de nuestro perfil, iremos a la sección de "Password and authentication". (ver 2FA-01.png)
Una vez ahí, nos desplazaremos hasta donde dice "Two-factor authentication" y pulsamos sobre el botón verde. (ver 2FA-02.png)
Nos pedirá instalar una app o extensión, pero vamos a tomar la opción de verificar mediante SMS. Para ello, seleccionamos la opción. (ver 2FA-03.png)
Le daremos a verificar y rellenaremos el captcha. (ver 2FA-04.png)
Pondremos nuestro teléfono y pediremos que envíe el código de autentificación. (ver 2FA-05.png)
Una vez pongamos el código, nos pedirá que descarguemos los códigos de recuperación. Luego, le daremos al botón que indica que ya lo hemos guardado. (ver 2FA-06.png)
Una vez hecho, le daremos al botón verde. (ver 2FA-07.png)

Vamos a seguir el repositorio de algún compañero.
Para ello, iremos a la barra de busqueda (ver FCM-01.png) y buscaremos el nombre de usuario de nuestro compañero (ver FCM-02.png - 1). En este caso buscamos a Samuel Sánchez. 
Una vez encontrado, iremos al apartado "Code" (ver FCM-02.png - 2) y seleccionaremos su repositorio (ver FCM-02.png - 3). Una vez dentro, en la parte superior, 
buscaremos el nombre de usuario y pincharemos en él (ver FCM-03.png). Finalmente, le daremos al botón "Follow" (ver FCM-04.png).
Aprovechando que estamos dentro de su repositorio, le daremos una estrella. 
Para ello iremos al apartado "Star" (ver GS-01.png) y lo pulsaremos, cambiando a "Starred" y poniéndose la estrella de color amarillo (ver GS-02.png).


|------------------------------------------------------------------|
|     Nombre      |                    Enlace                      |
|-----------------|------------------------------------------------|
| David Luis      | https://github.com/David-Luis-Mora/DPL_A_David |
|-----------------|------------------------------------------------|
| Samuel Sánchez  |   https://github.com/Shulkioras/DPL_A_SamuelS  |
|-----------------|------------------------------------------------|
|   Mario Pérez   |https://github.com/SuperWarioGalaxy/DPL_A_MARIO |
|------------------------------------------------------------------|
