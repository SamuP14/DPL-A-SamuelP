<?php
    include("conexion.php");

    $sql = "SELECT * FROM `users`;";
    $data = mysqli_query($conn, $sql);
    $data_array = array();
    while ($row = mysqli_fetch_array($data)){
        $data_array[] = $row;
    }

    for ($i = 0; $i <= count($data_array) - 1; $i++) {
        echo "<br>";
        echo "ID: ";
        print_r($data_array[$i][0]);
        echo "<br>";
        echo "Name: ";
        print_r($data_array[$i][1]);
        echo "<br>";
        echo "Email: ";
        print_r($data_array[$i][2]);
        echo "<br>";
        echo "Created: ";
        print_r($data_array[$i][3]);
        echo "<br>";
    }

    mysqli_close($conn);