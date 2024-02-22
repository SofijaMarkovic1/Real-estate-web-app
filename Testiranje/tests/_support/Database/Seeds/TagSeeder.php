<?php

    namespace Tests\Support\Database\Seeds;

    use CodeIgniter\Database\Seeder;

    class TagSeeder extends Seeder
    {
        public function run()
        {
            $this->createTagTable();

            $tags = [
                [
                    'idTag' => 1,
                    'naziv' => 'Tag1'
                ],
                [
                    'idTag' => 2,
                    'naziv' => 'Tag2'
                ],
                [
                    'idTag' => 3,
                    'naziv' => 'Tag3'
                ]
            ];

            $this->db->table('tag')->insertBatch($tags);
        }

        private function createTagTable()
        {
            $this->db->query('DROP TABLE IF EXISTS tag');
            $this->db->query('CREATE TABLE IF NOT EXISTS tag (
                idTag INTEGER PRIMARY KEY AUTOINCREMENT,
                naziv TEXT NOT NULL
            )');
        }
    }

