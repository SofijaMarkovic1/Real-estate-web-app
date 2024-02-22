<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>radoSTAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('js/jquery-3.7.0.js'); ?>"></script>
    <script src="<?php echo base_url('js/pretraga.js'); ?>"></script>
</head>
<body>
    <div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">

        
        <div class="row" style="overflow: auto;">
            <div class="col-sm-3 filters">
                <!--ovde ide bar sa filterima-->
                <form method="POST" action="/Login/pretraga">
                    <label for="customRange1" class="form-label">Minimalna cena: </label> <label id="minCenaLabela"></label>
                    <input type="range" class="form-range custom-range" id="minCena" min="0" max="<?php echo $maxRangeCena ?>" step="10000" value="0">
                    <input type="hidden" id="minCenaHidden" name="minCenaHidden" value="<?php echo $minRangeCena ?>">


                    <label for="customRange1" class="form-label">Maksimalna cena:</label> <label id="maxCenaLabela"></label>
                    <input type="range" class="form-range custom-range" id="maxCena" min="0" max="<?php echo $maxRangeCena ?>" step="10000" value="<?php echo $maxRangeCena ?>">
                    <input type="hidden" id="maxCenaHidden" name="maxCenaHidden" value="<?php echo $maxRangeCena ?>">

                    <label for="customRange1" class="form-label">Minimalna kvadratura: </label> <label id="minKvadraturaLabela"></label>
                    <input type="range" class="form-range custom-range" id="minKvadratura" min="0" max="<?php echo $maxRangeKvadratura ?>" step="10" value="0">
                    <input type="hidden" id="minKvHidden" name="minKvHidden" value="<?php echo $minRangeKvadratura ?>">

                    <label for="customRange1" class="form-label">Maksimalna kvadratura:</label> <label id="maxKvadraturaLabela"></label>
                    <input type="range" class="form-range custom-range" id="maxKvadratura" min="0" max="<?php echo $maxRangeKvadratura ?>"" step="10" value="<?php echo $maxRangeKvadratura ?>">
                    <input type="hidden" id="maxKvHidden" name="maxKvHidden" value="<?php echo $maxRangeKvadratura ?>">

                    <div class="row">
                        <div id="opstine" class="col-sm-6" style="margin-right: 5px solid rgb(149, 148, 148);">
                            <h6>Opština:</h6>
                            <?php
                            $i = 0;
                            foreach ($opstine as $row) {
                                $opstina = $row['opstina'];
                                echo "
                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"opstine[]\" value='opstina$i'> $opstina<br>
                                ";
                                $i++;
                            }
                            ?>
                        </div>
                        <div id="opremljenostIGrejanje" class="col-sm-6">
                            <h6>Opremljenost:</h6>
                            <?php
                            $i=0;
                            foreach ($opreme as $oprema) {
                                if($oprema->naziv=="nista") continue;
                                echo "
                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"opreme[]\" value='oprema$i'> $oprema->naziv<br>
                                ";
                                $i++;
                            }
                            ?>
                            <br/><br/>
                            <h6>Grejanje:</h6>
                            <?php
                            $i=0;
                            foreach ($grejanja as $grejanje) {
                                echo "
                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"grejanja[]\" value='grejanje$i'>$grejanje->naziv<br>
                                ";
                                $i++;
                            }
                            ?>

                        </div>
                    </div>
                    <br>
                    <div class="row" id="tip">
                        <div class="col-sm-6">
                            <h6>Tip nekretnine:</h6>
                            <?php
                            $i = 0;
                            foreach ($tipovi as $tip){
                                echo "
                                        <input type=\"checkbox\" class=\"form-check-input\" name=\"tipovi[]\" value='tip$i'>$tip->naziv<br>
                                    ";
                                $i++;
                            }
                            ?>

                        </div>
                        <div class="col-sm-6">
                            <h6>Stanje nekretnine:</h6>
                            <?php
                            $i = 0;
                            foreach ($stanja as $stanje) {
                                echo "
                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"stanja[]\" value='stanje$i'> $stanje->naziv<br>
                                ";
                                $i++;
                            }
                            ?>

                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-select" id="selectBar" name="selectBar" style="margin-left: 15%">
                                <option selected value="0">Sortiraj</option>
                                <option value="1">Po ceni rastuće</option>
                                <option value="2">Po ceni opadajuće</option>
                                <option value="3">Po kvadraturi rastuće</option>
                                <option value="4">Po kvadraturi opadajuće</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" value="Filtriraj" class="btn btn-outline-dark" style="margin-left: 35%;" disabled>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
                <!--ovde ide prikaz oglasa + search-->
                <div class="row" style="padding-left: 20%; padding-right: 20%; margin-top: 10px;">
                <form>
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <input type="submit" class="btn btn-outline-dark" value="Pretraga" disabled>
                    </div>
                    <br>
                </form>
                </div>
                <hr>
                <h4 style="margin-left: 7%;">Vaši omiljeni oglasi</h4>
                <br>
                <?php
                if(sizeof($nekretnine)==0){
                    echo "
                            <div class=\"alert alert-light text-center\" style=\"padding-top: 5px; padding-bottom: 5px;\" id=\"prazno\">
                                <p>Nemate ni jedan favorit!</p>
                            </div>
                        ";
                }
                ?>
                <div class="row" id="oglasi">
                    <?php
                    $cntRow = 0;
                    for ($i = 0; $i < sizeof($nekretnine); $i++) {
                        $nekretnina = $nekretnine[$i];
                        $slika = $slike[$i];
                        $base64Data = base64_encode($slika->slika);
                        $dataURL = 'data:image/jpeg;base64,' . $base64Data;

                        if ($cntRow % 4 == 0) {
                            echo "<div class=\"row\" style=\"margin-top: 20px; padding-left: 20px; padding-right: 20px;\">";
                        }
                        //TODO linija 191 - proveriti id srca i videti zasto se ne menja na klik
                        echo "
        <div class=\"col-sm-3\" style=\"padding-left: 0px; padding-right: 0px;\">
            <div class=\"card\" style=\"width: 100%; height: 400px;\">
                
                <img src=\"$dataURL\" class=\"card-img-top\" alt=\"Slika stana\" height=\"200px\">
                <div>
                    <img class=\"srce\" src=\"".base_url("images/srceFull.png")."\" height=\"30px\" width=\"40px\" style=\"margin-left: 83%; margin-top: 5%; margin-bottom: 2%;\" id=\"$nekretnina->idNekretnina\">
                </div>
                <a href=\"".base_url("Login/prikazOglasa")."/".$nekretnina->idNekretnina."\">
                <div class=\"card-body text-center\" style=\"padding-top: 2%;\">
                    <p class=\"card-text\"> $nekretnina->opis </p>
                    <h6 style=\"margin-left: 2px; margin-bottom: 2px; display: inline;\">$nekretnina->kvadratura m2</h6>
                    <h6 style=\"margin-left: 32%; margin-bottom: 2px; display: inline;\">$nekretnina->cena €</h6>
                </div>
                </a>
            </div>
        </div>";

                        $cntRow++;

                        if ($cntRow % 4 == 0 || $i == sizeof($nekretnine) - 1) {
                            echo "</div>";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="row header1" style="padding-top: 16px; margin-top: 6px; margin-bottom: 0px; height: max-content;">
            <footer class="text-center" >
                <p>Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina</p>
            </footer>
        </div>
    </div>
</body>
</html>


<!--
<img src=\"".base_url("images/stan2.jpg")."\" class=\"card-img-top\" alt=\"Slika stana\" height=\"200px\">
-->