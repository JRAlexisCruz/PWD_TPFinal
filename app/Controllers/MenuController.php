<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuController extends BaseController
{  
    protected $menuModel;

    public function __construct(){
        $this->menuModel = new MenuModel();
    }

    public function administrar(){
        return view('abm/abmMenus.php');
    }

    public function listar(){
        $menus = $this->menuModel->listar();
        echo json_encode($menus);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->menuModel->insertar($data)){
            $retorno['success'] = true;
        }else{
            $retorno['errorMsg'] = 'Error al crear el menu';
        }
        echo json_encode($retorno);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idmenu'])){
            if($this->menuModel->editar( $data)){
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = $this->menuModel->getError();
            }
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idmenu'])){
            $id = $data['idmenu'];
            if($this->menuModel->eliminar($id)){
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = 'Error al eliminar el menu';
            }
        }
        echo json_encode($retorno);
    }
}