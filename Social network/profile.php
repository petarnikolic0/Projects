<?php

    require_once "header.php";
    require_once "connection.php";

    $id = $_GET['user_id'];

    if(empty($id)){
        echo "<p class = 'paragrafError'>Error</p>";
    }
    else{

        $sql = "SELECT id FROM users WHERE id=$id";

        $result=$conn->query($sql);
        
        if($result->num_rows == 0){
            echo "<p class='noId'>This user does not exist!!!</p>";
        }
        else{
            $t = "SELECT profiles.name AS 'pn' , profiles.surname AS 'ps', users.username AS 'uu',
            profiles.gender AS 'pg' , profiles.dob AS 'pd', profiles.bio AS 'pbi', users.id
            FROM profiles
            INNER JOIN users
            ON profiles.user_id = users.id
            WHERE users.id = '$id'";
    
            $result = $conn->query($t);
            $row = $result->fetch_assoc();
            $name = $row['pn'];
            $surname = $row['ps'];
            $username = $row['uu'];
            $date = $row['pd'];
            $gender = $row['pg'];
            $bio = $row['pbi'];
    
            if($gender == 'm'){
                $color = 'blue';
            }
            elseif($gender == 'f'){
                $color = 'pink';
            }
            else{
                $color = 'lightgray';
            }
    
                echo "<div>";
                    echo "<table class='tabela'>";
    
                        echo "<tr>";
                            echo "<td>First name</td>";
                            echo "<td style='color:$color'>" . $name . "</td>";
                        echo "</tr>";
    
                        echo "<tr>";
                            echo "<td>Last name</td>";
                            echo "<td style='color:$color'>" . $surname . "</td>";
                        echo "</tr>";
    
                        echo "<tr>";
                            echo "<td>Username</td>";
                            echo "<td style='color:$color'>" . $username . "</td>";
                        echo "</tr>";
    
                        echo "<tr>";
                            echo "<td>Date of birth</td>";
                            echo "<td style='color:$color'>" . $date . "</td>";
                        echo "</tr>";
    
                        echo "<tr>";
                            echo "<td>Gender</td>";
                            echo "<td style='color:$color'>" . $gender . "</td>";
                        echo "</tr>";
    
                        echo "<tr>";
                            echo "<td>About me</td>";
                            echo "<td style='color:$color'>" . $bio . "</td>";
                        echo "</tr>";
    
                    echo "</tabela>";
                echo "</div>";
    
                echo "<div id='back'>";
                echo "<p><a href='followers.php'>< Back to followers</a></p>";
                echo "</div>";
        }

       
        }





?>

</body>
</html>