<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\UsuarioRolModel;
use App\Models\RolModel;

class UsuarioController extends BaseController{
    protected $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    public function administrar(){
        return view('abm/abmUsuarios');
    }

    public function listar(){
        $usuarios = $this->usuarioModel->findAll();
        $aux = [];
        foreach($usuarios as $usuario){
            $idUsuario = $usuario['idusuario'];
            $usuarioRolModel = new UsuarioRolModel();
            $usuarioRol = $usuarioRolModel->where('idusuario', $idUsuario)->findAll();
            $roles = '';
            foreach($usuarioRol as $rol){
                $rolModel = new RolModel();
                $rol = $rolModel->find($rol['idrol']);
                $roles .= $rol['rodescripcion'].', ';
            }
            $roles = substr($roles, 0, -2);
            $usuario['roles'] = $roles;
            $aux[] = $usuario;
        }
        echo json_encode($aux);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idusuario'])){
            $id = $data['idusuario'];
            $usuario = $this->usuarioModel->find($id);
            if($usuario){
                if($this->usuarioModel->update($id, $data)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al editar el usuario';
                }
            }else{
                $retorno['errorMsg'] = 'Usuario no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->usuarioModel->insert($data)){
            $retorno['success'] = true;
        }else{
            $retorno['errorMsg'] = 'Error al crear el usuario';
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['id'])){
            $id = $data['id'];
            $usuario = $this->usuarioModel->find($id);
            if($usuario){
                $this->usuarioModel->delete($id);
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = 'Usuario no encontrado'; 
            }
        }
        echo json_encode($retorno);
    }
}

