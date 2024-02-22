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
    <div class="session" style="width:40%; margin-top: 8%;">
        <div class="left" style="background-color: #c09175;">
            <img src="<?php echo base_url('images/Radostan-logo.png'); ?>" width="100%" style="margin-top: 100%; margin-left: 4%;">
        </div>
        <?php echo form_open("Guest/registrujSe", array("class" => "log-in", "autocomplete" => "off")); // TO DO dodati akciju?>
          <h4>Mi smo <span>radoSTAN</span></h4>
          <p>Dobrošli! Registrujte se i nađite svoju nekretninu iz snova:</p>
            <span id="registracijaGreska" style="color: red"><?php echo $errorMsg; ?></span>
          <div class="floating-label">
            <input placeholder="Ime i prezime..." type="text" name="imeprezime" id="imeprezime" autocomplete="off" value="<?php if(isset($imeprezime)) echo $imeprezime?>">
          </div>

          <div class="floating-label">
            <input placeholder="E-mail..." type="text" name="email" id="email" autocomplete="off" value="<?php if(isset($email)) echo $email?>">
          </div>

          <div class="floating-label">
            <input placeholder="Broj telefona..." type="text" name="telefon" id="telefon" autocomplete="off" value="<?php if(isset($brojTelefona)) echo $brojTelefona?>">
          </div>

          <div class="floating-label">
            <input placeholder="Korisnicko ime..." type="text" name="korime" id="korime" autocomplete="off" value="<?php if(isset($korIme)) echo $korIme?>">
          </div>
          
          <div class="floating-label">
            <input placeholder="Lozinka..." type="password" name="lozinka" id="lozinka" autocomplete="off">  
          </div>

          <div class="floating-label">
            <input placeholder="Ponovite lozinku..." type="password" name="ponovolozinka" id="ponovolozinka" autocomplete="off">  
          </div>
          
          <!--<button type="submit" onClick="return false;">Log in</button>-->
          <button class="btn btn-outline-dark" style="margin-left: 40%; margin-top: 40px; display: inline;" id="predlogCene">Registrujte se</button>
          <br> <p>Imate nalog? <a href="<?php echo base_url('Login/login'); ?>">Prijavite se</a> </p>
          <p>Ne želite nalog? <a href="<?php echo base_url('Guest/index'); ?>">Nastavite kao gost</a> </p>

        </form>
      </div>
</body>
</html>