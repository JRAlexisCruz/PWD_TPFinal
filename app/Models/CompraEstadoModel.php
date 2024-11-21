<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CompraModel;

class CompraEstadoModel extends Model
{
    protected $table = 'compraestado';
    protected $primaryKey = 'idcompraestado';
    protected $allowedFields = ['idcompra', 'idcompraestadotipo', 'cefechaini', 'cefechafin'];

    protected $error='';

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

    public function actualizar($idCompra){
        $compraModel= new CompraModel();
        $compra=$compraModel->find($idCompra);
        $actualizado = false;
        if($compra){
            $ultimoEstadoCompra=$this->where('idcompra', $idCompra)
                 ->orderBy('idcompraestado', 'DESC')
                 ->first();
            $idUltimoEstadoCompra = $ultimoEstadoCompra['idcompraestadotipo'];
            $finalizar=['cefechafin'=>date('Y-m-d H:i:s')];
            $this->update($idUltimoEstadoCompra, $finalizar);
            $ultimoEstado = $ultimoEstadoCompra['idcompraestadotipo'];
            $data['idcompra']=$idCompra;
            $data['idcompraestadotipo']=$ultimoEstado+1;
            $data['cefechaini']=date('Y-m-d H:i:s');
            if($idUltimoEstadoCompra==5){
                $data['cefechafin']=date('Y-m-d H:i:s');
            }
            if($this->insert($data)){
                $actualizado = true;
            }else{
                $this->error = 'Error al actualizar el estado de la compra';
            }
        }else{
            $this->error = 'Compra no encontrada';
        }
        return $actualizado;
    }

    public function cancelar($idCompra){
        $compraModel= new CompraModel();
        $compra=$compraModel->find($idCompra);
        $actualizado = false;
        if($compra){
            $ultimoEstadoCompra=$this->where('idcompra', $idCompra)
                 ->orderBy('idcompraestado', 'DESC')
                 ->first();
            $idUltimoEstadoCompra = $ultimoEstadoCompra['idcompraestadotipo'];
            $finalizar=['cefechafin'=>date('Y-m-d H:i:s')];
            $this->update($idUltimoEstadoCompra, $finalizar);
            $data['idcompra']=$idCompra;
            $data['idcompraestadotipo']=6;
            $data['cefechaini']=date('Y-m-d H:i:s');
            $data['cefechafin']=date('Y-m-d H:i:s');
            if($this->insert($data)){
                $actualizado = true;
            }else{
                $this->error = 'Error al cancelar la compra';
            }
        }else{
            $this->error = 'Compra no encontrada';
        }
        return $actualizado;
    }

    public function getError(){
        return $this->error;
    }
}