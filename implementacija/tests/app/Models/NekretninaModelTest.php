<?php

namespace App\Models;

use CodeIgniter\Model;
use Tests\Support\Database\Seeds\OpremaSeeder;
use Tests\Support\DbTestCase;

class NekretninaModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\NekretninaSeeder';

    public function testModelFindAll()
    {
        $expectedCount = 3;
        $model = new NekretninaModel();

        $objects = $model->findAll();

        $this->assertCount($expectedCount, $objects);
    }

    public function testModelFindById()
    {
        $model = new NekretninaModel();

        $nekretnina = $model->find(1);

        // Check if the nekretnina is found and the properties match
        $this->assertEquals(1, $nekretnina->idNekretnina);
        $this->assertEquals(1, $nekretnina->idTip);
        $this->assertEquals(1, $nekretnina->idStanja);
        $this->assertEquals(100, $nekretnina->kvadratura);
        $this->assertEquals('Srbija', $nekretnina->drzava);
        $this->assertEquals('Beograd', $nekretnina->grad);
        $this->assertEquals('Novi Beograd', $nekretnina->opstina);
        $this->assertEquals('Bulevar Mihajla Pupina 10', $nekretnina->adresa);
        $this->assertEquals(1, $nekretnina->idGrejanja);
        $this->assertEquals('Prostran stan u centru grada', $nekretnina->opis);
        $this->assertEquals(3, $nekretnina->broj_soba);
        $this->assertEquals(150000, $nekretnina->cena);
    }

    public function testModelFindByDescription()
    {
        $model = new NekretninaModel();

        $searchTerm = 'prostran';
        $nekretnine = $model->findByDesc($searchTerm);

        $this->assertIsArray($nekretnine);
        $this->assertNotEmpty($nekretnine);

        $nekretnina = $nekretnine[0];
        $this->assertEquals(1, $nekretnina->idNekretnina);
        $this->assertEquals(1, $nekretnina->idTip);
        $this->assertEquals(1, $nekretnina->idStanja);
        $this->assertEquals(100, $nekretnina->kvadratura);
        $this->assertEquals('Srbija', $nekretnina->drzava);
        $this->assertEquals('Beograd', $nekretnina->grad);
        $this->assertEquals('Novi Beograd', $nekretnina->opstina);
        $this->assertEquals('Bulevar Mihajla Pupina 10', $nekretnina->adresa);
        $this->assertEquals(1, $nekretnina->idGrejanja);
        $this->assertEquals('Prostran stan u centru grada', $nekretnina->opis);
        $this->assertEquals(3, $nekretnina->broj_soba);
        $this->assertEquals(150000, $nekretnina->cena);
    }

    public function testModelDohvatiSveZaNekretninu()
    {
        $model = new NekretninaModel();

        $idNekretnine = 2;
        $nekretnine = $model->dohvatiSveZaNekretninu($idNekretnine);

        $this->assertIsArray($nekretnine);
        $this->assertNotEmpty($nekretnine);

        $nekretnina = $nekretnine[0];
        $this->assertEquals(2, $nekretnina->idNekretnina);
        $this->assertEquals(2, $nekretnina->idTip);
        $this->assertEquals(1, $nekretnina->idStanja);
        $this->assertEquals(80, $nekretnina->kvadratura);
        $this->assertEquals('Srbija', $nekretnina->drzava);
        $this->assertEquals('Novi Sad', $nekretnina->grad);
        $this->assertEquals('Grbavica', $nekretnina->opstina);
        $this->assertEquals('Bulevar Oslobodjenja 20', $nekretnina->adresa);
        $this->assertEquals(2, $nekretnina->idGrejanja);
        $this->assertEquals('Lepo sredjen stan u mirnom kraju', $nekretnina->opis);
        $this->assertEquals(2, $nekretnina->broj_soba);
        $this->assertEquals(120000, $nekretnina->cena);
    }


}
