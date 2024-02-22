<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StanjeSeeder extends Seeder
{
    public function run()
    {
        $this->createStanjeTable();

        $stanja = [
            [
                'idStanja' => 1,
                'naziv' => 'Novo'
            ],
            [
                'idStanja' => 2,
                'naziv' => 'Polovno'
            ],
            [
                'idStanja' => 3,
                'naziv' => 'Renovirano'
            ]
        ];

        $this->db->table('stanje')->insertBatch($stanja);
    }

    private function createStanjeTable()
    {
        $this->db->query('DROP TABLE IF EXISTS stanje');
        $this->db->query('CREATE TABLE IF NOT EXISTS stanje (
            idStanja INTEGER PRIMARY KEY AUTOINCREMENT,
            naziv TEXT NOT NULL);'
        );
    }
}

