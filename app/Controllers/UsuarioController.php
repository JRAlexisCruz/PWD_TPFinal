<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController{
    protected $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    public function administrar(){
        return view('abm/abmUsuarios');
    }

    public function listar(){
        $usuarios = $this->usuarioModel->listar();
        echo json_encode($usuarios);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idusuario'])){
            $modificado = $this->usuarioModel->modificar($data);
            if($modificado){
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = 'Usuario no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->usuarioModel->insertar($data)){
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

