<?php


namespace App\Models;

use App\Models\ImaOpremaModel;
use Tests\Support\DbTestCase;

class JeOmiljeniModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\JeOmiljeniSeeder';

    public function testDohvatiSveZaNekretninu()
    {
        $model = new JeOmiljeniModel();
        $idNekretnina = 1;
        $result = $model->dohvatiSveZaNekretninu($idNekretnina);
        $this->assertIsArray($result);
    }


}