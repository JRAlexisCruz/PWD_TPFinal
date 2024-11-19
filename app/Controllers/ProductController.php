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

    public function administrar(){
        return view('abm/abmProductos');
    }

    public function list(){
        $products = $this->productModel->findAll();
        echo json_encode($products);
    }

    public function editar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idproducto'])){
            $id = $data['idproducto'];
            $producto = $this->productModel->find($id);
            if($producto){
                if($this->productModel->update($id, $data)){
                    $retorno['success'] = true;
                }else{
                    $retorno['errorMsg'] = 'Error al editar el producto';
                }
            }else{
                $retorno['errorMsg'] = 'Producto no encontrado';
            }
        }
        echo json_encode($retorno);
    }

    public function crear(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if($this->productModel->insert($data)){
            $retorno['success'] = true;
        }else{
            $retorno['errorMsg'] = 'Error al crear el usuario';
        }
        echo json_encode($retorno);
    }

    public function eliminar(){
        $data = $this->request->getPost();
        $retorno= ['success' => false];
        if(isset($data['idproducto'])){
            $id = $data['idproducto'];
            $producto = $this->productModel->find($id);
            if($producto){
                $this->productModel->delete($id);
                $retorno['success'] = true;
            }else{
                $retorno['errorMsg'] = 'Producto no encontrado'; 
            }
        }
        echo json_encode($retorno);
    }
}
