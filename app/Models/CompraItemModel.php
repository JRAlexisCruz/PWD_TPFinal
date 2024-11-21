<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CompraModel;
use App\Models\ProductModel;

class CompraItemModel extends Model
{
    protected $table = 'compraitem';
    protected $primaryKey = 'idcompraitem';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idcompraitem','idcompra', 'idproducto','cicantidad'];

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

    public function darProductosCompra($idCompra){
        $productos = [];
        $compraModel = new CompraModel();
        $compra = $compraModel->find($idCompra);
        if($compra){
            $productosCompra = $this->where('idcompra', $idCompra)->findAll();
            if($productosCompra){
                $productoModel = new ProductModel();
                foreach($productosCompra as $productoCompra){
                    $encontrado = $productoModel->find($productoCompra['idproducto']);
                    if($encontrado){
                        $encontrado['cicantidad'] = $productoCompra['cicantidad'];
                        $productos[] = $encontrado;
                    }
                }
            }
        }
        return $productos;
    }

}