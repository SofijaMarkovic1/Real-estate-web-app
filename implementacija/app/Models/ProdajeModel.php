<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdajeModel extends Model
{
    protected $table = 'prodaje';
    protected $primaryKey = array('idKorisnik', 'idNekretnina');
    protected $idKorisnik = 'idKorisnik';
    protected $idNekretnina = 'idNekretnina';

    protected $returnType = 'object';

    protected $allowedFields = ['idKorisnik', 'idNekretnina'];


    public function prodavac($idNekretnine){
        $prodaje = $this->where("idNekretnina", $idNekretnine)->findAll()[0];
        $km = new KorisnikModel();
        return $km->find($prodaje->idKorisnik);
    }

    public function dohvatiSveZaNekretninu($idNekretnine){
        return $this->where("idNekretnina", $idNekretnine)->findAll();
    }
}