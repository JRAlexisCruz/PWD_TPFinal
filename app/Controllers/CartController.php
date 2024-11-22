<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\CompraEstadoModel;
use App\Models\UsuarioModel;
use Dompdf\Dompdf;
use Dompdf\Options;
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
            // Crear un nuevo carrito y guardarlo en la sesión
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
                // Obtener los productos del carrito
                $cartItems = $this->cartModel->getCartItems($purchaseId);

                // Actualizar el stock de los productos
                foreach ($cartItems as $item) {
                    $productId = $item['idproducto'];
                    $quantityPurchased = $item['cicantidad'];

                    // Obtener el producto desde el modelo ProductModel
                    $product = $this->productModel->findProductById($productId);

                    // Verificar si el producto existe y si hay stock suficiente
                    if ($product && $product['procantstock'] >= $quantityPurchased) {
                        // Llamar al método updateStock para actualizar el stock del producto
                        $this->productModel->updateStock($productId, $quantityPurchased);
                    } else {
                        // Si no hay stock suficiente, devolver un error
                        return $this->response->setJSON(['error' => 'No hay suficiente stock para completar la compra']);
                    }
                }

                // Obtener el correo del usuario usando su ID
                $user = $this->usuarioModel->find($userId);  // Buscar el usuario por su ID

                if ($user && isset($user['usmail'])) {
                    $userEmail = $user['usmail'];  // Obtenemos el correo del usuario

                    // Generar datos de la factura (reemplaza por tu lógica de obtención de datos)
                    $invoiceData = [
                        'purchaseId' => $purchaseId,
                        'user' => $user,
                        'items' => $cartItems,
                        'total' => array_reduce(
                            $cartItems,
                            fn($carry, $item) => $carry + ($item['precioproducto'] * $item['cicantidad']),
                            0
                        ),
                    ];

                    // Generar la factura
                    $invoicePath = $this->sendInvoice($invoiceData);

                    // Enviar el correo de confirmación con la factura adjunta
                    $this->sendConfirmationEmail($userEmail, $invoicePath);
                }

                session()->remove('cart_id'); // Limpiar el carrito actual
                $response = ['success' => 'Compra confirmada']; // Se actualiza si la compra se confirma exitosamente
            }
        }

        return $this->response->setJSON($response); // Retorna la respuesta al final
    }



    public function sendInvoice($invoiceData)
    {
        // Obtener los productos y datos del carrito
        $purchaseId = session()->get('cart_id');
        $cartItems = $this->cartModel->getCartItems($purchaseId);

        // Obtener los datos del cliente
        $userId = session()->get('idusuario');  // Obtener ID de usuario desde la sesión
        $user = $this->usuarioModel->find($userId);  // Obtener datos del cliente

        // Crear los datos para la factura
        $productos = [];
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $totalProducto = $item['cicantidad'] * $item['precioproducto'];
            $subtotal += $totalProducto;
            $productos[] = [
                "precio" => $item['precioproducto'],
                "descripcion" => $item['pronombre'],
                "cantidad" => $item['cicantidad'],
            ];
        }

        // Cálculos adicionales
        $descuento = 0;  // Si hay descuento, puedes calcularlo aquí
        $porcentajeImpuestos = 0;  // Impuesto ahora es 0
        $subtotalConDescuento = $subtotal - $descuento;
        $impuestos = 0;  // Impuestos es 0
        $total = $subtotalConDescuento + $impuestos;  // Total no se modifica con impuestos
        $remitente = "# Cebando Historias";
        $fecha = date("Y-m-d");
        $numero = rand(1000, 9999);
        $web = 'https://cebandohistorias.com.ar';
        $cliente = $user['usnombre'];  // Nombre del cliente
        $mensajePie = "Muchas gracias por su compra y por confiar en nuestros productos.";

        // Pasar los datos a la vista
        $data = [
            'cliente' => $cliente,
            'remitente' => $remitente,
            'productos' => $productos,
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'impuestos' => $impuestos,
            'total' => $total,
            'fecha' => $fecha,
            'numero' => $numero,
            'web' => $web,
            'subtotalConDescuento' => $subtotalConDescuento,
            'mensajePie' => $mensajePie
        ];

        // Generar el HTML para la factura
        $html = view('templates/invoice', $data);  // Pasar los datos a la vista

        // Configurar Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        // Cargar el contenido HTML
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Guardar el PDF en un archivo temporal
        $output = $dompdf->output();
        $filePath = WRITEPATH . 'uploads/factura_' . $invoiceData['purchaseId'] . '.pdf';
        file_put_contents($filePath, $output);

        return $filePath; // Retornamos el path del archivo generado
    }



    public function sendConfirmationEmail($userEmail, $invoicePath)
    {
        // Crear una instancia del servicio de correo de CodeIgniter
        $email = \Config\Services::email();

        $fromEmail = 'cebandohistorias@gmail.com';
        $fromName = "Cebando Historias";

        // Configurar los parámetros del correo
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($userEmail);
        $email->setSubject('Compra Confirmada');
        $email->setMessage('¡Tu compra ha sido confirmada! Gracias por tu compra. Adjunto a este mail encontrarás la factura para descargar.');

        // Adjuntar la factura generada
        $email->attach($invoicePath);

        $emailSent = false; // Variable para indicar si el correo fue enviado con éxito

        // Enviar el correo y manejar el resultado
        if ($email->send()) {
            $emailSent = true;

            // Eliminar el archivo temporal
            unlink($invoicePath);
        } else {
            log_message('error', 'Error al enviar el correo: ' . $email->printDebugger());
        }

        return $emailSent; // Retorna el resultado al final de la función
    }
}
