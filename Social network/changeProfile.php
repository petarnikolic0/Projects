<?php
    require_once "connection.php";
    require_once "header.php";
    require_once "funkcijeReg.php";

    $id = $_SESSION["id"];
    //Postavljanje početnih vrednosti
    $valid = true;
    $name = $surname = $gender = $date = $textarea ="";
    $nameErr = $surnameErr = $dateErr = $textareaErr = "";

    $q = "SELECT * FROM profiles WHERE user_id = $id";

    $result = $conn->query($q);
    $red = $result->fetch_assoc();
    $name = $red['name'];
    $surname = $red['surname'];
    $gender = $red['gender'];
    $date = $red['dob'];
    $textarea = $red['bio'];

    

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $gender = $_POST['gender'];
        $date = $_POST['dob'];
        $textarea = $_POST['bio'];
        

        if(nameV($name)){
            $nameErr = nameV($name);
            $valid = false;
        }
        else{
            $name = trim($name);
            $name = preg_replace('/\s\s+/', ' ', $name);
        }
        if(surnameV($surname)){
            $surnameErr = surnameV($surname);
            $valid = false;
        }
        else{
            $surname = trim($surname);
            $surname = preg_replace('/\s\s+/', ' ', $surname);
        }
        if(dateV($date)){
            $dateErr = dateV($date);
            $valid = false;
        }
        if(textareaV($textarea)){
            $textareaErr = textareaV($textarea);
            $valid = false;
        }
        
        if($valid){
            $name = $conn->real_escape_string($_POST['name']);
            $surname = $conn->real_escape_string($_POST['surname']);
            $textarea = $conn->real_escape_string($_POST['bio']);

            $sql = "UPDATE profiles 
                    SET 
                    name = '$name', surname = '$surname', gender = '$gender', dob = '$date', bio = '$textarea'
                    WHERE user_id = $id";

            $conn->query($sql);

            $id = $_SESSION['id'];
            $sql2 = "SELECT CONCAT(name, ' ' ,surname) AS 'name_surname', user_id FROM profiles
            WHERE user_id = $id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $_SESSION['name_surname'] = $row2['name_surname'];


            header('Location: changeProfile.php');
        }
    }

?>

<form action="#" method="POST" class="forma">
    <fieldset class = "fieldset">
        <legend class = "legend">Change profile</legend>
        <div>
            <label class="col-12" for="">Ime:</label>
            <input class="col-12" type="text" name="name" id="" value="<?php echo $name ?>"">
            <span class="error"> <?php if($nameErr){echo $nameErr;} ?></span>
        </div>
        <div>
            <label class="col-12" for="">Prezime:</label>
            <input class="col-12" type="text" name="surname" id="" value="<?php echo $surname ?>">
            <span class="error"> <?php if($surnameErr){echo $surnameErr;} ?></span>
        </div>
        <div>
            <label class="col-12" for="">Datum rodjenja:</label>
            <input class="col-12" type="date" name="dob" id="" value="<?php echo $date ?>">
            <span class="error"> <?php if($dateErr){echo $dateErr;} ?></span>
        </div>
        <div>
            <label for="">Pol:</label>
            <input type="radio" name="gender" id="" value="m" <?php if($gender=='m'){echo 'checked';}?>>Muski  
            <input type="radio" name="gender" id="" value="z" <?php if($gender=='z'){echo 'checked';}?>>Zenski 
            <input type="radio" name="gender" id="" value="o" <?php if($gender!="m" && $gender!="f"){echo 'checked';} ?>>Ostalo
        </div>
        <div>
            <label for="">Biografija:</label>
            <textarea name="bio" id="" cols="30" rows="10"><?php echo $textarea; ?></textarea>
            <span class="error"> <?php if($textareaErr){echo $textareaErr;} ?></span>
        </div>
        <div>
            <input type="submit" value="submit">
        </div>
    </fieldset>
</form>

</body>
</html>