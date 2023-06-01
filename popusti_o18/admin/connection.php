<?php

    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $database = "popusti_018";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn->connect_error){
        die("Unsucessfull connection: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');

?>