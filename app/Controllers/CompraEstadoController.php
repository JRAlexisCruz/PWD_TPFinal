<?php

namespace App\Controllers;

use App\Models\CompraEstadoModel;
use App\Models\CompraEstadoTipoModel;

class CompraEstadoController extends BaseController
{  
    protected $estadoCompraModel;

    public function __construct(){
        $this->estadoCompraModel = new CompraEstadoModel();
    }

    public function administrar(){
        return view('abm/abmCompraEstado.php');
    }

    public function listar(){
        $estadoCompras = $this->estadoCompraModel->findAll();
        foreach($estadoCompras as $estadoCompra){
            $idEstado= $estadoCompra['idcompraestadotipo'];
            $compraEstadoTipoModel = new CompraEstadoTipoModel();
            $estadoCompraTipo = $compraEstadoTipoModel->find($idEstado);
            $estadoCompra['estado'] = $estadoCompraTipo['cetdescripcion'];
        }
        echo json_encode($estadoCompras);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->estadoCompraModel->insert($data)){
            $retorno['success'] = true;
        }else{
            $retorno['errorMsg'] = 'Error al crear el estado de compra';
        }
        echo json_encode($retorno);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idcompraestado'])){
            $id = $data['idcompraestado'];
            $rol = $this->estadoCompraModel->find($id);
            if($rol){
                if($this->estadoCompraModel->update($id, $data)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al editar el estado de compra';
                }
            }else{
                $retorno['errorMsg'] = 'Estado de compra no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idcompraestado'])){
            $id = $data['idcompraestado'];
            $rol = $this->estadoCompraModel->find($id);
            if($rol){
                $this->estadoCompraModel->delete($id);
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = 'Estado de compra no encontrado';
            }
        }
        echo json_encode($retorno);
    }
}