<?php
$user = $_SESSION["user"];
?>


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
    <script src="<?php echo base_url('js/mojProfil.js'); ?>"></script>
</head>
<body>
    <div class="container-fluid" style="padding-left: 0%; padding-right: 0%;">

        
        <div class="row pozadina" >
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="podaci" style="padding-right: 0px; background-color: white; font-size: 20px; height: 770px;">
                <h3 class="text-center">Korisnički podaci:</h3>
                <br>
                <hr>
                <h5 style="display: inline;">Korisničko ime: </h5> <?php echo $user->username; ?> <br> <br>
                <h5 style="display: inline;">Ime i prezime: </h5> <?php echo $user->ime_prezime; ?> <br> <br>
                <h5 style="display: inline;">E-mail adresa: </h5> <?php echo $user->email; ?> <br> <br>
                <h5 style="display: inline;">Broj telefona: </h5> <?php echo $user->telefon; ?> <br> <br>
                <button class="btn btn-outline-dark" style="margin-left: 25%; margin-top: 40px; display: inline;" id="izmeni">Izmeni podatke</button>
                <button class="btn btn-outline-dark" style="margin-left: 5%; margin-top: 40px;" id="odjavi">Odjavi se</button>
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