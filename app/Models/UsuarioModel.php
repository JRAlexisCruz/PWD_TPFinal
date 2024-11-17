<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idusuario';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idusuario', 'usnombre', 'uspass', 'usmail', 'usdeshabilitado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = 'usdeshabilitado';

    // Validation
    protected $validationRules = [
        'usnombre' => 'required|alpha_numeric|is_unique[usuario.usnombre]|max_length[50]',
        'uspass' => 'required|min_length[8]|max_length[100]|alpha_numeric',
        'usmail' => 'required|valid_email|max_length[50]', 
    ];
    protected $validationMessages = [
        'usnombre' => [
            'required' => 'El nombre de usuario es obligatorio',
            'alpha_numeric' => 'El nombre de usuario debe ser alfanumérico',
            'is_unique' => 'El nombre de usuario ya existe',
            'max_length' => 'El nombre de usuario debe tener como máximo 50 caracteres',
        ],
        'uspass' => [
            'required' => 'La contraseña es obligatoria',
            'min_length' => 'La contraseña debe tener al menos 8 caracteres',
            'max_length' => 'La contraseña debe tener como máximo 100 caracteres',
            'alpha_numeric' => 'La contraseña debe ser alfanumérica',
        ],
        'usmail' => [
            'required' => 'El email es obligatorio',
            'valid_email' => 'El email no es válido',
            'max_length' => 'El email debe tener como máximo 50 caracteres',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

}