<?php
    require_once "connection.php";
?>

<?php
    if(isset($_POST["submit"])){
        $title = $_POST['title'];


        $sql = "INSERT INTO kategorije (`title`)
        VALUES
        ('$title');";

        // $res = mysqli_query($conn, $sql);
        if($conn->query($sql)){
            echo "<p class='mesage'>Succsessfully added category</p>";
           
        }
        else{
            echo "<p class='mesage error'>Error: " . $conn->error . "</p>";
        }

    }
?>


    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Kategorija</label>
        <input type="text" id="kategorija" name="title" placeholder="naziv kategorije">

        <input type="submit" name="submit" value="Submit">
    </form>


</body>
</html>