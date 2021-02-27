<?php

    require_once "header.php";
    require_once "funkcijeReg.php";

    $oldErr = $newErr = $retypeNewErr = "*";
    $old = $new = $retypeNew = "";
    $valid = true;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $old = $_POST['old'];
        $new = $_POST['new'];
        $retypeNew = $_POST['retypeNew'];
        

        if(passwordV($old)){
            $valid = false;
            $oldErr = passwordV($old);
        }

        if(newV($new, $old)){
            $valid = false;
            $newErr = newV($new, $old);
        }

        if(retypeV($retypeNew, $new)){
            $valid = false;
            $retypeNewErr = retypeV($retypeNew, $new);
            }
        
        if($valid){
            
            $old = $conn->real_escape_string($_POST['old']);
            $new = $conn->real_escape_string($_POST['new']);
            $retypeNew = $conn->real_escape_string($_POST['retypeNew']);

            
            $sql = "SELECT pass
                 FROM users
                 WHERE id = " . $_SESSION['id'] ;
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $password = $row['pass'];
            if(md5($old) != $password){
                echo  "<p class='error'>Wrong password</p>";

            }
            else{
                $sql = "UPDATE users
                SET pass = md5('$new')
                WHERE id = " . $_SESSION['id'];
                $conn->query($sql);

                header('Location: followers.php');
            }
        }
    }

?>

<form action="#" method="POST" class="forma">
    <fieldset class = "fieldset">
        <legend class = "legend">Change password</legend>
        <div>
            <label class="col-12" for="">old password:</label>
            <input class="col-12" type="password" name="old" id="">
            <span class="error"> <?php if($oldErr){echo $oldErr;} ?></span>
        </div>
        <div>
            <label class="col-12" for="">New password:</label>
            <input class="col-12" type="password" name="new" id="">
            <span class="error"> <?php if($newErr){echo $newErr;} ?></span>
        </div>
        <div>
            <label class="col-12" for="">Retype new password:</label>
            <input class="col-12" type="password" name="retypeNew" id="">
            <span class="error"> <?php if($retypeNewErr){echo $retypeNewErr;} ?></span>
        </div>
        <div>
            <input type="submit" value="submit">
        </div>
    </fieldset>
</form>


</body>
</html>