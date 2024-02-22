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
            <div class="col-sm-4" id="podaci" style="background-color: white; font-size: 20px; height: 770px;">
                <h3 class="text-center">Korisnički podaci:</h3>
                    <br>
                    <hr>
                <span style="color: red"><?php if(isset($errorMsg)) echo $errorMsg; ?></span>
                <span style="color: green"><?php if(isset($succMsg)) echo $succMsg; ?></span>
                <?php echo form_open("Login/izmeniPodatkePotvrda",  ["method" => "POST"]); ?>
                <div style="margin-left: 10%;">
                    <table>
                        <tr>
                            <td>
                                <h5 style="display: inline;">Korisničko ime: </h5>
                            </td>
                            <td>
                                <input type="text" placeholder="novo korisnicko ime..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="korime">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 style="display: inline;">E-mail adresa: </h5>
                            </td>
                            <td>
                                <input type="text" placeholder="nova e-mail adresa..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="email">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 style="display: inline;">Broj telefona: </h5>
                            </td>
                            <td>
                                <input type="text" placeholder="novi broj telefona..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="telefon">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 style="display: inline;">Lozinka: </h5>
                            </td>
                            <td>
                                <input type="password" placeholder="nova lozinka..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="lozinka">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 style="display: inline;">Ponovljena lozinka: </h5>
                            </td>
                            <td>
                                <input type="password" placeholder="ponovljena lozinka..." style="height: 25px; font-size: 18px; margin-left: 20%;" name="ponovolozinka">
                            </td>
                        </tr>
                    </table>
                     
                    
                    <button class="btn btn-outline-dark" style="margin-left: 25%; margin-top: 40px; display: inline;" id="potvrdi">Potvrdi</button>
                    <button class="btn btn-outline-dark" style="margin-left: 5%; margin-top: 40px;" id="odustani" name="odustaniButton">Odustani</button>
                </div>
                </form>
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