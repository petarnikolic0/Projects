<?php
    session_start();

    if(isset($_SESSION['id'])){
        $_SESSION = array(); // ili session_unset();
        session_destroy();
    }

    header('Location: login.php');

?>