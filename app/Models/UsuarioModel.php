<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsuarioRolModel;
use App\Models\RolModel;

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

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function darRoles($idUsuario){
        $usuario = $this->find($idUsuario);
        $roles = [];
        if($usuario){
            $usuarioRolModel = new UsuarioRolModel();
            $rolesUsuario = $usuarioRolModel->where('idusuario', $idUsuario)->findAll();
            if(count($rolesUsuario) != 0){
                $rolModel = new RolModel();
                foreach($rolesUsuario as $rolUsuario){
                    $rol = $rolModel->find($rolUsuario['idrol']);
                    if($rol){
                        $roles[] = $rol;
                    }
                }
            }
        }
        return $roles;
    }

    public function darNombreRoles($idUsuario){
        $usuario = $this->find($idUsuario);
        $roles = [];
        if($usuario){
            $usuarioRolModel = new UsuarioRolModel();
            $rolesUsuario = $usuarioRolModel->where('idusuario', $idUsuario)->findAll();
            if(count($rolesUsuario) != 0){
                $rolModel = new RolModel();
                foreach($rolesUsuario as $rolUsuario){
                    $rol = $rolModel->find($rolUsuario['idrol']);
                    if($rol){
                        $roles[] = $rol['rodescripcion'];
                    }
                }
            }
        }
        return $roles;
    }

    public function darCompras(){
        $compras = [];
        $usuario = $this->find(session('idusuario'));
        if($usuario){
            $compraModel = new CompraModel();
            $comprasUsuario = $compraModel->where('idusuario', session('idusuario'))->findAll();
            if($comprasUsuario){
                foreach($comprasUsuario as $compraUsuario){
                    $compraRetorno = ['idcompra' => $compraUsuario['idcompra'], 'cofecha' => $compraUsuario['cofecha']];
                    $productos = $compraModel->darProductos($compraUsuario['idcompra']);
                    $compraRetorno['productos'] = $productos;
                    $estado = $compraModel->darEstado($compraUsuario['idcompra']);
                    $compraRetorno['estado'] = $estado;
                    $compras[] = $compraRetorno;
                }
            }
        }
        return $compras;
    }

    public function listar(){
        $usuarios = $this->withDeleted()->findAll();
        $aux = [];
        foreach($usuarios as $usuario){
            $roles = $this->darNombreRoles($usuario['idusuario']);
            $usuario['roles'] = $roles;
            $aux[] = $usuario;
        }
        return $aux;
    }

    public function insertar($data){
        $insertado = false;
        $nuevoUsuario = [
            'usnombre' => $data['usnombre'],
            'uspass' => $data['uspass'],
            'usmail' => $data['usmail'],
        ];
        if($this->insert($nuevoUsuario,false)){
            $idUsuario = $this->getInsertID();
            $usuarioRolModel = new UsuarioRolModel();
            if(array_key_exists('roles', $data)){
                $roles = $data['roles'];
                foreach($roles as $rol){
                    $usuarioRolModel->insert(['idusuario' => $idUsuario, 'idrol' => $rol]);
                }
            }else{
                $usuarioRolModel->insert(['idusuario' => $idUsuario, 'idrol' => 3]);

            }
            $insertado = true;
        }
        return $insertado;
    }

    public function modificar($data){
        $modificado = false;
        $usuarioModificado = [
            'usnombre' => $data['usnombre'],
            'uspass' => $data['uspass'],
            'usmail' => $data['usmail'],
        ];
        $idUsuario = $data['idusuario'];
        if($this->find($idUsuario)){
            if($this->update($idUsuario, $usuarioModificado)){
                if(array_key_exists('roles', $data)){
                    $rolesUsuario=$data['roles'];
                    $rolModel=new RolModel();
                    $roles=$rolModel->findAll();
                    $usuarioRolModel=new UsuarioRolModel();
                    foreach($roles as $rol){
                        $cargado = $usuarioRolModel->where('idusuario', $idUsuario)->where('idrol', $rol['idrol'])->first();
                        if(in_array($rol['idrol'], $rolesUsuario)){
                            if(!isset($cargado)){
                                $usuarioRolModel->insert(['idusuario' => $idUsuario, 'idrol' => $rol['idrol']]);
                            }
                        }else{
                            if(isset($cargado)){
                                $usuarioRolModel->where('idusuario', $idUsuario)->where('idrol', $rol['idrol'])->delete();
                            }
                        }
                    }
                }else{
                    $usuarioRolModel = new UsuarioRolModel();
                    $usuarioRolModel->where('idusuario', $idUsuario)->delete();
                    $usuarioRolModel->insert(['idusuario' => $idUsuario, 'idrol' => 3]);
                }
                $modificado = true;
            }
        }
        return $modificado;
    }
}