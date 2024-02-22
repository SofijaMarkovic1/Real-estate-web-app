<?php

    namespace Tests\Support\Database\Seeds;

    use CodeIgniter\Database\Seeder;

    class ZahtevSeeder extends Seeder
    {


        public function run()
        {
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
        }

        private function createZahtevTable()
        {
            $this->db->query('DROP TABLE IF EXISTS zahtev');
            $this->db->query('CREATE TABLE IF NOT EXISTS zahtev (
                        idZahtev INTEGER PRIMARY KEY AUTOINCREMENT,
                        ime_prezime TEXT,
                        email TEXT,
                        username TEXT,
                        password TEXT,
                        telefon TEXT)'
            );
        }
    }
