<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = 'compraitem'; // Tabla que guarda los items del carrito
    protected $primaryKey = 'idcompraitem';
    protected $allowedFields = ['idcompra', 'idproducto', 'cicantidad'];

    public function getCartItems($userId)
    {
        return $this->db->table('compraitem')
                        ->join('producto', 'compraitem.idproducto = producto.idproducto')
                        ->where('compraitem.idcompra', $userId) // Asumimos que el carrito está relacionado al usuario
                        ->get()->getResultArray();
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        return $this->update($cartItemId, ['cicantidad' => $quantity]);
    }

    public function removeItem($cartItemId)
    {
        return $this->delete($cartItemId);
    }

    public function addItem($userId, $productId, $quantity)
    {
        // Verifica si ya existe el producto en el carrito
        $existingItem = $this->where(['idcompra' => $userId, 'idproducto' => $productId])->first();
        if ($existingItem) {
            // Si existe, actualiza la cantidad
            return $this->update($existingItem['idcompraitem'], ['cicantidad' => $existingItem['cicantidad'] + $quantity]);
        } else {
            // Si no existe, agrega el nuevo producto
            return $this->insert(['idcompra' => $userId, 'idproducto' => $productId, 'cicantidad' => $quantity]);
        }
    }
}
