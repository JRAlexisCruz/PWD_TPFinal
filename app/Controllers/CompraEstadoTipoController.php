<?php

namespace App\Controllers;

use App\Models\CompraEstadoTipoModel;

class CompraEstadoTipoController extends BaseController
{  
    protected $compraEstadoTipoModel;

    public function __construct(){
        $this->compraEstadoTipoModel = new CompraEstadoTipoModel();
    }

    public function listar(){
        $estadoCompras = $this->compraEstadoTipoModel->findAll();
        echo json_encode($estadoCompras);
    }
}