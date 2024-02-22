<?php

namespace App\Models;

use CodeIgniter\Model;

class ImaOpremaModel extends Model
{
    protected $table = 'ima_oprema';
    protected $primaryKey = array('idNekretnina','idOprema');
    protected $idNekretnina = 'idNekretnina';
    protected $idOprema = 'idOprema';

    protected $returnType = 'object';

    protected $allowedFields = ['idNekretnine', 'idOprema'];

    /**
     * Dohvata id-jeve svih nekretnina koje sadrze makar jednu od prosledjenih oprema
     * $opreme - id-jevi oprema
     */
    public function imaOpreme($opreme){
        $idNekretnina = [];
        if(count($opreme) == count((new OpremaModel())->findAll())){
            $nekretnine = (new NekretninaModel())->findAll();
            foreach ($nekretnine as $n) $idNekretnina[] = $n->idNekretnina;
        }
        else {
            $imaOprema = $this->whereIn("idOprema", $opreme)->findAll();
            foreach ($imaOprema as $io) {
                $idNekretnina[] = $io->idNekretnina;
            }
        }
        return $idNekretnina;
    }

    public function dohvatiSveZaNekretninu($idNekretnine){
        return $this->where("idNekretnina", $idNekretnine)->findAll();
    }
}