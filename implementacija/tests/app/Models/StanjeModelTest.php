<?php

namespace App\Models;

use App\Models\StanjeModel;
use Tests\Support\DbTestCase;

class StanjeModelTest extends DbTestCase
{
    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = 'Tests\Support\Database\Seeds\StanjeSeeder';

    public function testModelFindAll()
    {
        $expectedCount = 3;
        $model = new StanjeModel();

        $objects = $model->findAll();

        $this->assertCount($expectedCount, $objects);
    }

    public function testModelFindById()
    {
        $model = new StanjeModel();

        $state = $model->find(1);

        $this->assertEquals('Novo', $state->naziv);
    }

}

