<?php


namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ImaOpremaSeeder extends Seeder
    {
        public function run()
        {
            $this->createImaOpremaTable();

            $entries = [
                [
                    'idOprema' => 1,
                    'idNekretnina' => 1
                ],
                [
                    'idOprema' => 2,
                    'idNekretnina' => 2
                ],
                [
                    'idOprema' => 2,
                    'idNekretnina' => 3
                ],
                [
                    'idOprema' => 3,
                    'idNekretnina' => 1
                ],
                [
                    'idOprema' => 3,
                    'idNekretnina' => 3
                ]
            ];

            $this->db->table('ima_oprema')->insertBatch($entries);
        }

        private function createImaOpremaTable()
        {
            $this->db->query('DROP TABLE IF EXISTS ima_oprema');
            $this->db->query('CREATE TABLE IF NOT EXISTS ima_oprema (
                    idOprema INTEGER NOT NULL,
                    idNekretnina INTEGER NOT NULL,
                    PRIMARY KEY (idOprema, idNekretnina)
                )');
        }
    }
