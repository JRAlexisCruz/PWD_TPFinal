<?php

namespace App\Models;

use CodeIgniter\Model;

class CompraEstadoModel extends Model
{
    protected $table = 'compraestado';
    protected $primaryKey = 'idcompraestado';
    protected $allowedFields = ['idcompra', 'idcompraestadotipo', 'cefechaini', 'cefechafin'];

    /**
     * Obtener todos los estados de una compra específica
     *
     * @param int $purchaseId
     * @return array|null
     */
    public function getEstadosByCompra($purchaseId)
    {
        return $this->where('idcompra', $purchaseId)
                    ->join('compraestadotipo', 'compraestado.idcompraestadotipo = compraestadotipo.idcompraestadotipo')
                    ->select('compraestado.*, compraestadotipo.cetdescripcion')
                    ->orderBy('cefechaini', 'DESC')
                    ->findAll();
    }

    /**
     * Finalizar el estado anterior y asignar un nuevo estado
     *
     * @param int $idcompra
     * @param int $idcompraestadotipo
     * @return bool
     */
    public function actualizarEstado($idcompra, $idcompraestadotipo)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('compraestado');

        // Finalizar estado anterior
        $builder->where('idcompra', $idcompra)
                ->where('cefechafin IS NULL')
                ->update(['cefechafin' => date('Y-m-d H:i:s')]);

        // Crear el nuevo estado
        return $this->insert([
            'idcompra'            => $idcompra,
            'idcompraestadotipo'  => $idcompraestadotipo,
            'cefechaini'          => date('Y-m-d H:i:s'),
        ]);
    }
}