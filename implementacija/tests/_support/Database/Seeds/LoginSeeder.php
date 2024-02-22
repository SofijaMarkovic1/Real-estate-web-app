<?php namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LoginSeeder extends Seeder
{
    public function run()
    {
        $this->createDb();
        $korisnici = [
            [
                'ime_prezime' => 'Luka Lukic',
                'email' => 'email@example.com',
                'username' => 'lukal',
                'password' => 'lozinka6',
                'telefon' => '0657654321',
                'isAdmin' => '0'
            ],
            [
                'ime_prezime' => 'Jelena Jelic',
                'email' => 'jelena.jelic@example.com',
                'username' => 'jelenajj',
                'password' => 'lozinka7',
                'telefon' => '0639874512',
                'isAdmin' => '0'
            ]
        ];

        $this->db->table('korisnik')->insertBatch($korisnici);

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

        $nekretnine = [
            [
                "idTip" => 1,
                "idStanja" => 1,
                "kvadratura" => 300,
                "drzava" => "Srbija",
                "grad" => "Novi Sad",
                "opstina" => "Veternik",
                "adresa" => "-",
                "idGrejanja" => 1,
                "opis" => "Novi Sad, Veternik, Lepo uređena kuća - vila na odličnoj lokaciji",
                "broj_soba" => 6,
                "cena" => 329600
            ],
            [
                "idTip" => 1,
                "idStanja" => 1,
                "kvadratura" => 300,
                "drzava" => "Srbija",
                "grad" => "Nis",
                "opstina" => "Calije",
                "adresa" => "-",
                "idGrejanja" => 1,
                "opis" => "Lux kuće, 6. stambnih jedinica, Dva objekta, 4. parking mesta, Poslovni prostor, Novogradnja",
                "broj_soba" => 6,
                "cena" => 600000
            ]
        ];

        $this->db->table('nekretnina')->insertBatch($nekretnine);

        $grejanje = [
            "naziv" => "centralno"
        ];

        $this->db->table('grejanje')->insertBatch($grejanje);

        $tip = [
            "naziv" => "stan"
        ];

        $this->db->table('tip')->insertBatch($tip);

        $prodaju = [
            [
                "idKorisnik" => 1,
                "idNekretnina" => 1
            ],
            [
                "idKorisnik" => 1,
                "idNekretnina" => 2
            ]
        ];

        $this->db->table('prodaje')->insertBatch($prodaju);

        $slike = [
            [
                'idNekretnina' => 1,
                'slika' => file_get_contents(__DIR__ . '/image1.jpg')
            ],
            [
                'idNekretnina' => 2,
                'slika' => file_get_contents(__DIR__ . '/image2.jpg')
            ]
        ];

        $this->db->table('slike_nekretnina')->insertBatch($slike);

        $fav = [
            'idKorisnik' => 2,
            'idNekretnina' => 2
        ];

        $this->db->table('je_omiljeni')->insertBatch($fav);
    }

    private function createDb(){
        $this->db->query("
                DROP TABLE IF EXISTS zahtev;
        
        CREATE TABLE zahtev (
                    idZahtev INTEGER PRIMARY KEY AUTOINCREMENT,
                    ime_prezime TEXT,
                    email TEXT,
                    username TEXT,
                    password TEXT,
                    telefon TEXT
        );
        
        DROP TABLE IF EXISTS korisnik;
        
        CREATE TABLE korisnik (
                      idKorisnik INTEGER PRIMARY KEY AUTOINCREMENT,
                      ime_prezime TEXT,
                      email TEXT,
                      username TEXT,
                      password TEXT,
                      telefon TEXT,
                      isAdmin BOOLEAN DEFAULT 0
        );
        
        DROP TABLE IF EXISTS tip;
        
        CREATE TABLE tip (
                     idTip INTEGER PRIMARY KEY AUTOINCREMENT,
                     naziv TEXT
);
        
        DROP TABLE IF EXISTS grejanje;
        
        CREATE TABLE grejanje (
                      idGrejanja INTEGER PRIMARY KEY AUTOINCREMENT,
                      naziv TEXT
        );
        
        DROP TABLE IF EXISTS prodaje;
        
        CREATE TABLE prodaje (
                     idKorisnik INTEGER,
                     idNekretnina INTEGER
        );
        
        DROP TABLE IF EXISTS nekretnina;
        
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
        
        DROP TABLE IF EXISTS ima_oprema;
        
        CREATE TABLE ima_oprema (
                        idNekretnina INTEGER,
                        idOprema INTEGER
        );
        
        DROP TABLE IF EXISTS ima_tag;
        
        CREATE TABLE ima_tag (
                                 idTag INTEGER,
                                 idNekretnina INTEGER
        );
        
        DROP TABLE IF EXISTS je_omiljeni;
        
        CREATE TABLE je_omiljeni (
                                     idKorisnik INTEGER,
                                     idNekretnina INTEGER
        );
        
        DROP TABLE IF EXISTS oprema;
        
        CREATE TABLE oprema (
                                idOprema INTEGER PRIMARY KEY AUTOINCREMENT,
                                naziv TEXT
        );
        
        DROP TABLE IF EXISTS slike_nekretnina;
        
        CREATE TABLE slike_nekretnina (
                                          idSlika INTEGER PRIMARY KEY AUTOINCREMENT,
                                          idNekretnina INTEGER,
                                          slika BLOB
        );
        
        DROP TABLE IF EXISTS stanje;
        
        CREATE TABLE stanje (
                idStanja INTEGER PRIMARY KEY AUTOINCREMENT,
                naziv TEXT
        );
        
        DROP TABLE IF EXISTS tag;
        
        CREATE TABLE tag (
                 idTag INTEGER PRIMARY KEY AUTOINCREMENT,
                 naziv TEXT
        );");


    }
}
