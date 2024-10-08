<?php
    include("conexion.php");

    $update = "UPDATE users
                SET name = 'Juanma Castaño'
                WHERE id = 4    
            ";
    $return = mysqli_query($conn, $update);

    echo "<pre>";
    print_r($return);

    mysqli_close($conn);
