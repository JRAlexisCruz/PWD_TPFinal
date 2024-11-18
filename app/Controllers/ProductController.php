<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\CLI\Console;

class ProductController extends BaseController
{  
    protected $productModel;

    public function __construct()
    {
        // Cargar el modelo
        $this->productModel = new ProductModel();
    }


    // Método para listar los productos
    public function listar()
    {
        $products = $this->productModel->findAll(); // Obtener todos los productos
        return view('products/products.php', ['products' => $products]);
    }


    // Método para agregar un nuevo producto
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'pronombre'     => $this->request->getPost('pronombre'),
                'tipoproducto'  => $this->request->getPost('tipoproducto'),
                'prodetalle'    => $this->request->getPost('prodetalle'),
                'precioproducto' => $this->request->getPost('precioproducto'),
                'procantstock'  => $this->request->getPost('procantstock'),
            ];

            // Validar y guardar el producto
            if ($this->productModel->save($data)) {
                return redirect()->to('/products')->with('success', 'Producto creado exitosamente.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Error al crear el producto.');
            }
        }

        return view('products/create');
    }

    // Método para editar un producto
    public function edit($id)
    {
        $producto = $this->productModel->find($id);
        if (!$producto) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Producto no encontrado');
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                'pronombre'     => $this->request->getPost('pronombre'),
                'tipoproducto'  => $this->request->getPost('tipoproducto'),
                'prodetalle'    => $this->request->getPost('prodetalle'),
                'precioproducto' => $this->request->getPost('precioproducto'),
                'procantstock'  => $this->request->getPost('procantstock'),
            ];

            if ($this->productModel->update($id, $data)) {
                return redirect()->to('/products')->with('success', 'Producto actualizado exitosamente.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Error al actualizar el producto.');
            }
        }

        return view('products/edit', ['producto' => $producto]);
    }

    // Método para eliminar un producto
    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Producto eliminado exitosamente.');
    }


     // Método para mostrar los detalles del producto
    public function detail($id)
    {
        // Crear una instancia del modelo para los productos
        $productModel = new ProductModel();
        
        // Buscar el producto por el ID
        $product = $productModel->findProductById($id); // Usamos el nuevo método

        // Verificar si el producto existe
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Producto no encontrado");
        }

        // Pasar los datos del producto a la vista
        return view('products/detailProduct.php', ['product' => $product]);
    }
}
