<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GrejanjeSeeder extends Seeder
{
    public function run()
    {
        $this->createGrejanjeTable();
        $data = [
            [
                'naziv' => 'Centralno grejanje',
            ],
            [
                'naziv' => 'Etažno grejanje',
            ],
            [
                'naziv' => 'Podno grejanje',
            ],
        ];

        $this->db->table('grejanje')->insertBatch($data);
    }

    private function createGrejanjeTable(){
        // Create the grejanje table
                $query =
                    'CREATE TABLE IF NOT EXISTS grejanje (
                        idGrejanja INTEGER PRIMARY KEY AUTOINCREMENT,
                        naziv TEXT NOT NULL
                    )';

        $this->db->query($query);
    }
}
