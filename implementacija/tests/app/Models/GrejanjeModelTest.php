<?php

use App\Models\GrejanjeModel;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use Tests\Support\DbTestCase;

class GrejanjeModelTest extends DbTestCase
{
    use DatabaseTestTrait;
    protected $seed = 'Tests\Support\Database\Seeds\GrejanjeSeeder';

    public function testInsertGrejanje()
    {
        $model = new GrejanjeModel();

        $data = [
            'naziv' => 'Centralno grejanje',
        ];

        $result = $model->insert($data, false);
        $this->assertTrue($result);
        $this->seeInDatabase('grejanje', $data);
    }

    public function testFindGrejanjeById()
    {
        $model = new GrejanjeModel();

        $grejanje = $model->find(1);

        $this->assertNotNull($grejanje);
        $this->assertEquals('Centralno grejanje', $grejanje->naziv);
    }
}
