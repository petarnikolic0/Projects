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
<?php
    //Otvaranje sesije na pocetku stranice
    session_start();

    require_once "connection.php";
    $usernameErr = $passwordErr = "*";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $valid = true;

        if(empty($username)){
            $valid = false;
            $usernameErr = "Username cannot be left blank";
        }
        if(empty($password)){
            $valid = false;
            $passwordErr = "Password cannot be left blank";
        }
        if($valid){
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                $usernameErr = "This username doesnt't exist";
        }
        else{
            $row = $result->fetch_assoc();
            $dbPass = $row['pass']; //data base sifra
            if($dbPass != md5($password)){
                $passwordErr = "Incorrect password";
            }
            else{
                $_SESSION['id'] = $row['id'];
                //$_SESSION['full_name'] = da izvucemu full name i da ga izvlacimo u sesiju preko join tabela
                $id = $_SESSION['id'];
                $sql2 = "SELECT CONCAT(name, ' ' ,surname) AS 'name_surname', user_id FROM profiles
                WHERE user_id = $id";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                $_SESSION['name_surname'] = $row2['name_surname'];
                
                header('Location: followers.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="#" method="POST" class="forma">
        <fieldset class = "fieldset">
            <legend class = "legend">Login</legend>
            <div class="row">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <span class='error'><?php echo $usernameErr ?></span>
            </div>
            <div class="row">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <span class='error'><?php echo $passwordErr ?></span>
            </div>
            <div class="row">
                <input class="submit" type="submit" value="Log in">
            </div>
        </fieldset>
    </form>

</body>
</html>

