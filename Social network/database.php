<?php

    require_once "connection.php";

    $t = "CREATE TABLE IF NOT EXISTS users(
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        pass VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB;";

    $t .= "CREATE TABLE IF NOT EXISTS profiles(
        id INT UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        surname VARCHAR(50) NOT NULL,
        gender CHAR(1),
        dob DATE,
        user_id INT UNSIGNED UNIQUE,
        FOREIGN KEY(user_id) REFERENCES users(id)
    ) ENGINE=InnoDB;";

    $t .= "CREATE TABLE IF NOT EXISTS followers(
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        sender_id INT UNSIGNED NOT NULL,
        receiver_id INT UNSIGNED NOT NULL,
        FOREIGN KEY(sender_id) REFERENCES users(id),
        FOREIGN KEY(receiver_id) REFERENCES users(id)
    ) ENGINE=InnoDB;";

    if($conn->multi_query($t)){
        echo "<p>Uspesno kreirani upiti</p>";
    }
    else{
        echo "<p>Greska prilikom kreiranja upita: " . $conn->error . "</p>";
    }

?>