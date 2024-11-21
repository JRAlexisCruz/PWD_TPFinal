<?php

namespace App\Controllers;

use App\Models\CompraEstadoModel;
use App\Models\CompraEstadoTipoModel;
use App\Models\CompraModel;

class CompraEstadoController extends BaseController
{  
    protected $estadoCompraModel;

    public function __construct(){
        $this->estadoCompraModel = new CompraEstadoModel();
    }

    public function administrar(){
        return view('abm/abmCompraEstado.php');
    }

    // Original de alexis
     public function listarProductos(){
        $compraModel= new CompraModel();
        $compras=$compraModel->findAll();
        $retorno = [];
        foreach($compras as $compra){
            $estadoCompraTipo = $this->estadoCompraModel->where('idcompra', $compra['idcompra'])->join('compraestadotipo', 'compraestado.idcompraestadotipo = compraestadotipo.idcompraestadotipo')->select('compraestado.*, compraestadotipo.cetdescripcion as estado')->orderBy('compraestado.idcompraestado', 'DESC')->first();
            $retorno[] = $estadoCompraTipo;
        }
        echo json_encode($retorno);
    }

    public function listar()
    {
        $estadoCompras = $this->estadoCompraModel->join('compraestadotipo', 'compraestado.idcompraestadotipo = compraestadotipo.idcompraestadotipo')
                                                 ->select('compraestado.*, compraestadotipo.cetdescripcion as estado')
                                                 ->findAll();
    
        echo json_encode($estadoCompras);
    }

    public function actualizar(){
        $data = $this->request->getPost();
        $mensaje= ['success' => false];
        if(isset($data['idcompra'])){
            $id = $data['idcompra'];
            $actualizado=$this->estadoCompraModel->actualizar($id);
            if($actualizado){
                $mensaje['success'] = true;
            }else{
                $mensaje['errorMsg'] = $this->estadoCompraModel->getError();
            }
        }
        $this->response->setJSON($mensaje);
    }

    public function cancelar(){
        $data = $this->request->getPost();
        $mensaje= ['success' => false];
        if(isset($data['idcompra'])){
            $id = $data['idcompra'];
            $actualizado=$this->estadoCompraModel->cancelar($id);
            if($actualizado){
                $mensaje['success'] = true;
            }else{
                $mensaje['errorMsg'] = $this->estadoCompraModel->getError();
            }
        }
        $this->response->setJSON($mensaje);
    }


    public function sendConfirmationEmail($userEmail)
{
    $email = \Config\Services::email();

    $email->setFrom('tuemail@dominio.com', 'Tu Empresa');
    $email->setTo($userEmail);

    $email->setSubject('Compra Confirmada');
    $email->setMessage('¡Tu compra ha sido confirmada! Gracias por tu compra. Nos estamos preparando para enviarlo.');

    if ($email->send()) {
        return true;
    } else {
        log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        return false;
    }
}

}