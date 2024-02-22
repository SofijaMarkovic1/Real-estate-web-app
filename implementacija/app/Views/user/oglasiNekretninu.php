<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>radoSTAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('js/jquery-3.7.0.js'); ?>"></script>
    <script src="<?php echo base_url('js/mojProfil.js'); ?>"></script>
</head>
<body>
<div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">


    <div class="row pozadina">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" id="podaci" style="background-color: white; font-size: 20px; height: 1100px;>
            <h3 class="text-center">Oglasite nekretninu:</h3>
            <hr>
            <span style="color: red; margin-left: 10%;"><?php if(isset($errorMsg)) echo $errorMsg;?></span>
            <?php echo form_open("Login/oglasiNekretninuPotvrda", [ "method" => "POST", "enctype" => "multipart/form-data"]); ?>
            <div style="margin-left: 10%;">
                <table>
                    <tr>
                        <td>
                            <h5 style="display: inline;">Naziv oglasa: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="naziv oglasa..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="nazivoglasa" value="<?php if(isset($naziv)) echo $naziv?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Tip nekretnine: </h5>
                        </td>
                        <td>
                            <select style="height: 25px; font-size: 18px; margin-left: 20%; width: 100%;" name="tip">
                                <?php
                                    foreach($tipovi as $t){
                                        if(isset($tip) && $t==$tip) echo "<option selected>$t->naziv</option>";
                                        else echo "<option>$t->naziv</option>";
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Stanje nekretnine: </h5>
                        </td>
                        <td>
                            <select style="height: 25px; font-size: 18px; margin-left: 20%; width: 100%;" name="stanje">
                                <?php
                                    foreach($stanja as $s){
                                        if(isset($stanje) && $stanje==$s)echo "<option selected>$s->naziv</option>";
                                        else echo "<option>$s->naziv</option>";
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Kvadratura: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="kvadratura u m2..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="kvadratura" value="<?php if(isset($kvadratura)) echo $kvadratura;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Broj soba: </h5>
                        </td>
                        <td>
                            <input type="number" style="height: 25px; font-size: 18px; margin-left: 20%;" name="brojsoba" value="<?php if(isset($brojsoba)) echo $brojsoba;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Drzava: </h5>
                        </td>
                        <td>
                            <select style="height: 25px; font-size: 18px; margin-left: 20%; width: 100%;" name="drzava">
                                <option selected>Srbija</option>
                                <option>Hrvatska</option>
                                <option>Crna Gora</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Grad: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="Unesite grad..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="grad" id="poljeZaGrad" value="<?php if(isset($grad)) echo $grad;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Opština: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="Unesite opštinu..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="opstina" value="<?php if(isset($opstina)) echo $opstina;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Adresa: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="Unesite adresu..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="adresa" value="<?php if(isset($adresa)) echo $adresa; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Grejanje: </h5>
                        </td>
                        <td>
                            <select style="height: 25px; font-size: 18px; margin-left: 20%; width: 100%;" name="grejanje">
                                <?php
                                    foreach ($grejanja as $g){
                                        if(isset($grejanje) && $grejanje==$g) echo "<option selected>$g->naziv</option>";
                                        else echo "<option>$g->naziv</option>";
                                    }
                                ?>
                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 style="display: inline;">Cena: </h5>
                        </td>
                        <td>
                            <input type="text" placeholder="unesite cenu..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="cena" value="<?php if(isset($cena)) echo $cena; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="display: inline;">Predlog cene: </h5>
                        </td>
                        <td>
                            <label id="predlogCenePolje" style="height: 25px; font-size: 18px; margin-left: 20%;"><?php if(isset($predlogCene)) echo $predlogCene;?></label>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="padding-left: 15%; padding-top: 20px;">
                            <textarea placeholder="kratak opis nekretnine..." rows="4" style="width:100%; font-size: 16px;" name="opis"><?php if(isset($opis)) echo $opis; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-left: 15%; padding-top: 20px;">
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 18px;">Slike nekretnine: </td>
                        <td>
                            <input type="file" id="photos" name="images[]" multiple style="margin-left: 20%;"/><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="ime tag-a..." style="height: 25px; font-size: 18px; margin-left: 15%; margin-right: 1%; display: inline; width: 30%;" id="tag" name="nazivtag">
                            <button class="btn btn-outline-dark" style="margin-left: 5%; display: inline; padding: 3px;" id="dodajTag" name="dodajTag">Dodaj tag</button>
                            <button class="btn btn-outline-dark" style="margin-left: 6%; display: inline; padding: 3px;" id="ukloniTag" name="ukloniTag">Ukloni tag</button>
                        </td>
                    </tr>
                </table>
                <label>Dodati tagovi: </label>
                <label id="tagovi">
                    <?php
                    if(isset($tagovi)){
                        foreach ($tagovi as $tag){
                            echo $tag . " ";
                        }
                    }

                    ?>
                </label> <br>
                <button class="btn btn-outline-dark" style="margin-left: 35%; margin-top: 40px; display: inline;" id="potvrdi">Potvrdi</button>

            </div>
            </form>
            <button class="btn btn-outline-dark" style="margin-left: 30%; margin-top: 40px; display: inline;" id="odustani">Odustani</button>
            <button class="btn btn-outline-dark predlogCene" style="margin-left: 5%; margin-top: 40px; display: inline;" id="predlogCene">Predlog cene</button>

        </div>
        <div class="col-sm-4"></div>
    </div>

    <div class="row header1" style="padding-top: 16px; margin-top: 6px; margin-bottom: 0px; height: max-content;">
        <footer class="text-center">
            <p>Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina</p>
        </footer>
    </div>
</div>
</body>
</html>