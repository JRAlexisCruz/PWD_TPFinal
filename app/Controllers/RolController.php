<?php

namespace App\Controllers;

use App\Models\RolModel;
use Exception;

class RolController extends BaseController{
    protected $rolModel;

    public function __construct(){
        $this->rolModel = new RolModel();
    }

    public function administrar(){
        return view('abm/abmRoles');
    }

    public function listar(){
        $roles = $this->rolModel->findAll();
        echo json_encode($roles);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idrol'])){
            $id = $data['idrol'];
            $rol = $this->rolModel->find($id);
            if($rol){
                if($this->rolModel->update($id, $data)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al editar el rol';
                }
            }else{
                $retorno['errorMsg'] = 'Rol no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->rolModel->insert($data)){
            $retorno['success'] = true;
        }else{
            $retorno['errorMsg'] = 'Error al crear el rol';
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idrol'])){
            $id = $data['idrol'];
            $rol = $this->rolModel->find($id);
            if($rol){
                if($this->rolModel->eliminar($id)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al eliminar el rol';
                }
            }else{
                $retorno['errorMsg'] = 'Rol no encontrado';
            }
        }
        echo json_encode($retorno);
    }

}