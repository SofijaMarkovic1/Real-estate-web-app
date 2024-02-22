<?php

use App\Controllers\Guest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\UserAgent;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\GuestSeeder;
use Tests\Support\DbTestCase;
use CodeIgniter\Test\ControllerTester;

class GuestTest extends DbTestCase
{
    use ControllerTester;
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\GuestSeeder';

    public function testIndex()
    {
        $results = $this->controller('\App\Controllers\Guest')->execute('index');
        $this->assertTrue($results->see("Projaktni zadatak na predmetu Principi softverskog inženjerstva, 2023. godina"));
    }

    public function testLogin()
    {
        $results = $this->controller('\App\Controllers\Guest')->execute('login');
        $this->assertTrue($results->see("Dobrošli nazad! Prijavite se i nađite svoju nekretninu iz snova:"));
    }

    public function testRegistracija()
    {
        $results = $this->controller('\App\Controllers\Guest')->execute('registracija');
        $this->assertTrue($results->see('Dobrošli! Registrujte se i nađite svoju nekretninu iz snova:'));
        $this->assertTrue($results->see('Imate nalog?'));
    }

    public function testRegistrujSeCorrect()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123'
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = $params['korime'];
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->dontSee('The email field is required.'));
        $this->assertTrue($results->dontSee('The telefon field is required.'));
        $this->assertTrue($results->dontSee('The imeprezime field is required.'));
        $this->assertTrue($results->dontSee('The korime field is required.'));
        $this->assertTrue($results->dontSee('The lozinka field is required.'));
        $this->assertTrue($results->dontSee('The ponovolozinka field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongEmail()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = '';
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = $params['korime'];
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');
        $this->assertTrue($results->see('The email field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongKorime()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = '';
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('The korime field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongImePrezime()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = '';
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = '';
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('The imeprezime field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongTelefon()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = '';
        $_REQUEST['korime'] = '';
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('The telefon field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongLozinka()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = '';
        $_REQUEST['lozinka'] = '';
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('The lozinka field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongPonovoLozinka1()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka123',
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = '';
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = '';

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('The korime field is required.'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

    public function testRegistrujSeWrongPonovoLozinka2()
    {
        $params = [
            'imeprezime' => "Pera Perkovic",
            'email' => "peraperkovic@gmail.com",
            'telefon' => '0696668889',
            'korime' => 'peracarperkovic',
            'lozinka' => 'lozinka123',
            'ponovolozinka' => 'lozinka1234'
        ];

        $_REQUEST['imeprezime'] = $params['imeprezime'];
        $_REQUEST['email'] = $params['email'];
        $_REQUEST['telefon'] = $params['telefon'];
        $_REQUEST['korime'] = $params['korime'];
        $_REQUEST['lozinka'] = $params['lozinka'];
        $_REQUEST['ponovolozinka'] = $params['ponovolozinka'];

        $results = $this->controller('\App\Controllers\Guest')->execute('registrujSe');

        $this->assertTrue($results->see('Lozinke se ne podudaraju'));

        unset($_REQUEST['imeprezime']);
        unset($_REQUEST['email']);
        unset($_REQUEST['telefon']);
        unset($_REQUEST['korime']);
        unset($_REQUEST['lozinka']);
        unset($_REQUEST['ponovolozinka']);
    }

}

