<html>
<header>
            <div class="row header1">
                <nav class="navbar navbar-expand-lg navbar-light " style="padding-top: 0%; padding-bottom: 0%;">
                <div class="col-sm-1 col-1"><a class="navbar-brand" href="<?php echo base_url("Guest/index"); ?>"><img src="<?php echo base_url('images/Radostan-logo.png'); ?>" height="110px" style="padding-left: 15%;"></a></div>
                <div class="col-sm-8 col-8">
                    <div class="row">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="collapse navbar-collapse" style="padding-left: 50%;">
                            <ul class="navbar-nav" style="padding-top: 7%;"> <!-- Add ml-auto class here -->
                                <li class="nav-item mojNav" style="padding: 6px;">
                                    <a class="nav-link" href="<?php echo base_url('Guest/index'); ?>" style="display: inline;">POČETNA</a>
                                    
                                </li>
                                <li class="nav-item mojNav" style="padding: 6px;">
                                    <a class="nav-link" href="<?php echo base_url('Guest/pretragaGost'); ?>" style="display: inline;">PRETRAGA</a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3 col-3" style="padding-top: 0%; padding-bottom: 0%;">
                    <div class="row" style="height: 50%;">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav" style="padding: 0%;"> <!-- Add ml-auto class here -->
                                <li class="nav-item meni-item" style="padding: 6px;">
                                    <img src="<?php echo base_url('images/srce.png'); ?>" width="30px" style="display: inline;"> <a class="nav-link disabled" href="<?php echo base_url(''); ?>" style="display: inline;">Moji favoriti</a>
                                    
                                </li>
                                <li class="nav-item meni-item" style="padding: 6px;">
                                    <div class="dropdown">
                                        <img src="<?php echo base_url('images/user.png'); ?>" width="20px" style="display: inline;"> <a href="<?php echo base_url('Login/login'); // TODO ovde treba moj profil ali ako nije registrovan da ga prebaci na login?>" class="nav-link dropdown-toggle"  style="display: inline;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Moj profil</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="menuD">
                                          <li><a class="dropdown-item" href="<?php echo base_url('Login/login'); ?>">Prijavi se</a></li>
                                          <li><a class="dropdown-item" href="<?php echo base_url('Guest/registracija'); ?>">Registruj se</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item meni-item" style="padding-top: 6px; padding-left: 0px;">
                                    <img src="<?php echo base_url('images/phone.png'); ?>" width="20px" style="display: inline;"> <a class="nav-link" href="#" style="display: inline;">+381 65 266-8603</a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row" style="height: 50px;"></div>
                    
                </div>
                </nav>
            </div>
        </header>