<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id'); // Supongamos que tienes el ID del usuario en la sesión
        $cartModel = new CartModel();
        $cartItems = $cartModel->getCartItems($userId);

        $data = [
            'cartItems' => $cartItems
        ];

        return view('shop/cart.php', $data); // Carga la vista del carrito
    }

    public function add($productId)
    {
        $quantity = $this->request->getVar('quantity');
        $userId = session()->get('user_id'); // El ID del usuario debe ser almacenado en sesión

        $cartModel = new CartModel();
        $cartModel->addItem($userId, $productId, $quantity);

        return redirect()->to('/cart'); // Redirige al carrito
    }

    public function update($cartItemId)
    {
        $quantity = $this->request->getVar('quantity');
        $cartModel = new CartModel();
        $cartModel->updateQuantity($cartItemId, $quantity);

        return redirect()->to('/cart');
    }

    public function remove($cartItemId)
    {
        $cartModel = new CartModel();
        $cartModel->removeItem($cartItemId);

        return redirect()->to('/cart');
    }
}
