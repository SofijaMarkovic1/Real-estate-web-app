<?php


namespace App\Models;

use App\Models\ImaOpremaModel;
use Tests\Support\DbTestCase;

class ImaOpremaModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\ImaOpremaSeeder';

    public function testImaOpreme()
    {
        $model = new ImaOpremaModel();
        $opreme = [1, 2, 3];
        $result = $model->imaOpreme($opreme);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

    }

    public function testDohvatiSveZaNekretninu()
    {
        $model = new ImaOpremaModel();

        $idNekretnina = 1;

        $result = $model->dohvatiSveZaNekretninu($idNekretnina);
        $this->assertIsArray($result);

    }
}

