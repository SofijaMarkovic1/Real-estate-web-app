<?php

namespace App\Models;

use CodeIgniter\Model;

class StanjeModel extends Model
{
    protected $table = 'stanje';
    protected $primaryKey = 'idStanja';
    protected $idStanja = 'idStanja';
    protected $naziv = 'naziv';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = ['idStanja', 'naziv'];
}