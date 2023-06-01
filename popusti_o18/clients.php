<?php


class Client
{

    public $title;
    public $naziv_firme;
    public $adresa;
    public $broj_telefona;
    public $classic_procenat;
    public $premium_procenat;
    public $kategorije_id;

    public function __construct($title, $naziv_firme, $adresa, $broj_telefona, $classic_procenat, $premium_procenat, $kategorije_id)
    {
        $this->title = $title;
        $this->naziv_firme = $naziv_firme;
        $this->adresa = $adresa;
        $this->broj_telefona = $broj_telefona;
        $this->classic_procenat = $classic_procenat;
        $this->premium_procenat = $premium_procenat;
        $this->kategorije_id = $kategorije_id;
    }
}

?>

<section id="tema">
    <div class="container-md">
        <div class="text-center">
            <h1 class="naslov">Premium i Classic kartica</h1>
            <!-- <p class="paragraf lead">Ispod mozete videti spisak firmi sa kojima saradjujemo</p> -->
        </div>

        <div class="row my-5 g-5 justify-content-around align-items-center">
            <div class="col-6 col-lg-4">
                <img class="img-fluid" src="images/Classic.png" alt="">
            </div>
            <div class="col-6 col-lg-4">
                <img class="img-fluid" src="images/Premium.png" alt="">
            </div>

            <div class="sekcija col-lg-8">
                <!--*************** Padajuci ***************-->
                <div class="accordion" id="chapter">
                    <?php

                    // $sql = "SELECT * FROM kategorije";
                    $sql = "SELECT title, naziv_firme, adresa, broj_telefona, classic_procenat, premium_procenat, kategorije_id 
                                FROM kategorije, klijenti
                                WHERE kategorije.id = kategorije_id
                                ";

                    $res = mysqli_query($conn, $sql);
                    $allClients = array();
                    $count = mysqli_num_rows($res);

                    for ($i = 0; $i <= 7; $i++) {
                        array_push($allClients, array());
                    }

                    while ($row = mysqli_fetch_assoc($res)) {
                        array_push($allClients[$row['kategorije_id']], new Client($row['title'], $row['naziv_firme'], $row['adresa'], $row['broj_telefona'], $row['classic_procenat'], $row['premium_procenat'], $row['kategorije_id']));
                    }

                    for ($i = 0; $i <= 7; $i++) {
                        $categoryCount = count($allClients[$i]);
                        if ($categoryCount > 0) {
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-<?php echo $i; ?>">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#chapter-<?php echo $i; ?>" aria-expanded="true" aria-controls="chapter-<?php echo $i; ?>">
                                        <?php echo $allClients[$i][0]->title; ?>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                </h2>
                                <div id="chapter-<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo $i; ?>" datta-bs-parents="#chapters">
                                    <div class="accordion-body">
                                        <table class='table table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Naziv firme</th>
                                                    <th>Adresa</th>
                                                    <th>Broj telefona</th>
                                                    <th>Classic</th>
                                                    <th>Premium</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                for ($j = 0; $j < $categoryCount; $j++) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $j + 1; ?>.</td>
                                                        <td><?php echo $allClients[$i][$j]->naziv_firme; ?></td>
                                                        <td><?php echo $allClients[$i][$j]->adresa; ?></td>
                                                        <td><?php echo $allClients[$i][$j]->broj_telefona; ?></td>
                                                        <td><?php if ($allClients[$i][$j]->classic_procenat >= 20) {
                                                                echo '<span style=color:red>' . $allClients[$i][$j]->classic_procenat . '</span>';
                                                            } else {
                                                                echo $allClients[$i][$j]->classic_procenat;
                                                            } ?>%</td>
                                                        <td><?php if ($allClients[$i][$j]->premium_procenat >= 20) {
                                                                echo '<span style=color:red>' . $allClients[$i][$j]->premium_procenat . '</span>';
                                                            } else {
                                                                echo $allClients[$i][$j]->premium_procenat;
                                                            } ?>%</td>
                                                    </tr>

                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>

                    <?php

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            // $id = $row['id'];
                            $title = $row['title'];
                            $naziv_firme = $row['naziv_firme'];
                            $adresa = $row['adresa'];
                            $broj_telefona = $row['broj_telefona'];
                            $classic_procenat = $row['classic_procenat'];
                            $premium_procenat = $row['premium_procenat'];
                            $kategorije_id = $row['kategorije_id'];

                    ?>

                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</section>