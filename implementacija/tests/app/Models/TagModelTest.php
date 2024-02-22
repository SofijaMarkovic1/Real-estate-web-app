<?php

    namespace App\Models;

    use App\Models\TagModel;
    use Tests\Support\DbTestCase;

    class TagModelTest extends DbTestCase
    {
        /**
         * The seed file(s) used for all tests within this test case.
         * Should be fully-namespaced or relative to $basePath
         *
         * @var string|array
         */
        protected $seed = 'Tests\Support\Database\Seeds\TagSeeder';

        public function testModelFindAll()
        {
            $expectedCount = 3;
            $model = new TagModel();

            $objects = $model->findAll();

            $this->assertCount($expectedCount, $objects);
        }

        public function testModelFindById()
        {
            $model = new TagModel();

            $tag = $model->find(1);

            $this->assertEquals('Tag1', $tag->naziv);
        }

        public function testModelFindByName()
        {
            $model = new TagModel();

            $tag = $model->findByName('Tag2');

            $this->assertEquals(2, $tag->idTag);

        }

        public function testModelLikeByName()
        {
            $model = new TagModel();

            $tags = $model->likeByName('tag');

            $this->assertIsArray($tags);
            $this->assertCount(3, $tags);

            $expectedIds = [1, 2, 3];
            $actualIds = array_column($tags, 'idTag');
            $this->assertEquals($expectedIds, $actualIds);
        }
    }
