<?php
    include("conexion.php");

    $insert = "INSERT INTO users(name, email) 
                VALUES('Tito Calderón', 'calderero99@gmail.com')
            ";
    $return = mysqli_query($conn, $insert);

    echo "<pre>";
    print_r($return);

    mysqli_close($conn);