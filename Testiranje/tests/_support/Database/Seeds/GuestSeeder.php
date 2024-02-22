<?php namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GuestSeeder extends Seeder
{
    public function run()
    {
        // Pravi tabelu jer Na Linuxu DbTestCase ne radi
        $this->createTable();
        $data = [
            [
                'ime_prezime' => 'admin',
                'email' => 'admin@admin.com',
                'telefon' => '00000000',
                'username' => 'admin',
                'password' => 'admin123',
                'isAdmin' => 1
            ]
        ];
        $nekretnine = [

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
                    'opis' => 'Beograd',
                    'broj_soba' => 4,
                    'cena' => 250000
                ]

        ];

        $this->db->table('korisnik')->insertBatch($data);
        $this->db->table('nekretnina')->insertBatch($nekretnine);

    }

    private function createTable()
    {

        $this->db->query('DROP TABLE IF EXISTS korisnik;
            CREATE TABLE korisnik (
                idKorisnik INTEGER PRIMARY KEY AUTOINCREMENT,
                ime_prezime TEXT,
                email TEXT,
                username TEXT,
                password TEXT,
                telefon TEXT,
                isAdmin INTEGER
        )');


        $this->db->query('DROP TABLE IF EXISTS zahtev;
            CREATE TABLE zahtev (
                    idZahtev INTEGER PRIMARY KEY AUTOINCREMENT,
                    ime_prezime TEXT,
                    email TEXT,
                    username TEXT,
                    password TEXT,
                    telefon TEXT
        );');

        $this->db->query('DROP TABLE IF EXISTS nekretnina');
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS nekretnina (
            idNekretnina INT PRIMARY KEY,
            idTip INT,
            idStanja INT,
            kvadratura INT,
            drzava VARCHAR(255),
            grad VARCHAR(255),
            opstina VARCHAR(255),
            adresa VARCHAR(255),
            idGrejanja INT,
            opis TEXT,
            broj_soba INT,
            cena DECIMAL(10,2)
        )');

        $this->db->query('DROP TABLE IF EXISTS tag');
        $this->db->query('CREATE TABLE IF NOT EXISTS tag (
                idTag INTEGER PRIMARY KEY AUTOINCREMENT,
                naziv TEXT NOT NULL
            )');

        $this->db->query('DROP TABLE IF EXISTS ima_tag');
        $this->db->query('CREATE TABLE IF NOT EXISTS ima_tag (
                idTag INTEGER NOT NULL,
                idNekretnina INTEGER NOT NULL,
                PRIMARY KEY (idTag, idNekretnina)
            )');

        $this->db->query('DROP TABLE IF EXISTS slike_nekretnina');
        $this->db->query('CREATE TABLE IF NOT EXISTS slike_nekretnina (
                slika INTEGER NOT NULL,
                idNekretnina INTEGER NOT NULL,
                PRIMARY KEY (slika, idNekretnina)
            )');


    }
}

