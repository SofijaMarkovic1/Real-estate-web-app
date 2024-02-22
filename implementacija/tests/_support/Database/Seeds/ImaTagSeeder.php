<?php

    namespace Tests\Support\Database\Seeds;

    use CodeIgniter\Database\Seeder;

    class ImaTagSeeder extends Seeder
    {
        public function run()
        {
            $this->createImaTagTable();

            $entries = [
                [
                    'idTag' => 1,
                    'idNekretnina' => 1
                ],
                [
                    'idTag' => 2,
                    'idNekretnina' => 2
                ],
                [
                    'idTag' => 2,
                    'idNekretnina' => 3
                ],
                [
                    'idTag' => 3,
                    'idNekretnina' => 1
                ],
                [
                    'idTag' => 3,
                    'idNekretnina' => 3
                ]
            ];

            $this->db->table('ima_tag')->insertBatch($entries);
        }

        private function createImaTagTable()
        {
            $this->db->query('DROP TABLE IF EXISTS ima_tag');
            $this->db->query('CREATE TABLE IF NOT EXISTS ima_tag (
                idTag INTEGER NOT NULL,
                idNekretnina INTEGER NOT NULL,
                PRIMARY KEY (idTag, idNekretnina)
            )');
        }
    }
