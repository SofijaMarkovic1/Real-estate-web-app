<?php
namespace App\Models;

use App\Models\KorisnikModel;
use Tests\Support\DbTestCase;

class KorisnikModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\KorisnikSeeder';

    public function testModelFindAll()
    {

        $expectedCount = 3;
        $model = new KorisnikModel();

        $objects = $model->findAll();

        $this->assertCount($expectedCount, $objects);
    }

    public function testModelFindById()
    {
        $model = new KorisnikModel();

        $user = $model->find(1);

        $this->assertEquals('Luka Lukić', $user->ime_prezime);
        $this->assertEquals('luka.lukic1@example.com', $user->email);
        $this->assertEquals('lukal1', $user->username);
        $this->assertEquals('lozinka6', $user->password);
        $this->assertEquals('06412345091', $user->telefon);
        $this->assertEquals(0, $user->isAdmin);
    }

    public function testModelFindByEmail()
    {
        $model = new KorisnikModel();

        $user = $model->findByEmail('jelena.jelic1@example.com');

        $this->assertEquals(2, $user->idKorisnik);
        $this->assertEquals('Jelena Jelić', $user->ime_prezime);
        $this->assertEquals('jelena.jelic1@example.com', $user->email);
        $this->assertEquals('jelenajj1', $user->username);
        $this->assertEquals('lozinka71', $user->password);
        $this->assertEquals('06398745121', $user->telefon);
        $this->assertEquals(0, $user->isAdmin);
    }

    public function testModelFindByUsername()
    {
        $model = new KorisnikModel();

        $user = $model->findByUsername('nikolann1');

        $this->assertEquals(3, $user->idKorisnik);
        $this->assertEquals('Nikola Nikolić', $user->ime_prezime);
        $this->assertEquals('nikola.nikolicc1@example.com', $user->email);
        $this->assertEquals('nikolann1', $user->username);
        $this->assertEquals('lozinka81', $user->password);
        $this->assertEquals('06212345981', $user->telefon);
        $this->assertEquals(0, $user->isAdmin);
    }

    public function testModelFindByPhoneNumber()
    {
        $model = new KorisnikModel();

        $user = $model->findByPhoneNumber('06412345091');

        $this->assertEquals(1, $user->idKorisnik);
        $this->assertEquals('Luka Lukić', $user->ime_prezime);
        $this->assertEquals('luka.lukic1@example.com', $user->email);
        $this->assertEquals('lukal1', $user->username);
        $this->assertEquals('lozinka6', $user->password);
        $this->assertEquals('06412345091', $user->telefon);
        $this->assertEquals(0, $user->isAdmin);
    }



}