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
        if($this->menuModel->insert($data)){
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
            $id = $data['idmenu'];
            $rol = $this->menuModel->find($id);
            if($rol){
                if($this->menuModel->update($id, $data)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al editar el menu';
                }
            }else{
                $retorno['errorMsg'] = 'Menu no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idmenu'])){
            $id = $data['idmenu'];
            $menu = $this->menuModel->find($id);
            if($menu){
                if($this->menuModel->eliminar($id)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al eliminar el menu';
                }
            }else{
                $retorno['errorMsg'] = 'Menu no encontrado';
            }
        }
        echo json_encode($retorno);
    }
}