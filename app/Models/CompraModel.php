<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CompraItemModel;
use App\Models\CompraEstadoModel;

class CompraModel extends Model
{
    protected $table = 'compra';
    protected $primaryKey = 'idcompra';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idcompra', 'cofecha','idusuario'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function darProductos($idCompra){
        $compraModel=new CompraModel();
        $compra=$compraModel->find($idCompra);
        $productos=[];
        if($compra){
            $compraItemModel=new CompraItemModel();
            $productos=$compraItemModel->darProductosCompra($idCompra);
        }
        return $productos;
    }

    public function darEstado($idCompra){
        $compraModel=new CompraModel();
        $compra=$compraModel->find($idCompra);
        $estado='';
        if($compra){
            $compraEstadoModel=new CompraEstadoModel();
            $estados=$compraEstadoModel->getEstadosByCompra($idCompra);
            if(count($estados)>0){
                $estado=$estados[0]['cetdescripcion'];
            }
        }
        return $estado;
    }

}