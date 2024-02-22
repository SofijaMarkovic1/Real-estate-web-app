<?php

namespace App\Models;

use CodeIgniter\Model;

class ImaTagModel extends Model
{
    protected $table = 'ima_tag';
    protected $primaryKey = array('idTag', 'idNekretnina');
    protected $idTag = 'idTag';
    protected $idNekretnina = 'idNekretnina';

    protected $returnType = 'object';

    protected $allowedFields = ['idTag', 'idNekretnina'];

    public function findByTagId($idTag){
        return $this->select("idNekretnina")->where("idTag", $idTag)->findAll();
    }

    public function dohvatiSveZaNekretninu($idNekretnine){
        return $this->where("idNekretnina", $idNekretnine)->findAll();
    }
}