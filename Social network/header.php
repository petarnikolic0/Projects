<?php
    session_start();
    require_once "connection.php";
    
    // $imePrez = $_SESSION['name_surname'];
    // echo "Hello," . $imePrez;
    if(empty($_SESSION["id"])) {
        header('Location: login.php');
    }
    $imePrez = $_SESSION['name_surname'];
    echo "<p class = 'objava'>Hello," . ' ' . $imePrez . "!</p>";
    
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

    <header class="head">
        <ul class="meni row">
            <li><a href="index.php">Home</a></li>
            <li><a href="followers.php">Friends</a></li>
            <li><a href="changeProfile.php">Change profile</a></li>
            <li><a href="changePass">Change password</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </header>



