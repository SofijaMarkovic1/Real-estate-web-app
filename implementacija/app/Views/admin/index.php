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
    <script src="<?php echo base_url('js/pocetna.js'); ?>"></script>
</head>
<body>
<div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">
    <header>
        <div class="row header1">
            <nav class="navbar navbar-expand-lg navbar-light " style="padding-top: 0%; padding-bottom: 0%;">
                <div class="col-sm-1 col-1"><a class="navbar-brand" href="<?= site_url("Admin/index"); ?>"><img src="<?php echo base_url('images/Radostan-logo.png'); ?>" height="110px" style="padding-left: 15%;"></a></div>
                <div class="col-sm-8 col-8">
                    <div class="row">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                </div>
                <div class="col-sm-3 col-3" style="padding-top: 0%; padding-bottom: 0%;">
                    <div class="row" style="height: 50%;">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav" style="padding: 0%;"> <!-- Add ml-auto class here -->
                                <li class="nav-item meni-item" style="margin-left: 350px; margin-top: 45px;">
                                    <img src="<?php echo base_url('images/user.png'); ?>" width="20px" style="display: inline;"> <a href="<?= site_url("Login/odjaviSe") ?>" class="nav-link"  style="display: inline;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Odjavi se</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row" style="height: 50px;"></div>
                </div>
            </nav>
        </div>
    </header>

    <div class="row">
        <div class="row zahteviZaRegistraciju">
                <?php
                    if(sizeof($zahtevi) == 0){
                        echo "
                            <div class=\"alert alert-light text-center\" style=\"padding-top: 5px; padding-bottom: 5px;\" id=\"prazno\">
                                <p>Nema novih zahteva!</p>
                            </div>
                        ";
                    }
                    else{
                        echo "
                        <table class=\"table text-center\">
                            <tr>
                                <td>
                                    Korisničko ime
                                </td>
                                <td>
                                    E-mail
                                </td>
                                <td>
                                    Ime i prezime
                                </td>
                                <td>
                                    Broj telefona
                                </td>
                                <td>
                                    Opcije
                                </td>
                            </tr>
                        ";
                        foreach ($zahtevi as $zahtev){
                            echo"
                                <tr>
                                    <td>
                                        $zahtev->username
                                    </td>
                                    <td>
                                        $zahtev->email
                                    </td>
                                    <td>
                                        $zahtev->ime_prezime
                                    </td>
                                    <td>
                                        $zahtev->telefon
                                    </td>
                                    <td>
                                        <a style=\"color:black; text-decoration: none\" href=\"".base_url("Admin/odobri?zahtev=$zahtev->idZahtev")."\">    
                                            <button class=\"btn btn-outline-dark\" >  
                                            <style>
                                                a:hover {
                                                    color: white !important;
                                                }
                                            </style>
                                                Odobri 
                                            </button>
                                        </a>
                                        <a style=\"color:black; text-decoration: none\" href=\"".base_url("Admin/odbij?zahtev=$zahtev->idZahtev")."\">    
                                            <button class=\"btn btn-outline-dark\" >  
                                            <style>
                                                a:hover {
                                                    color: white !important;
                                                }
                                            </style>
                                                Odbij 
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                ";
                        }
                        echo "</table>";
                    }
                ?>
        </div>
    </div>
    <div class="row header1 fixed-bottom" style="padding-top: 16px; margin-top: 6px; margin-bottom: 0px; height: max-content;">
        <footer class="text-center">
            <p>Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina</p>
        </footer>
    </div>
</div>
</body>
</html>