<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController{
    protected $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    public function editarPerfil(){
        return view('usuario/editar.php');
    }

    public function modificar(){
        $data = $this->request->getPost();
        $modificar=[];
        if(isset($data['usnombre']) && $data['usnombre']!=""){
            $modificar['usnombre']=$data['usnombre'];
        }
        if(isset($data['usmail']) && $data['usmail']!=""){
            $modificar['usmail']=$data['usmail'];
        }
        if(isset($data['uspass']) && $data['uspass']!=""){
            $modificar['uspass']=$data['uspass'];
        }
        $retorno['success']=false;
        $usuarioModelo = new UsuarioModel();
        if($usuarioModelo->update(session('idusuario'),$modificar)){
            $retorno['success']=true;
            $retorno['msg']='Usuario modificado';
            setcookie('usnombre',$data['usnombre']);
        }else{
            $retorno['msg']='Error al modificar';
        }
        echo json_encode($retorno);
    }

    public function verificar(){
        $data=$this->request->getPost();
        $idUsuario=session('idusuario');
        $retorno['success']=false;
        if(isset($data['uspass']) && $data['uspass']!=""){
            $usuarioModelo = new UsuarioModel();
            $usuario = $usuarioModelo->where('idusuario',$idUsuario)->where('uspass',$data['uspass'])->first();
            if($usuario){
                $retorno['success']=true;
            }else{
                $retorno['msg']='Contraseña incorrecta';
            }
        }
        echo json_encode($retorno);
    }

    public function buscar(){
        $data = $this->request->getGet();
        $usuarioModelo = new UsuarioModel();
        $usuario = $usuarioModelo->find($data['idusuario']);
        $data=[
            'usnombre'=>$usuario['usnombre'],
            'usmail'=>$usuario['usmail']
        ];
        echo json_encode($data);
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

