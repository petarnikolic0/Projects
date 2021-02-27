<?php
    require_once "connection.php";
    require_once "funkcijeReg.php";
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
<div>
    <?php
        $name = $surname = $gender = $date = $username = $password = $retype = "";
        $nameErr = $surnameErr = $dateErr = $usernameErr = $passwordErr = $retypeErr = "";
        $prikaz = true;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $gender = $_POST['pol'];
            $date = $_POST['datum'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $retype = $_POST['retype'];

            if(nameV($name)){
                $nameErr = nameV($name);
                $prikaz = false;
            }
            else{
                $name = trim($name);
                $name = preg_replace('/\s\s+/', ' ', $name);
            }

            if(surnameV($surname)){
                $surnameErr = surnameV($surname);
                $prikaz = false;
            }
            else{
                $surname = trim($surname);
                $surname = preg_replace('/\s\s+/', ' ', $surname);
            }

            if(dateV($date)){
                $dateErr = dateV($date);
                $prikaz = false;
            }

            if(usernameV($username, $conn)){
                $usernameErr = usernameV($username, $conn);
                $prikaz = false;
            }
        
            if(passwordV($password)){
                $passwordErr = passwordV($password);
                $prikaz = false;
            }

            if(retypeV($retype, $password)){
                $retypeErr = retypeV($retype, $password);
                $prikaz = false;
            }
			
			if($prikaz){

            $name = $conn->real_escape_string($name);
            $surname = $conn->real_escape_string($surname);
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);
            
            

            $sql = "INSERT INTO users (username , pass)
                VALUES
                ('$username', md5('$password'));";

            if($conn->query($sql)) {
                $t = "SELECT id FROM users 
                WHERE username LIKE '$username'";

                $result = $conn->query($t);
                $row = $result->fetch_assoc();
                $id = $row['id'];

                $t = "INSERT INTO profiles (name, surname, gender, dob, user_id)
                VALUES
                ('$name', '$surname', '$gender', '$date', '$id')";

                

                if($conn->query($t)){
                    echo "<p class='mesage'>Succsessfully created account</p>";
                   
                }
                else{
                    echo "<p class='mesage error'>Error: " . $conn->error . "</p>";
                }
            }
            else{
                echo "<p class='mesage error'>Error: " . $conn->error . "</p>";
            }
            header("Location: login.php");
       }
        }
    ?>
    
    <form action="#" method="POST" class="forma">
        <fieldset class = "fieldset">
            <legend class = "legend">Create account</legend>
            <div class="row">
                <label class="col-12" for="">NAME</label>
                <input class="col-12" type="text" name="name" value="<?php echo $name; ?>" maxlength="50">
                <span class="error"> <?php if($nameErr){echo '*'; echo $nameErr;} ?></span>
            </div>
            <div class="row">
                <label class="col-12" for="">SURNAME</label>
                <input class="col-12" type="text" name="surname" value="<?php echo $surname; ?>" maxlength="50">
                <span class="error"><?php if($surnameErr){echo '*'; echo $surnameErr;} ?></span>
            </div>
            <div class="row">
                <label for="">GENDER: </label>
                <input type="radio" name="pol" value="m">male
                <input type="radio" name="pol" value="f">female
                <input type="radio" name="pol" value="o" checked>other
            </div>
            <div class="row">
                <label class="col-12" for="">DATE OF BIRTH</label>
                <input class="col-12" type="date" name="datum" min="1900-01-01" id=""> 
                <span class = "error"><?php if($dateErr){echo '*'; echo $dateErr;} ?></span>
            </div>
            <div class="row">
                <label class="col-12" for="">USERNAME</label>
                <input class="col-12" type="text" name="username" value="<?php echo $username; ?>" minlength="5" maxlength="50">
                <span class="error"><?php if($usernameErr){echo '*'; echo $usernameErr;} ?></span>
            </div>
            <div class="row">
                <label class="col-12" for="">PASSWORD</label>
                <input class="col-12" type="password" name="password" value="<?php echo $password; ?>">
                <span class="error"><?php if($passwordErr){echo '*'; echo $passwordErr;} ?></span>
            </div>
            <div class="row">
                <label class="col-12" for="">RETYPE PASSWORD</label>
                <input class="col-12" type="password" name="retype" value="<?php echo $retype; ?>">
                <span class="error"><?php if($retypeErr){echo '*'; echo $retypeErr;} ?></span>
            </div>
            <div class="row">
                <input class="submit" type="submit" name="submit" value="submit">
            </div>
        </fieldset>
    </form>   
    
    </div>
​
</body>
</html>

