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
    <script src="<?php echo base_url('js/prikazOglasa.js'); ?>"></script>
</head>
<body>
<div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">
    <div class="row" style="overflow: auto;">
        <div class="col-sm-3 filters">
            <!--ovde ide bar sa filterima-->
            <form method="POST" action="/Login/pretraga">
                <label for="customRange1" class="form-label">Minimalna cena: </label> <label id="minCenaLabela"></label>
                <input type="range" class="form-range custom-range" id="minCena" min="0" max="<?php if(isset($maxRangeCena)) echo $maxRangeCena; ?>" step="10000" value="0">
                <input type="hidden" id="minCenaHidden" name="minCenaHidden" value="<?php if(isset($minRangeCena)) echo $minRangeCena; ?>">

                <label for="customRange1" class="form-label">Maksimalna cena:</label> <label id="maxCenaLabela"></label>
                <input type="range" class="form-range custom-range" id="maxCena" min="0" max="<?php if(isset($maxRangeCena)) echo $maxRangeCena; ?>" step="10000" value="<?php if(isset($maxRangeCena)) echo $maxRangeCena; ?>">
                <input type="hidden" id="maxCenaHidden" name="maxCenaHidden" value="<?php if(isset($maxRangeCena)) echo $maxRangeCena ?>">

                <label for="customRange1" class="form-label">Minimalna kvadratura: </label> <label id="minKvadraturaLabela"></label>
                <input type="range" class="form-range custom-range" id="minKvadratura" min="0" max="<?php if(isset($minRangeKvadratura)) echo $minRangeKvadratura;  ?>" step="10" value="0">
                <input type="hidden" id="minKvHidden" name="minKvHidden" value="<?php if(isset($minRangeKvadratura)) echo $minRangeKvadratura; ?>">

                <label for="customRange1" class="form-label">Maksimalna kvadratura:</label> <label id="maxKvadraturaLabela"></label>
                <input type="range" class="form-range custom-range" id="maxKvadratura" min="0" max="<?php if(isset($maxRangeKvadratura)) echo $maxRangeKvadratura; ?>"" step="10" value="<?php if(isset($maxRangeKvadratura)) echo $maxRangeKvadratura; ?>">
                <input type="hidden" id="maxKvHidden" name="maxKvHidden" value="<?php if(isset($maxRangeKvadratura)) echo $maxRangeKvadratura; ?>">

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
                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"opreme[]\" value='oprema$i' > $oprema->naziv<br>
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
                            <option value="3">Po kvadraturi opadajuće</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input disabled type="submit" value="Filtriraj" class="btn btn-outline-dark" style="margin-left: 35%;">
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
                    <select class="form-select" id="selectBar">
                        <option selected>Sortiraj</option>
                        <option value="1">Po ceni rastuće</option>
                        <option value="2">Po ceni opadajuće</option>
                        <option value="3">Po kvadraturi rastuće</option>
                        <option value="4">Po kvadraturi opadajuće</option>
                    </select>
                </form>
            </div>
            <hr>
            <div class="row" id="oglasi">
                <div class="row">
                    <div class="col-sm-8" id="slikeIOpis">
                        <div class="carousel slide" data-ride="carousel" id="oglasSlajder">
                            <div class="carousel-inner">
                                <?php
                                $size = sizeof($slike);
                                echo "<input type=\"hidden\" id=\"brojSlika\" name=\"brojSlika\" value=\"$size\">";

                                for($i = 0; $i < sizeof($slike); $i++){
                                    $slika = $slike[$i];
                                    $base64Data = base64_encode($slika->slika);
                                    $dataURL = 'data:image/jpeg;base64,' . $base64Data;
                                    if($i == 0) {
                                            echo "
                                            <div class=\"carousel-item active\" id=\"$i\">
                                                <img class=\"d-block w-100\" src=\"$dataURL\" alt=\"$i-th slide\" height=\"600px\" width=\"700px\">
                                            </div>
                                            ";
                                    }
                                    else{
                                        echo "
                                            <div class=\"carousel-item\" id=\"$i\">
                                                <img class=\"d-block w-100\" src=\"$dataURL\" alt=\"$i-th slide\" height=\"600px\" width=\"700px\">
                                            </div>
                                        ";
                                    }
                                }
                                ?>
                                <!--
                                <div class="carousel-item active" id="0">
                                    <img class="d-block w-100" src="images/carousel/dnevna.jpg" alt="First slide" height="600px" width="700px">
                                </div>
                                <div class="carousel-item" id="1">
                                    <img class="d-block w-100" src="images/carousel/kuhinja.jpg" alt="Second slide" height="600px" width="700px">
                                </div>
                                <div class="carousel-item" id="2">
                                    <img class="d-block w-100" src="images/carousel/kupatilo.jpg" alt="Third slide" height="600px" width="700px">
                                </div>
                                <div class="carousel-item" id="3">
                                    <img class="d-block w-100" src="images/carousel/spavaca.jpg" alt="Fourth slide" height="600px" width="700px">
                                </div>
                                <div class="carousel-item" id="4">
                                    <img class="d-block w-100" src="images/carousel/balkon.jpg" alt="Fifth slide" height="600px" width="700px">
                                </div>
                                -->
                            </div>
                            <a class="carousel-control-prev" role="button" data-slide="prev" id="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" role="button" data-slide="next" id="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <br>
                        <div class="row" id="opis" style="margin-left: 10px;">
                            <?php
                                echo "<p> $nekretnina->opis";
                            ?>
                            <!--
                            <p>Na Vračaru se nalazi ovaj prostrani i moderno uređeni stan koji će vas oduševiti svojom elegancijom i udobnošću. Smešten na mirnoj i drvoredima okruženoj ulici, ovaj stan je idealan za one koji žele živeti u mirnom i prestižnom delu grada.

                                Stan se prostire na 125 kvadratnih metara i sastoji se od prostranog dnevnog boravka koji je osmišljen kao otvoreni koncept s modernom kuhinjom. Svetle boje i veliki prozori doprinose osećaju prozračnosti i obilju prirodnog svetla.

                                Kuhinja je opremljena najnovijim aparatima i modernim elementima, pružajući Vam izvanredno iskustvo kuvanja. Uz to, stan ima i dodatni prostor za spremanje, idealno za odlaganje kućnih aparata i posuđa.

                                Spavaće sobe su prostrane i udobne, s dovoljno mesta za ugradne ormare i ostale komade nameštaja. Glavna spavaća soba ima vlastito privatno kupatilo koje je opremljeno luksuznim detaljima, kao što su moderni tuševi i elegantna keramika.

                                Stan takođe ima dodatno kupatilo koje je lepo uređeno i opremljeno kvalitetnim sanitarnim uređajima. Tu je i dodatni prostor koji se može koristiti kao radna soba ili prostor za rekreaciju prema Vašim potrebama.

                                Uživajte u sunčanim danima na prostranoj terasi s pogledom na zelenilo i okolne vrtove. Ovo je idealno mesto za opuštanje, druženje s prijateljima ili uživanje u šoljici kafe dok uživate u mirnom ambijentu.

                                Stan se nalazi u blizini svih potrebnih sadržaja kao što su prodavnice, restorani, škole i parkovi. Dodatno, dobro je povezan s javnim prevozom, što Vam omogućava jednostavan pristup drugim delovima grada.

                                Ovaj prekrasan stan na Vračaru pružiće Vam savršen spoj udobnosti, luksuza i praktičnosti. Ne propustite priliku da postanete vlasnik ove nekretnine i uživate u vrhunskom životnom iskustvu na jednoj od najprestižnijih lokacija u gradu.</p>
                            -->
                        </div>
                    </div>
                    <div class="col-sm-4" id="info">
                        <table class="table table-bordered text-center" style="margin-top: 20px;">
                            <tr>
                                <td colspan="2"><b>Osnovne informacije</b></td>
                            </tr>
                            <tr>
                                <td>Tip nekretnine</td>
                                <td><?php echo $nazivTipa;?></td>
                            </tr>
                            <tr>
                                <td>Kvadratura</td>
                                <td><?php echo $nekretnina->kvadratura;?> m2</td>
                            </tr>
                            <tr>
                                <td>Broj soba</td>
                                <td><?php echo $nekretnina->broj_soba;?></td>
                            </tr>
                            <tr>
                                <td>Grejanje</td>
                                <td><?php echo $nazivGrejanja;?></td>
                            </tr>
                            <tr>
                                <td>Stanje</td>
                                <td><?php echo $nazivStanja;?></td>
                            </tr>
                            <tr>
                                <td>Adresa</td>
                                <td><?php echo $nekretnina->adresa;?></td>
                            </tr>
                            <tr>
                                <td>Opština</td>
                                <td><?php echo $nekretnina->opstina;?></td>
                            </tr>
                            <tr>
                                <td>Cena</td>
                                <td><?php echo $nekretnina->cena;?>€</td>
                            </tr>

                        </table>

                        <table class="table table-bordered text-center" style="margin-top: 40px;">
                            <tr>
                                <td colspan="2"><b>Opremljenost</b></td>
                            </tr>
                            <?php
                                foreach($opreme as $o){
                                    if(in_array($o, $opremaNekretnine)){
                                        echo"
                                            <tr>
                                                <td>$o->naziv</td>
                                                <td>da</td>
                                            </tr>
                                        ";
                                    }
                                    else{
                                        echo"
                                            <tr>
                                                <td>$o->naziv</td>
                                                <td>ne</td>
                                            </tr>
                                        ";
                                    }
                            }
                            ?>
                            <!--
                            <tr>
                                <td colspan="2"><b>Opremljenost</b></td>
                            </tr>
                            <tr>
                                <td>Terasa</td>
                                <td>da</td>
                            </tr>
                            <tr>
                                <td>Garaža</td>
                                <td>da</td>
                            </tr>
                            <tr>
                                <td>Bazen</td>
                                <td>ne</td>
                            </tr>
                            <tr>
                                <td>Lift</td>
                                <td>da</td>
                            </tr>
                            <tr>
                                <td>Parking</td>
                                <td>da</td>
                            </tr>
                            <tr>
                                <td>Recepcija</td>
                                <td>ne</td>
                            </tr>
                            <tr>
                                <td>Dvorište</td>
                                <td>ne</td>
                            </tr>
                            -->
                        </table>
                        <table class="table table-bordered text-center" style="margin-top: 20px;">
                            <tr>
                                <td colspan="2"><b>Prodavac nekretnine</b></td>
                            </tr>
                            <tr>
                                <td>Ime i Prezime</td>
                                <td><?php echo $prodavac->ime_prezime;?></td>
                            </tr>
                            <tr>
                                <td>Broj telefona</td>
                                <td><?php echo $prodavac->telefon;?></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><?php echo $prodavac->email;?></td>
                            </tr>
                        </table>
                        <br><br>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="row header1" style="padding-top: 16px; margin-top: 6px; margin-bottom: 0px; height: max-content;" >
        <!--<footer class="text-center" > -->
        <p class="text-center">Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina</p>

    </footer>
</div>
</body>
</html>
