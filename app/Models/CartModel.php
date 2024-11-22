<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = 'compraitem'; // Tabla que guarda los items del carrito
    protected $primaryKey = 'idcompraitem';
    protected $allowedFields = ['idcompra', 'idproducto', 'cicantidad'];

    /**
     * Obtener los items del carrito de una compra (idCompra).
     *
     * @param int $idCompra
     * @return array
     */
    public function getCartItems($idCompra)
    {
        return $this->db->table('compraitem')
            ->select('compraitem.*, producto.pronombre, producto.precioproducto, producto.proimagen, producto.procantstock')
            ->join('producto', 'compraitem.idproducto = producto.idproducto')
            ->where('compraitem.idcompra', $idCompra)
            ->get()
            ->getResultArray();
    }

    /**
     * Agregar un producto al carrito de compras.
     *
     * @param int $idCompra
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function addItem($idCompra, $productId, $quantity)
    {
        // Verifica si el producto ya está en el carrito
        $existingItem = $this->where(['idcompra' => $idCompra, 'idproducto' => $productId])->first();

        if ($existingItem) {
            // Si el producto ya está en el carrito, actualiza la cantidad
            $newQuantity = $existingItem['cicantidad'] + $quantity;

            // Verificar si la nueva cantidad no supera el stock
            // $stock = $this->db->table('producto')->select('procantstock')->where('idproducto', $productId)->get()->getRow()->procantstock;
            // if ($newQuantity > $stock) {
            //     return false; // No se puede agregar más de lo disponible
            // }

            // Verificar si la nueva cantidad no supera el stock
            $product = $this->db->table('producto')->select('procantstock')->where('idproducto', $productId)->get()->getRow();
            if ($product && $newQuantity > $product->procantstock) {
                return false; // No se puede agregar más de lo disponible
            }


            // Si la cantidad es válida, actualiza el carrito
            return $this->update($existingItem['idcompraitem'], ['cicantidad' => $newQuantity]);
        } else {
            // Si el producto no está en el carrito, agrégalo
            return $this->insert([
                'idcompra'   => $idCompra,
                'idproducto' => $productId,
                'cicantidad' => $quantity
            ]);
        }
    }

    /**
     * Actualizar la cantidad de un producto en el carrito.
     *
     * @param int $cartItemId
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity($cartItemId, $quantity)
    {
        // Verificar que la cantidad no exceda el stock disponible
        $item = $this->find($cartItemId);
        $stock = $this->db->table('producto')->select('procantstock')->where('idproducto', $item['idproducto'])->get()->getRow()->procantstock;

        if ($quantity > $stock) {
            return false; // No se puede actualizar más de lo disponible
        }

        // Actualiza la cantidad
        return $this->update($cartItemId, ['cicantidad' => $quantity]);
    }


    /**
     * Eliminar un producto del carrito de compras.
     *
     * @param int $cartItemId
     * @param int $cartId
     * @return bool
     */
    public function removeItem($cartItemId, $cartId)
    {
        $result = false; // Inicializar la variable de retorno

        // Verificar que el item pertenece al carrito correcto
        $item = $this->where(['idcompraitem' => $cartItemId, 'idcompra' => $cartId])->first();

        if ($item) {
            // Intentar eliminar el artículo
            $result = $this->delete($cartItemId);
        }

        return $result; // Retornar el resultado
    }


    /**
     * Crear un carrito de compras para un usuario.
     * Se crea una nueva compra en la tabla `compra` y un estado inicial en `compraestado`.
     *
     * @param int $userId
     * @return int $compraId
     */
    public function createCart($userId)
    {
        // Inserta la compra en la tabla `compra` con estado inicial
        $compraData = [
            'idusuario' => $userId
        ];

        $this->db->table('compra')->insert($compraData);
        $compraId = $this->db->insertID(); // Obtener el ID de la nueva compra insertada

        // Insertar el estado inicial de la compra en la tabla `compraestado`
        $this->db->table('compraestado')->insert([
            'idcompra' => $compraId,
            'idcompraestadotipo' => 0, // Ingresado al carrito
            'cefechaini' => date('Y-m-d H:i:s')
        ]);

        return $compraId; // Retorna el ID de la compra creada
    }


    // Función para obtener el carrito activo de un usuario
    public function getActiveCart($userId)
    {
        // Inicializar la variable que almacenará el ID de la compra
        $purchaseId = false;

        // Buscar una compra activa para el usuario, con el estado "Ingresado al carrito"
        $purchase = $this->db->table('compra')
            ->join('compraestado', 'compra.idcompra = compraestado.idcompra')
            ->where('compra.idusuario', $userId)
            ->orderBy('compraestado.idcompraestado', 'DESC') // Ordenar por el ID más alto
            ->limit(1) // Limitar a una sola fila, la más reciente
            ->get()
            ->getRowArray();

        // Verificar que la compra encontrada tenga el estado "Ingresado al carrito"
        if ($purchase != null && $purchase['idcompraestadotipo'] == 0) {
            // Si el estado es "Ingresado al carrito" (idcompraestadotipo == 0), almacenar su ID
            $purchaseId = $purchase['idcompra'];
        }

        // Devolver el ID de la compra o false si no se encuentra el estado adecuado
        return $purchaseId;
    }
}
