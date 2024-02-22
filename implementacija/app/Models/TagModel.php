<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'idTag';
    protected $idTag = 'idTag';
    protected $naziv = 'naziv';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = ['idTag', 'naziv'];

    /**
     * Vraca id tagova
     * Pretrazuje naziv
     */
    public function likeByName($txt){
        return $this->select("idTag")->like("naziv", $txt)->findAll();
    }
    public function findByName($txt){
        return $this->select("idTag")->where("naziv", $txt)->first();
    }
}