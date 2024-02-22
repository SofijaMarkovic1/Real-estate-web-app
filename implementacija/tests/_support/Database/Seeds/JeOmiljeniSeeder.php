<?php


namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JeOmiljeniSeeder extends Seeder
{
    public function run()
    {
        $this->createJeOmiljeniTable();

        $entries = [
            [
                'idKorisnik' => 1,
                'idNekretnina' => 1
            ],
            [
                'idKorisnik' => 2,
                'idNekretnina' => 2
            ],
            [
                'idKorisnik' => 2,
                'idNekretnina' => 3
            ],
            [
                'idKorisnik' => 3,
                'idNekretnina' => 1
            ],
            [
                'idKorisnik' => 3,
                'idNekretnina' => 3
            ]
        ];

        $this->db->table('je_omiljeni')->insertBatch($entries);
    }

    private function createJeOmiljeniTable()
    {
        $this->db->query('DROP TABLE IF EXISTS je_omiljeni');
        $this->db->query('CREATE TABLE IF NOT EXISTS je_omiljeni (
                    idKorisnik INTEGER NOT NULL,
                    idNekretnina INTEGER NOT NULL,
                    PRIMARY KEY (idKorisnik, idNekretnina)
                )');
    }
}
