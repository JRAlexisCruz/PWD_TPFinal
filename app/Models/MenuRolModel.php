<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuRolModel extends Model
{
    protected $table = 'menurol';
    protected $primaryKey = 'idmenu';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idmenu', 'idrol'];

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