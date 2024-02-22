<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NekretninaSeeder extends Seeder
{
    public function run()
    {
        $this->createNekretninaTable();
        $nekretnine = [
            [
                'idNekretnina' => 1,
                'idTip' => 1,
                'idStanja' => 1,
                'kvadratura' => 100,
                'drzava' => 'Srbija',
                'grad' => 'Beograd',
                'opstina' => 'Novi Beograd',
                'adresa' => 'Bulevar Mihajla Pupina 10',
                'idGrejanja' => 1,
                'opis' => 'Prostran stan u centru grada',
                'broj_soba' => 3,
                'cena' => 150000
            ],
            [
                'idNekretnina' => 2,
                'idTip' => 2,
                'idStanja' => 1,
                'kvadratura' => 80,
                'drzava' => 'Srbija',
                'grad' => 'Novi Sad',
                'opstina' => 'Grbavica',
                'adresa' => 'Bulevar Oslobodjenja 20',
                'idGrejanja' => 2,
                'opis' => 'Lepo sredjen stan u mirnom kraju',
                'broj_soba' => 2,
                'cena' => 120000
            ],
            [
                'idNekretnina' => 3,
                'idTip' => 1,
                'idStanja' => 2,
                'kvadratura' => 150,
                'drzava' => 'Srbija',
                'grad' => 'Niš',
                'opstina' => 'Centar',
                'adresa' => 'Bulevar Nemanjića 5',
                'idGrejanja' => 1,
                'opis' => 'Luksuzan stan sa pogledom na grad',
                'broj_soba' => 4,
                'cena' => 250000
            ],
        ];

        $this->db->table('nekretnina')->insertBatch($nekretnine);
    }

    private function createNekretninaTable()
    {
        $this->db->query('DROP TABLE IF EXISTS nekretnina;
            CREATE TABLE nekretnina(
                           idNekretnina INTEGER PRIMARY KEY AUTOINCREMENT,
                           idTip INTEGER,
                           idStanja INTEGER,
                           kvadratura INTEGER,
                           drzava TEXT,
                           grad TEXT,
                           opstina TEXT,
                           adresa TEXT,
                           idGrejanja INTEGER,
                           opis TEXT,
                           broj_soba INTEGER,
                           cena REAL
            );
        ');
    }
}
