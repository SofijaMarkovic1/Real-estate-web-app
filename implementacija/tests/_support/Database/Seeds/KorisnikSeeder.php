<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KorisnikSeeder extends Seeder
{

    public function run(){
        $this->createTable();

        $korisnici = [
            [
                'idKorisnik' => 1,
                'ime_prezime' => 'Luka Lukić',
                'email' => 'luka.lukic1@example.com',
                'username' => 'lukal1',
                'password' => 'lozinka6',
                'telefon' => '06412345091',
                'isAdmin' => 0
            ],
            [
                'idKorisnik' => 2,
                'ime_prezime' => 'Jelena Jelić',
                'email' => 'jelena.jelic1@example.com',
                'username' => 'jelenajj1',
                'password' => 'lozinka71',
                'telefon' => '06398745121',
                'isAdmin' => 0
            ],
            [
                'idKorisnik' => 3,
                'ime_prezime' => 'Nikola Nikolić',
                'email' => 'nikola.nikolicc1@example.com',
                'username' => 'nikolann1',
                'password' => 'lozinka81',
                'telefon' => '06212345981',
                'isAdmin' => 0
            ]
        ];

        $this->db->table('korisnik')->insertBatch($korisnici);

    }

    private function createTable()
    {
        $this->db->query('DROP TABLE IF EXISTS korisnik');
        $this->db->query('CREATE TABLE IF NOT EXISTS korisnik (
            idKorisnik INTEGER PRIMARY KEY AUTOINCREMENT,
            ime_prezime TEXT,
            email TEXT,
            username TEXT,
            password TEXT,
            telefon TEXT,
            isAdmin INTEGER
        )');
    }
}