<?php

    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $database = "mreza";

    $conn = new mysqli($servername, $username, $password, $database);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

?>