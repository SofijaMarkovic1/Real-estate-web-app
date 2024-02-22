<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipSeeder extends Seeder
{


    public function run()
    {
        $this->createTipTable();

        $tipovi = [
            [
                'idTip' => 1,
                'naziv' => 'Kuća'
            ],
            [
                'idTip' => 2,
                'naziv' => 'Stan'
            ],
            [
                'idTip' => 3,
                'naziv' => 'Poslovni prostor'
            ]
        ];

        $this->db->table('tip')->insertBatch($tipovi);
    }

    private function createTipTable()
    {
        $this->db->query('DROP TABLE IF EXISTS tip');
        $this->db->query('CREATE TABLE tip (
            idTip INTEGER PRIMARY KEY AUTOINCREMENT,
            naziv TEXT NOT NULL
        )');
    }
}
