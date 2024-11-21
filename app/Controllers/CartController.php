<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class CartController extends Controller
{
    protected $cartModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    /**
     * Mostrar el carrito de compras
     */
    public function index()
    {
        $userId = session()->get('idusuario'); // Obtenemos el ID del usuario de la sesión
    
        // Verificar si el usuario ya tiene un carrito activo
        $purchaseId = $this->cartModel->getActiveCart($userId);
    
        // Si no existe un carrito activo (es decir, si $purchaseId es false),
        // se crea uno nuevo y se guarda en la sesión
        if ($purchaseId === false) {
            $purchaseId = $this->cartModel->createCart($userId);
            session()->set('cart_id', $purchaseId);  // Guardamos el cart_id en la sesión
        } else {
            session()->set('cart_id', $purchaseId);  // Guardamos el cart_id en la sesión si ya existe
        }
    
        // Obtener los productos del carrito
        $cartItems = $this->cartModel->getCartItems($purchaseId);
    
        // Calcular el total del carrito
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item['precioproducto'] * $item['cicantidad'];
        }
    
        // Pasamos los datos a la vista
        return view('shop/cart.php', ['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);
    }
    



    /**
     * Agregar un producto al carrito - ALEXIS
     */
    public function addToCart()
    {
        $userId = session()->get('idusuario');
        $purchaseId = session()->get('cart_id');

        // Si no existe un carrito, lo creamos
        if (!$purchaseId) {
            $purchaseId = $this->cartModel->createCart($userId);
            session()->set('cart_id', $purchaseId);
        }

        // Obtener el ID del producto y la cantidad desde la solicitud
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');

        // Verificar que se recibieron los datos correctamente
        if (!$productId || !$quantity) {
            return $this->response->setJSON(['error' => 'Datos incompletos']);
        }

        // Llamar al modelo para agregar el producto al carrito
        $result = $this->cartModel->addItem($purchaseId, $productId, $quantity);

        // Devolver una respuesta en formato JSON
        if ($result) {
            return $this->response->setJSON(['success' => 'Producto agregado al carrito']);
        } else {
            return $this->response->setJSON(['error' => 'No se pudo agregar el producto al carrito']);
        }
    }


    /**
     * Actualizar la cantidad de un producto en el carrito
     */
    public function updateQuantity()
    {
        $cartItemId = $this->request->getPost('cart_item_id');
        $quantity = $this->request->getPost('quantity');

        // Verificar que se recibieron los datos correctamente
        if (!$cartItemId || !$quantity) {
            return $this->response->setJSON(['error' => 'Datos incompletos']);
        }

        // Llamar al modelo para actualizar la cantidad
        $result = $this->cartModel->updateQuantity($cartItemId, $quantity);

        // Devolver una respuesta en formato JSON
        if ($result) {
            return $this->response->setJSON(['success' => 'Cantidad actualizada']);
        } else {
            return $this->response->setJSON(['error' => 'No se pudo actualizar la cantidad']);
        }
    }

    /**
     * Eliminar un producto del carrito
     */
    public function removeFromCart()
    {
        $cartItemId = $this->request->getPost('cart_item_id');

        // Verificar que se proporcionó el ID del producto
        if (!$cartItemId) {
            return $this->response->setJSON(['error' => 'ID de producto no proporcionado']);
        }

        // Llamar al modelo para eliminar el producto
        $result = $this->cartModel->removeItem($cartItemId);

        // Devolver una respuesta en formato JSON
        if ($result) {
            return $this->response->setJSON(['success' => 'Producto eliminado del carrito']);
        } else {
            return $this->response->setJSON(['error' => 'No se pudo eliminar el producto']);
        }
    }

    /**
     * Confirmar la compra y cambiar el estado de la compra
     */
    public function confirmPurchase()
    {
        $purchaseId = session()->get('cart_id');

        // Verificar que existe un carrito
        if (!$purchaseId) {
            return $this->response->setJSON(['error' => 'No hay carrito asociado']);
        }

        // Cambiar el estado de la compra a "Confirmada"
        $result = $this->cartModel->confirmPurchase($purchaseId);

        // Devolver una respuesta en formato JSON
        if ($result) {
            session()->remove('cart_id'); // Limpiar el carrito actual
            return $this->response->setJSON(['success' => 'Compra confirmada']);
        } else {
            return $this->response->setJSON(['error' => 'No se pudo confirmar la compra']);
        }
    }
}
