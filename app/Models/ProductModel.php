<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'idproducto';
    protected $returnType = 'array';
    protected $allowedFields = ['idproducto','pronombre', 'tipoproducto', 'prodetalle', 'precioproducto', 'procantstock', 'proimagen'];


    public function getAllProducts()
    {
        // Construcción de la consulta para obtener todos los productos
        $builder = $this->builder();

        // Obtener todos los productos sin filtros
        $products = $builder->get()->getResultArray();

        return $products;
    }


    public function countProducts($type = 'all', $search = '')
    {
        $builder = $this->builder();

        if ($type !== 'all') {
            $builder->where('tipoproducto', $type);
        }

        if (!empty($search)) {
            $builder->like('pronombre', $search);
        }

        return $builder->countAllResults();
    }


    // Método para encontrar un producto por su ID
    public function findProductById($id)
    {
        return $this->where('idproducto', $id)->first();
    }
}
