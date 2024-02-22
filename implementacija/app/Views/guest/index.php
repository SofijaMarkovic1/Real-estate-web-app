<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>radoSTAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <link href="<?php echo base_url('css/helper.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('js/jquery-3.7.0.js'); ?>"></script>
    <script src="<?php echo base_url('js/pocetna.js'); ?>"></script>
</head>
<body>
    <div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">        
        <div class="row">
            <div class="col-12">
                <div class="carousel-inner" style="width: 100%; padding: 0%;" id="carousel">
                    <div class="carousel-item active" id="1">
                      <img class="d-block w-100" style="height: 770px;" src="<?php echo base_url('images/image1.jpg'); ?>" alt="Image 1" >
                    </div>
                    <div class="carousel-item" id="2">
                      <img class="d-block w-100" src="<?php echo base_url('images/image2.jpg'); ?>" style="height: 770px;" alt="Image 2" >
                    </div>
                    <div class="carousel-item" id="3">
                      <img class="d-block w-100" src="<?php echo base_url('images/image3.jpg'); ?>" style="height: 770px;" alt="Image 3">
                    </div>
                </div>
                  
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev" id="prev" style="width: 10%; height: 50%; margin-top: 15%;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next" id="next"  style="width: 10%; height: 50%; margin-top: 15%;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <div id="transparent-window">
                    <h3 style="font-family: 'Times New Roman', Times, serif;">RadoSTAN</h3>
                    <p style="color: black; font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: 500;">
                        RadoSTAN agencija za nekretnine je osnovana 2023. godine sa sedištem u Beogradu. Nakon dugogodišnjeg rada u oblasti nekretnina, inspirisani i motivisani bogatim iskustvom koje seže od 2018. godine, odlučili smo da domaćem tržištu ponudimo stečena znanja i stoprocentno ga usmerimo na one koji žele efikasno da pronađu ili prodaju nekretnine.
                        Sa dugogodišnjim iskustvom i poznavanjem tržita nekretnina u mogućnosti smo da pružimo klijentima kompletan spektar usluga u procesu prodaje i izdavanja stambenih i komercijanih nekretnina.
                        RadoSTAN agencija obezbeđuje usluge ekskluzinog zastupanja klijenata bez obzira da li ste investitor, vlasnik jedne ili više nepokretnosti koju biste da prodate ili izdate ili kupac/zakupac koji je u potrazi za najboljom nekretninom.
                    </p>
                </div>
            </div>
        </div>
        <div class="row header1" style="padding-top: 16px; margin-top: 6px; margin-bottom: 0px; height: max-content;">
            <footer class="text-center">
                <p>Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina</p>
            </footer>
        </div>
    </div>
</body>
</html>