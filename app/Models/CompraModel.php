<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CompraItemModel;
use App\Models\CompraEstadoModel;
use App\Models\ProductModel; // Importar ProductModel

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

    // Método para cancelar la compra y devolver el stock de los productos
    public function cancelarCompra($idCompra){
        $compraModel = new CompraModel();
        $compra = $compraModel->find($idCompra);

        if ($compra) {
            // Cambiar el estado de la compra a "Cancelada" (asumo que el estado 5 es "cancelada")
            $nuevoEstadoCompra = [
                'idcompra' => $idCompra,
                'idcompraestadotipo' => 5, // Estado "Cancelada"
                'cefechaini' => date('Y-m-d H:i:s'),
                'cefechafin' => date('Y-m-d H:i:s')
            ];

            // Actualizar el estado de la compra
            $compraEstadoModel = new CompraEstadoModel();
            $compraEstadoModel->insert($nuevoEstadoCompra);

            // Llamar al método para devolver el stock de los productos
            $this->devolverStock($idCompra);
        }
    }

    // Método para devolver el stock de los productos
    public function devolverStock($idCompra)
    {
        // Obtener los productos de la compra
        $compraItemModel = new CompraItemModel();
        $cartItems = $compraItemModel->darProductosCompra($idCompra);

        // Instanciar el modelo de productos
        $productModel = new ProductModel();

        // Iterar sobre los productos y devolver el stock
        foreach ($cartItems as $item) {
            $productId = $item['idproducto'];
            $quantityPurchased = $item['cicantidad'];

            // Actualizar el stock del producto (sumar la cantidad comprada)
            $productModel->builder()
                         ->set('procantstock', 'procantstock + ' . $quantityPurchased, false)  // Sumar la cantidad
                         ->where('idproducto', $productId)
                         ->update();
        }
    }

    public function listar()
    {
        $compras = $this->findAll();
        $compraEstadoModel = new CompraEstadoModel();
        $retorno = [];

        foreach ($compras as $compra) {
            // Obtener el estado más reciente de la compra
            $estadoCompraTipo = $compraEstadoModel
                ->where('idcompra', $compra['idcompra'])
                ->join('compraestadotipo', 'compraestado.idcompraestadotipo = compraestadotipo.idcompraestadotipo')
                ->select('compraestado.*, compraestadotipo.cetdescripcion as estado')
                ->orderBy('compraestado.idcompraestado', 'DESC')
                ->first();

            // Verificar que el estado no sea null antes de acceder a sus índices
            if ($estadoCompraTipo && isset($estadoCompraTipo['idcompraestadotipo']) && $estadoCompraTipo['idcompraestadotipo'] != 0) {
                $retorno[] = $estadoCompraTipo;
            }
        }

        return $retorno;
    }
}
