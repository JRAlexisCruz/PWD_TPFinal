<?php

namespace App\Controllers;

use App\Models\CompraModel;
use App\Models\UsuarioModel;

class CompraController extends BaseController
{  
    protected $compraModel;

    public function __construct(){
        $this->compraModel = new CompraModel();
    }

    public function listar(){
        $compras = $this->compraModel->findAll();
        echo json_encode($compras);
    }

    public function compras(){
        return view('usuario/compras.php');
    }

    public function listarCompras(){
        $usuarioModelo = new UsuarioModel();
        $compras = $usuarioModelo->darCompras();
        $data['compras']=$compras;
        $data['success']=true;
        return $this->response->setJSON($data);
    }

    public function cancelar(){
        $idcompra = $this->request->getPost('idcompra');
        $this->compraModel->cancelarCompra($idcompra);
        return $this->listarCompras();
    }
}