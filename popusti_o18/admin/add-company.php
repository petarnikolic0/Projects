<?php
    require_once "connection.php";
    require_once "menu.php";
?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Naziv firme</label>
        <input type="text" name='naziv_firme' placeholder="naziv firme">

        <br>

        <label for="">Adresa</label>
        <input type="text" name='adresa' placeholder="adresa">

        <br>

        <label for="">Broj telefona</label>
        <input type="text" name='broj_telefona' placeholder='+381 xxxxxxxxx'>

        <br>

        <label for="">Kategorija</label>
        <select name="category">
            <?php
                $sql = "SELECT * FROM kategorije";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        
                        ?>

                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                        <?php
                        }
                    }
                    else{
                        ?>
                            <option value="0">No categories found</option>
                        <?php
                    }
            ?>
        </select>

        <br>

        <label for="">Classic procenat</label>
        <input type="text" name="classic_procenat" >

        <br>

        <label for="">Premium procenat</label>
        <input type="text" name="premium_procenat">

        <br>

        <input type="submit" name='submit' value='add company'>
    </form>

    <?php

            if(isset($_POST['submit'])){
                $naziv_firme = $_POST['naziv_firme'];
                $adresa = $_POST['adresa'];
                $broj_telefona = $_POST['broj_telefona'];
                $classic_procenat = $_POST['classic_procenat'];
                $premium_procenat = $_POST['premium_procenat'];
                $category = $_POST['category'];

                $sql2 = "INSERT INTO klijenti SET
                    naziv_firme = '$naziv_firme',
                    adresa = '$adresa',
                    broj_telefona = '$broj_telefona',
                    classic_procenat = '$classic_procenat',
                    premium_procenat = '$premium_procenat',
                    kategorije_id = '$category'
                ";

                if($conn->query($sql2)){
                    echo "<p class='mesage'>Succsessfully added client</p>";
                
                }
                else{
                    echo "<p class='mesage error'>Error: " . $conn->error . "</p>";
                }

            }

    ?>

</body>
</html>
