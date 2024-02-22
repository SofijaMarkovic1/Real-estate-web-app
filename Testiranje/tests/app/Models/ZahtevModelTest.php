<?php


namespace App\Models;

use App\Models\ZahtevModel;
use Tests\Support\DbTestCase;

class ZahtevModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\ZahtevSeeder';

    public function testModelFindAll()
    {
        $expectedCount = 2;
        $model = new ZahtevModel();

        $objects = $model->findAll();

        $this->assertCount($expectedCount, $objects);
    }

    public function testModelFindById()
    {
        $model = new ZahtevModel();

        $zahtev= $model->find(1);

        $this->assertEquals('peraperic@example.com', $zahtev->email);
    }


}
