<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Projekat citati</title>
    <style>
     .carousel-inner img {
    width: 100%;
    height: 100%;
  }
    </style>
</head>
<body style="background: url(background/background.jpg)" class="page-holder bg-cover">
        <?php
//slike
            $slike = array("1aa.jpg", "2aa.jpg", "3aa.jpg", "4aa.jpg", "5aa.jpg", "6aa.jpg", "7aa.jpg", "8aa.jpg", "9aa.jpg", "10aa.jpg");
            $int = rand(0, count($slike) - 1);
            $int1 = rand(0, count($slike) - 1);
            $int2 = rand(0, count($slike) - 1);

            for($i = 1; $i < count($slike); $i++){
                if($int === $int1 || $int === $int2){
                    $int = rand(0, count($slike) - 1);
                }
            }
            for($i = 1; $i < count($slike); $i++){
                if($int1 === $int || $int1 === $int2){
                    $int1 = rand(0, count($slike) - 1);
                }
            }
            for($i = 1; $i < count($slike); $i++){
                if($int2 === $int || $int2 === $int1){
                    $int2 = rand(0, count($slike) - 1);
                }
            }
//citati
            //zdravlje

            $zdravlje = file("citati/zdravlje.txt");
            $brojac = count($zdravlje);
            $broj2 = $brojac / 2;
            $cit2 = round(rand(0, $broj2 -1));
            $citat2 = $cit2 * 2;
            $autor2 = $citat2 + 1;
        ?>
        <div class="bg-warning text-center fixed-top">
            <h1 class='bg-warning'><a href="index.php" class="text-decoration-none text-dark bg-warning">Pocetna</a></h1>
        </div>
       
       <header id="slajd" class="carousel slide container" data-ride="carousel" > 

            <ul class="carousel-indicators">
                <li data-target="#slajd" data-slide-to="0" class="active"></li>
                <li data-target="#slajd" data-slide-to="1"></li>
                <li data-target="#slajd" data-slide-to="2"></li>
            </ul>

            <div class="carousel-inner" >
                <div class="carousel-item active">
                    <?php
                        echo "<img class='img-fluid'  src='images/$slike[$int]' alt='img1'>";
                    ?>
                </div>
                <div class="carousel-item">
                    <?php
                        echo "<img class='img-fluid' src='images/$slike[$int1]' alt='img2'>";
                    ?>
                    </div>
                <div class="carousel-item">
                <?php
                        echo "<img class='img-fluid' src='images/$slike[$int2]' alt='img3'>";
                    ?>
                </div>
            </div>

            <a class="carousel-control-prev" href="#slajd" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slajd" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </header>

        <nav class= "navbar-light navbar-expand-sm font-weight-bold text-decoration-none list-unstyled lead bg-warning">
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="posao.php">Posao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="zdravlje.php">Zdravlje</a></li>
                <li li class="nav-item">
                    <a class="nav-link" href="ljubav.php">Ljubav</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="motivacija.php">Motivacija</a>
                </li>
            </ul>
        </nav>
        
        <section class=" text-light text-center opacity-100 row">

            <p>
                <?php
                    echo "<h1 class='col-sm-12 col-md-12 col-xl-12'>$zdravlje[$citat2]</h1>";
                    echo "<h3 class='col-sm-12 col-md-12 col-xl-12'>$zdravlje[$autor2]</h3>";
                ?>
            </p>

        </section>

        <footer class="container-fluid fixed-bottom bg-transparent text-light text-right">
            <div>
                <?php
                    $datum = date("d/m/Y");
                    echo "$datum &nbsp";
                    $vreme = date("H:i:sa");
                    echo $vreme;
                ?>
            </div>
        </footer>
</body>
</html>