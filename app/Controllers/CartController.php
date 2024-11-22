<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\CompraEstadoModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class CartController extends Controller
{
    protected $cartModel;
    protected $productModel;
    protected $compraEstadoModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->compraEstadoModel = new CompraEstadoModel();
        $this->usuarioModel = new UsuarioModel();
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
     * Agregar un producto al carrito
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
        // Obtener los datos del POST
        $cartItemId = $this->request->getJSON(true)['cartItemId'];

        $cartId = session()->get('cart_id'); // Obtener el ID del carrito desde la sesión

        // Inicializar la respuesta con un mensaje de error por defecto
        $response = ['error' => 'No se pudo eliminar el producto'];

        // Verificar si el cartItemId y el cartId existen
        if (!$cartItemId) {
            $response = ['error' => 'ID de producto no proporcionado'];
        } elseif (!$cartId) {
            $response = ['error' => 'ID de carrito no proporcionado'];
        } else {
            // Si ambos valores existen, intentamos eliminar el producto
            $result = $this->cartModel->removeItem($cartItemId, $cartId);

            // Verificar si la eliminación fue exitosa
            if ($result) {
                $response = ['success' => 'Producto eliminado del carrito'];
            } else {
                $response = ['error' => 'No se pudo eliminar el producto'];
            }
        }

        return $this->response->setJSON($response);
    }



    /**
     * Confirmar la compra y cambiar el estado de la compra
     */
    public function confirmPurchase()
    {
        $purchaseId = session()->get('cart_id');
        $userId = session()->get('idusuario'); // Obtenemos el ID del usuario de la sesión

        $response = ['error' => 'No se pudo confirmar la compra']; // Valor predeterminado

        // Verificar que existe un carrito
        if ($purchaseId) {
            // Cambiar el estado de la compra a "Confirmada"
            $result = $this->compraEstadoModel->actualizar($purchaseId);

            if ($result) {
                // Obtener el correo del usuario usando su ID
                $user = $this->usuarioModel->find($userId);  // Buscar el usuario por su ID

                if ($user && isset($user['usmail'])) {
                    $userEmail = $user['usmail'];  // Obtenemos el correo del usuario
                    // Enviar el correo de confirmación
                    $this->sendConfirmationEmail($userEmail);
                }

                session()->remove('cart_id'); // Limpiar el carrito actual

                $response = ['success' => 'Compra confirmada']; // Se actualiza si la compra se confirma exitosamente
            }
        }

        return $this->response->setJSON($response); // Retorna la respuesta al final
    }



    /**
     * Enviar correo de confirmación
     */
    public function sendConfirmationEmail($userEmail)
    {
        // Obtener la configuración de correo desde el archivo Email.php
        $emailConfig = config('Email');

        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        $fromEmail= 'cebandohistorias@gmail.com';
        $fromName = "Cebando Historias";

        // Configurar los parámetros del correo usando la configuración de Email.php . PROBAR HARCODEAR
        // $email->setFrom($emailConfig->$fromEmail, $emailConfig->$fromName);
        // $email->setTo($userEmail);
        // Configurar los parámetros del correo usando la configuración de Email.php
        $email->setTo($userEmail);
        $email->setSubject('Compra Confirmada');
        $email->setMessage('¡Tu compra ha sido confirmada! Gracias por tu compra. Nos estamos preparando para enviarlo.');

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }
}
