<?php

    require_once "connection.php";

    $t = "ALTER TABLE profiles
    ADD bio TEXT";

if($conn->query($t)){
    echo "<p>Uspesno kreirani upiti</p>";
}
else{
    echo "<p>Greska prilikom kreiranja upita: " . $conn->error . "</p>";
}
?>