<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsuarioRolModel;

class RolModel extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'idrol';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idrol', 'rodescripcion'];

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

    public function eliminar($idRol){
        $eliminado=false;
        $usuarioRolModel = new UsuarioRolModel();
        $tieneUsuario=$usuarioRolModel->where('idrol', $idRol)->first();
        if($tieneUsuario==null){
            $this->delete($idRol);
            $eliminado=true;
        }
        return $eliminado;
    }

}