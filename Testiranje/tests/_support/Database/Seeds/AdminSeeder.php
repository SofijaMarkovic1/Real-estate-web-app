<?php namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Kreira bazu jer na Linuxu ne radi DbTestCase
        $this->createZahtevTable();
        $zahtevi = [
            [
                'ime_prezime'     => 'Pera Peric',
                'email'   => 'peraperic@example.com',
                'username' => 'pera',
                'password' => 'peric123',
                'telefon' => "0623434343"
            ],
            [
                'ime_prezime'     => 'Zika Zikic',
                'email'   => 'zikazikic@example.com',
                'username' => 'zika',
                'password' => 'zikic123',
                'telefon' => "066454545454"
            ],
        ];
        $this->db->table('zahtev')->insertBatch($zahtevi);

        $admin = [
            'ime_prezime' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => 'admin',
            'telefon' => '0611111111',
            'isAdmin' => '1'
        ];

        $this->db->table('korisnik')->insertBatch($admin);

    }


    private function createZahtevTable()
    {
        $this->db->query('DROP TABLE IF EXISTS zahtev;
                CREATE TABLE zahtev (
                        idZahtev INTEGER PRIMARY KEY AUTOINCREMENT,
                        ime_prezime TEXT,
                        email TEXT,
                        username TEXT,
                        password TEXT,
                        telefon TEXT
        );');

        $this->db->query('
                DROP TABLE IF EXISTS korisnik;
                CREATE TABLE korisnik (
                          idKorisnik INTEGER PRIMARY KEY AUTOINCREMENT,
                          ime_prezime TEXT,
                          email TEXT,
                          username TEXT,
                          password TEXT,
                          telefon TEXT,
                          isAdmin BOOLEAN DEFAULT 0
    );');


    }
}
