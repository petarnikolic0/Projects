<?php

    require_once "connection.php";

    $sql = "CREATE TABLE IF NOT EXISTS admin (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        full_name VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL
    ) ENGINE=InnoDB;";

    $sql .= "CREATE TABLE IF NOT EXISTS kategorije(
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(110) NOT NULL
    ) ENGINE=InnoDB;";

    $sql .="CREATE TABLE IF NOT EXISTS klijenti(
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        naziv_firme VARCHAR(100) NOT NULL,
        adresa VARCHAR(100) NOT NULL,
        broj_telefona VARCHAR(100) NOT NULL,
        classic_procenat VARCHAR(3) NOT NULL,
        premium_procenat VARCHAR(3) NOT NULL,
        kategorije_id INT UNSIGNED NOT NULL,
        FOREIGN KEY(kategorije_id) REFERENCES kategorije(id)
    ) ENGINE=InnoDB;";

    if($conn->multi_query($sql)){
        echo "Sucessfully created tables";
    }
    else{
        echo "Error while trying to create tables: " . $conn->error;
    }

?>