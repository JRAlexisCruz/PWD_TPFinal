<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'idmenu';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idmenu', 'menombre', 'medescripcion', 'medeshabilitado','idpadre'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = 'medeshabilitado';

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function listar(){
        $menus = $this->withDeleted()->findAll();
        $aux = [];
        foreach($menus as $menu){
            if($menu['idpadre'] != null){
                $menuPadre = $this->find($menu['idpadre']);
                $menu['menupadre'] = $menuPadre['menombre'];
            }
            $aux[] = $menu;
        }
        return $aux;
    }

    public function eliminar($idMenu){
        $eliminado=false;
        $esPadre=$this->where('idpadre',$idMenu)->first();
        if($esPadre!=null){
            $this->delete($idMenu);
            $eliminado=true;
        }
        return $eliminado;
    }

}