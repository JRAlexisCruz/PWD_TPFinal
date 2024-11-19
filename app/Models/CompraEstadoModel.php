<?php

namespace App\Models;

use CodeIgniter\Model;

class CompraEstadoModel extends Model
{
    protected $table = 'compraestado';
    protected $primaryKey = 'idcompraestado';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idcompraestado', 'idcompra','idcompraestadotipo','cefechaini','cefechafin','ceobservacion'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

}