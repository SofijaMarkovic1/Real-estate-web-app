<?php


namespace App\Models;

use Tests\Support\DbTestCase;

class OpremaModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\OpremaSeeder';

    public function testModelFindAll()
    {
        $expectedCount = 3;
        $model = new OpremaModel();

        $objects = $model->findAll();

        $this->assertCount($expectedCount, $objects);
    }

    public function testModelFindById()
    {
        $model = new OpremaModel();

        $oprema = $model->find(1);

        $this->assertEquals('Klima uređaj', $oprema->naziv);
    }



    public function testModelInsert()
    {
        $model = new OpremaModel();

        $data = [
            'naziv' => 'Internet',
        ];

        $result = $model->insert($data, false);

        $this->assertTrue($result);

        $this->seeInDatabase('oprema', $data);
    }
}
