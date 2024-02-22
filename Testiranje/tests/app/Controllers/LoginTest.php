<?php

namespace app\Controllers;

use App\Models\JeOmiljeniModel;
use App\Models\NekretninaModel;
use App\Models\ProdajeModel;
use CodeIgniter\Test\ControllerTester;
use PHPUnit\Framework\TestCase;
use Tests\Support\DbTestCase;


class LoginTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    use ControllerTester;

    protected $seed = 'Tests\Support\Database\Seeds\LoginSeeder';

    public function test_login_no_username_no_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "";
        $_REQUEST["lozinka"] = "";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check');

        $this->assertTrue($results->see("Morate uneti sva polja forme."));
        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_username_no_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "lukal";
        $_REQUEST["lozinka"] = "";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Morate uneti sva polja forme."));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_no_username_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "";
        $_REQUEST["lozinka"] = "lozinka6";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Morate uneti sva polja forme."));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_invalid_username_invalid_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "bilosta";
        $_REQUEST["lozinka"] = "bilosta";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Pogrešni kredencijali."));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_invalid_username_valid_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());

        $_REQUEST["korime"] = "bilosta";
        $_REQUEST["lozinka"] = "lozinka6";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Pogrešni kredencijali."));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_valid_username_invalid_password(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "lukal";
        $_REQUEST["lozinka"] = "bilosta";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Pogrešni kredencijali."));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_request_pending(){
        $results = $this->controller("\App\Controllers\Login")->execute("login");

        $this->assertTrue($results->isOK());
        $_REQUEST["korime"] = "pera";
        $_REQUEST["lozinka"] = "peric123";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Vaš zahtev za registracijom je u obradi!"));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_login_successful(){

        if(isset($_SESSION["user"])){
            session_destroy();
        }

        $results = $this->controller("\App\Controllers\Login")->execute("login");
        $this->assertTrue($results->isOK());

        $_REQUEST["korime"] = "lukal";
        $_REQUEST["lozinka"] = "lozinka6";

        $results = $this->controller('\App\Controllers\Login')->execute('login_check'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($results->see("Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina"));

        unset($_REQUEST["korime"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_change_to_old_username(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["korime"] = "lukal";
        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Korisnicko ime je isto"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["korime"]);
    }

    public function test_change_to_taken_username(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["korime"] = "jelenajj";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Korisnicko ime je zauzeto"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["korime"]);
    }

    public function test_change_to_valid_username(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["korime"] = "lukal1";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Korisnicko ime je promenjeno"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["korime"]);
    }

    public function test_change_to_old_email(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["email"] = "email@example.com";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario
        $this->assertTrue($result->see("Email je isti"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["email"]);
    }

    public function test_change_to_taken_email(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["email"] = "jelena.jelic@example.com";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Email je zauzet"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["email"]);
    }

    public function test_change_to_valid_email(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["email"] = "lukal@example.com";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Email je promenjen"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["email"]);
    }

    public function test_change_to_old_number(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["telefon"] = "0657654321";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Broj telefona je isti"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["telefon"]);
    }

    public function test_change_to_taken_number(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["telefon"] = "0639874512";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Broj telefona je zauzet"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["telefon"]);
    }

    public function test_change_to_valid_number(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["telefon"] = "0631234567";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Broj telefona je promenjen"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["telefon"]);
    }

    public function test_change_to_short_password(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["lozinka"] = "abc";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Minimalna duzina lozinke je 6 karaktera"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["lozinka"]);
    }

    public function test_change_to_password_with_wrong_confirmation(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["lozinka"] = "lozinka23";
        $_REQUEST["ponovolozinka"] = "lozinka24";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Lozinke se ne podudaraju"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["lozinka"]);
        unset($_REQUEST["ponovolozinka"]);
    }

    public function test_change_to_valid_password(){
        $_SESSION['user'] = (object)[
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $_REQUEST["lozinka"] = "lozinka23";
        $_REQUEST["ponovolozinka"] = "lozinka23";

        $result = $this->controller('\App\Controllers\Login')->execute('izmeniPodatkePotvrda'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertTrue($result->see("Lozinka je promenjena"));

        unset($_REQUEST["user"]);
        unset($_REQUEST["lozinka"]);
        unset($_REQUEST["ponovolozinka"]);
    }

    public function test_delete_ad(){

        $_SESSION['user'] = (object)[
            'idKorisnik' => 1,
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $nekretnina = 1;

        $_REQUEST["id"] = $nekretnina;

        $result = $this->controller('\App\Controllers\Login')->execute('obrisiNekretninu'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new NekretninaModel();

        $entries = $model->findAll();

        $this->assertCount(1, $entries);

        unset($_REQUEST["user"]);
        unset($_REQUEST["id"]);
    }

    public function test_view_my_ads_when_no_ads(){

        $_SESSION['user'] = (object)[
            'idKorisnik' => 1,
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $result = $this->controller('\App\Controllers\Login')->execute('mojiOglasi'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new ProdajeModel();

        $entries = $model->where("idKorisnik", 1)->findAll();

        if(empty($entries)){
            $this->assertTrue($result->see("Niste još uvek oglasili nijednu nekretninu!"));
        }
        else{
            $this->assertCount(2, $entries);
        }

        unset($_REQUEST["user"]);
    }

    public function test_view_my_ads_when_there_are_ads(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 1,
            'ime_prezime' => 'Luka Lukic',
            'email' => 'email@example.com',
            'username' => 'lukal',
            'password' => 'lozinka6',
            'telefon' => '0657654321',
            'isAdmin' => '0'
        ];

        $result = $this->controller('\App\Controllers\Login')->execute('mojiOglasi'); // Adjust the 'zahtev' parameter according to your scenario

        $this->assertFalse($result->see("Niste još uvek oglasili nijednu nekretninu!"));

        unset($_REQUEST["user"]);
    }

    public function test_add_to_favourites(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];

        $_REQUEST["id"] = 1;

        $result = $this->controller('\App\Controllers\Login')->execute('dodajFavorit'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new JeOmiljeniModel();

        $entries = $model->findAll();

        $this->assertCount(2, $entries);

        unset($_REQUEST["user"]);
        unset($_REQUEST["id"]);
    }

    public function test_delete_from_favourites(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];

        $_REQUEST["id"] = 2;

        $result = $this->controller('\App\Controllers\Login')->execute('ukloniFavorit'); // Adjust the 'zahtev' parameter according to your scenario

        $model = new JeOmiljeniModel();

        $entries = $model->findAll();

        $this->assertCount(0, $entries);

        unset($_REQUEST["user"]);
        unset($_REQUEST["id"]);
    }

    public function test_add_nekretnina_valid(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];
        $params = [
            "nazivoglasa" => "Stan Novi",
            "tip" => "Stan",
            "stanje" => "Novo gradnja",
            "kvadratura" => "55",
            "brojsoba" => "3",
            "drzava" => "Srbija",
            "opstina" => "Zvezdara",
            "grad" => "Beograd",
            "adresa" => "",
            "grejanje" => "centralno",
            "cena" => "50000",
            "opis" => "Novi stan"
        ];

        $imagePath = '/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg';
        $imageContent = file_get_contents('/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg');
        file_put_contents($imagePath, $imageContent);

        $_FILES['images'] = [
            'name' => 'image.jpg',
            'type' => 'image/jpeg',
            'size' => filesize($imagePath),
            'tmp_name' => $imagePath,
            'error' => UPLOAD_ERR_OK
        ];


        foreach ($params as $key => $value) {
            $_REQUEST[$key] = $value;
        }

        $results = $this->controller('\App\Controllers\Login')->execute('oglasiNekretninuPotvrda');
        $this->assertTrue($results->dontSee('The email field is required.'));
        $this->assertTrue($results->dontSee('The telefon field is required.'));
        $this->assertTrue($results->dontSee('The imeprezime field is required.'));
        $this->assertTrue($results->dontSee('The korime field is required.'));
        $this->assertTrue($results->dontSee('The lozinka field is required.'));
        $this->assertTrue($results->dontSee('The ponovolozinka field is required.'));

    }

    public function test_add_nekretnina_invalid_naziv(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];
        $params = [
            "nazivoglasa" => "",
            "tip" => "Stan",
            "stanje" => "Novo gradnja",
            "kvadratura" => "55",
            "brojsoba" => "3",
            "drzava" => "Srbija",
            "opstina" => "Zvezdara",
            "grad" => "Beograd",
            "adresa" => "",
            "grejanje" => "centralno",
            "cena" => "50000",
            "opis" => "Novi stan"
        ];

        $imagePath = '/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg';
        $imageContent = file_get_contents('/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg');
        file_put_contents($imagePath, $imageContent);

        $_FILES['images'] = [
            'name' => 'image.jpg',
            'type' => 'image/jpeg',
            'size' => filesize($imagePath),
            'tmp_name' => $imagePath,
            'error' => UPLOAD_ERR_OK
        ];


        foreach ($params as $key => $value) {
            $_REQUEST[$key] = $value;
        }

        $results = $this->controller('\App\Controllers\Login')->execute('oglasiNekretninuPotvrda');
        $this->assertTrue($results->see('The nazivoglasa field is required.'));


    }

    public function test_add_nekretnina_invalid_grad(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];
        $params = [
            "nazivoglasa" => "Novi Stan",
            "tip" => "Stan",
            "stanje" => "Novo gradnja",
            "kvadratura" => "",
            "brojsoba" => "3",
            "drzava" => "Srbija",
            "opstina" => "Zvezdara",
            "grad" => "Beograd",
            "adresa" => "",
            "grejanje" => "centralno",
            "cena" => "50000",
            "opis" => "Novi stan"
        ];

        $imagePath = '/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg';
        $imageContent = file_get_contents('/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg');
        file_put_contents($imagePath, $imageContent);

        $_FILES['images'] = [
            'name' => 'image.jpg',
            'type' => 'image/jpeg',
            'size' => filesize($imagePath),
            'tmp_name' => $imagePath,
            'error' => UPLOAD_ERR_OK
        ];


        foreach ($params as $key => $value) {
            $_REQUEST[$key] = $value;
        }

        $results = $this->controller('\App\Controllers\Login')->execute('oglasiNekretninuPotvrda');
        $this->assertTrue($results->see('The kvadratura field is required.'));
    }

    public function test_add_nekretnina_invalid_files(){
        $_SESSION['user'] = (object)[
            'idKorisnik' => 2,
            'ime_prezime' => 'Jelena Jelic',
            'email' => 'jelena.jelic@example.com',
            'username' => 'jelenajj',
            'password' => 'lozinka7',
            'telefon' => '0639874512',
            'isAdmin' => '0'
        ];
        $params = [
            "nazivoglasa" => "Novi Stan",
            "tip" => "Stan",
            "stanje" => "Novo gradnja",
            "kvadratura" => "55",
            "brojsoba" => "3",
            "drzava" => "Srbija",
            "opstina" => "Zvezdara",
            "grad" => "Beograd",
            "adresa" => "",
            "grejanje" => "centralno",
            "cena" => "50000",
            "opis" => "Novi stan"
        ];

        $imagePath = '/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg';
        $imageContent = file_get_contents('/opt/lampp/htdocs/my_project/tests/_support/Database/Seeds/image1.jpg');
        file_put_contents($imagePath, $imageContent);

        $_FILES['images'] = [
            'name' => 'image.jpg',
            'type' => 'image/jpeg',
            'size' => filesize($imagePath),
            'tmp_name' => $imagePath,
            'error' => UPLOAD_ERR_INI_SIZE
        ];


        foreach ($params as $key => $value) {
            $_REQUEST[$key] = $value;
        }

        $results = $this->controller('\App\Controllers\Login')->execute('oglasiNekretninuPotvrda');
        $this->assertTrue($results->see('Moras postaviti barem jednu sliku'));
    }



}