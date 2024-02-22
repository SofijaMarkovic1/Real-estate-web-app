<?php

namespace App\Models;

    use App\Models\ImaTagModel;
    use Tests\Support\DbTestCase;

    class ImaTagModelTest extends DbTestCase
    {
        /**
         * The seed file(s) used for all tests within this test case.
         * Should be fully-namespaced or relative to $basePath
         *
         * @var string|array
         */
        protected $seed = 'Tests\Support\Database\Seeds\ImaTagSeeder';

        public function testModelFindByTagId()
        {
            $model = new ImaTagModel();

            $entries = $model->findByTagId(2);

            $this->assertIsArray($entries);
            $this->assertCount(2, $entries);

            $expectedIds = [2, 3];
            $actualIds = array_column($entries, 'idNekretnina');
            $this->assertEquals($expectedIds, $actualIds);
        }

        public function testModelDohvatiSveZaNekretninu()
        {
            $model = new ImaTagModel();

            $entries = $model->dohvatiSveZaNekretninu(1);

            $this->assertIsArray($entries);
            $this->assertCount(2, $entries);

            $expectedIds = [1, 3];
            $actualIds = array_column($entries, 'idTag');
            $this->assertEquals($expectedIds, $actualIds);
        }
    }

