<?php


namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OpremaSeeder extends Seeder
{
    public function run()
    {
        $this->createOpremaTable();

        $opreme = [
            [
                'idOprema' => 1,
                'naziv' => 'Klima uređaj',
            ],
            [
                'idOprema' => 2,
                'naziv' => 'Kablovska TV',
            ],
            [
                'idOprema' => 3,
                'naziv' => 'Internet',
            ],
        ];

        $this->db->table('oprema')->insertBatch($opreme);
    }

    private function createOpremaTable()
    {
        $this->db->query('DROP TABLE IF EXISTS oprema');
        $this->db->query('CREATE TABLE IF NOT EXISTS oprema (
        idOprema INTEGER PRIMARY KEY AUTOINCREMENT,
        naziv TEXT NOT NULL
    )');
    }


}
