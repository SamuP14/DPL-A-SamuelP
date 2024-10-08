<?php

    if(!$_POST){
        header('Location: http://localhost/prueba/conexion/index.php');
    }
    
    $name = $_POST['name'];
    $email = $_POST['email'];

    