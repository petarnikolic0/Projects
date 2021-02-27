<?php
    session_start();
    require_once "connection.php";
    
    if(!empty($_SESSION["id"])){
        header('Location: followers.php');
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='indexNaslov'>
        <h1>WELCOME TO SOCIAL NETWORK</h1>
    </div>
    <div class = "index">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>

</body>
</html>