<?php

namespace App\Models;

use CodeIgniter\Model;

class CompraEstadoTipoModel extends Model
{
    protected $table = 'compraestadotipo';
    protected $primaryKey = 'idcompraestadotipo';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idcompraestadotipo', 'cetdescripcion','cetdetalle'];

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