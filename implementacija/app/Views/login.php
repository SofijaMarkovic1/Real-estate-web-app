
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
<body style="background-color: #F2EBE0;">
    <div class="session" style="width:40%; margin-top: 14%;">
        <div class="left" style="background-color: #cf9b7d;">
            <img alt="logo" src="<?php echo base_url('images/Radostan-logo.png'); ?>" width="100%" style="margin-top: 50%;">            
        </div>
        <?php echo form_open("Login/login_check", array("class" => "log-in", "autocomplete" => "off")); // TO DO dodati akciju?>
          <h4>Mi smo <span>radoSTAN</span></h4>
          <p>Dobrošli nazad! Prijavite se i nađite svoju nekretninu iz snova:</p>
            <span id="registracijaGreska" style="color: red"><?php echo $errorMsg; ?></span>
          <div class="floating-label">
            <input placeholder="Korisnicko ime..." type="text" name="korime" id="korime" autocomplete="off">            
          </div>
          <div class="floating-label">
            <input placeholder="Lozinka..." type="password" name="lozinka" id="lozinka" autocomplete="off">            
          </div>
          <!--<button type="submit" onClick="return false;">Log in</button>-->
          <button class="btn btn-outline-dark" style="margin-left: 50%; margin-top: 40px; display: inline;" id="prijaviSe">Prijavite se</button>
          <br> <p>Nemate nalog? <a href="<?php echo base_url('Login/signup'); ?>">Registrujte se</a> </p>
          <p>Ne želite nalog? <a href="<?php echo base_url('Guest/index'); ?>">Nastavite kao gost</a> </p>
      </div>
</body>
</html>