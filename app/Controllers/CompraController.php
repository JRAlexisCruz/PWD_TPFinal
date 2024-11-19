<?php

namespace App\Controllers;

use App\Models\CompraModel;

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
}