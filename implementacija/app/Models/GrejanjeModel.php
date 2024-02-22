<?php

namespace App\Models;

use CodeIgniter\Model;

class GrejanjeModel extends Model
{
    protected $table      = 'grejanje';
    protected $primaryKey = 'idGrejanja';
    protected $idGrejanja = 'idGrejanja';
    protected $naziv = 'naziv';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['idGrejanja', 'naziv'];

}