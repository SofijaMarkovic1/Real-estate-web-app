<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table = 'korisnik';
    protected $primaryKey = 'idKorisnik';
    protected $idKorisnik = 'idKorisnik';
    protected $ime_prezime = 'ime_prezime';
    protected $email = 'email';
    protected $username = 'username';
    protected $password = 'password';
    protected $telefon = 'telefon';
    protected $isAdmin = 'isAdmin';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = ['idKorisnik', 'ime_prezime', 'email', 'username', 'password', 'telefon', 'isAdmin'];

    public function findByEmail($email){
        return $this->where("email", $email)->first();
    }

    public function findByUsername($korIme){
        return $this->where("username", $korIme)->first();
    }

    public function findByPhoneNumber($brojTelefona){
        return $this->where("telefon", $brojTelefona)->first();
    }
}