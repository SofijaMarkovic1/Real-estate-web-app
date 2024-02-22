<?php


    namespace App\Models;

    use App\Models\TipModel;
    use Tests\Support\DbTestCase;

    class TipModelTest extends DbTestCase
    {
        /**
         * The seed file(s) used for all tests within this test case.
         * Should be fully-namespaced or relative to $basePath
         *
         * @var string|array
         */
        protected $seed = 'Tests\Support\Database\Seeds\TipSeeder';

        public function testModelFindAll()
        {
            $expectedCount = 3;
            $model = new TipModel();

            $objects = $model->findAll();

            $this->assertCount($expectedCount, $objects);
        }

        public function testModelFindById()
        {
            $model = new TipModel();

            $tip = $model->find(1);

            $this->assertEquals('Kuća', $tip->naziv);
        }


    }
