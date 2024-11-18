<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController{
    protected $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    // Método para listar los usuarios
    public function administrar(){
        $usuarios = $this->usuarioModel->findAll(); // Obtener todos los usuarios
        return view('abm/abmUsuarios', ['usuarios' => $usuarios]);
    }

    public function listar(){
        $usuarios = $this->usuarioModel->findAll();
        echo json_encode($usuarios);
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
                    echo json_encode($retorno);
                }else{
                    $retorno['errorMsg'] = 'Error al editar el usuario';
                    echo json_encode($retorno);
                }
            }else{
                $retorno['errorMsg'] = 'Usuario no encontrado';
                echo json_encode($retorno);
            }
        }
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->usuarioModel->insert($data)){
            $retorno['success'] = true;
            echo json_encode($retorno);
        }else{
            $retorno['errorMsg'] = 'Error al crear el usuario';
            echo json_encode($retorno);
        }
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
                echo json_encode($retorno);
            }else{
                $retorno['errorMsg'] = 'Usuario no encontrado';
                echo json_encode($retorno);
            }
        }
    }
}

