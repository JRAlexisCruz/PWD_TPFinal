<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MenuRolModel;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'idmenu';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idmenu', 'menombre', 'medescripcion', 'medeshabilitado','script'];

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

    protected $error='';

    public function getError(){
        return $this->error;
    }

    public function darNombreRoles($idmenu){
        $roles = [];
        $menuRolModel = new MenuRolModel();
        $rolesMenu = $menuRolModel->where('idmenu', $idmenu)->findAll();
        if(count($rolesMenu) != 0){
            $rolModel = new RolModel();
            foreach($rolesMenu as $rolMenu){
                $rol = $rolModel->find($rolMenu['idrol']);
                if($rol){
                    $roles[] = $rol['rodescripcion'];
                }
            }
        }
        return $roles;
    }

    public function darMenusRol($idrol){
        $menus = [];
        $menuRolModel = new MenuRolModel();
        $rolesMenu = $menuRolModel->where('idrol', $idrol)->findAll();
        if(count($rolesMenu) != 0){
            foreach($rolesMenu as $rolMenu){
                $menu = $this->find($rolMenu['idmenu']);
                if($menu){
                    $menus[] = $menu;
                }
            }
        }
        return $menus;
    }

    public function listar(){
        $menus = $this->withDeleted()->findAll();
        $aux = [];
        foreach($menus as $menu){
            $roles = $this->darNombreRoles($menu['idmenu']);
            $menu['roles'] = $roles;
            $aux[] = $menu;
        }
        return $aux;
    }

    public function eliminar($idMenu){
        $eliminado=false;
        $menu=$this->find($idMenu);
        if($menu){
            if($this->delete($idMenu)){
                $eliminado=true;
            }else{
                $this->error='Error al eliminar el menu';
            }
        }else{
            $this->error='Menu no encontrado';
        }
        return $eliminado;
    }

    public function insertar($data){
        $insertado=false;
        $nuevoMenu=[
            "menombre"=>$data['menombre'],
            "medescripcion"=>$data['medescripcion'],
            "script"=>$data['script']
        ];
        if($this->insert($nuevoMenu)){
            $idMenu = $this->getInsertID();
            $insertado=true;
            if(array_key_exists('roles', $data)){
                $roles=$data['roles'];
                $menuRolModel=new MenuRolModel();
                foreach($roles as $rol){
                    $menuRolModel->insert(['idmenu'=>$idMenu,'idrol'=>$rol]);
                }
            }
        }else{
            $this->error='Error al insertar el menu';
        }
        return $insertado;
    }

    public function editar($data){
        $editado=false;
        $nuevoMenu=[
            "menombre"=>$data['menombre'],
            "medescripcion"=>$data['medescripcion'],
            "script"=>$data['script']
        ];
        $idmenu=$data['idmenu'];
        $menu=$this->find($idmenu);
        if($menu){
            if($this->update($idmenu,$nuevoMenu)){
                $editado=true;
                if(array_key_exists('roles', $data)){
                    $rolesMenu=$data['roles'];
                    $rolModel=new RolModel();
                    $roles=$rolModel->findAll();
                    $menuRolModel=new MenuRolModel();
                    foreach($roles as $rol){
                        $cargado = $menuRolModel->where('idmenu', $idmenu)->where('idrol', $rol['idrol'])->first();
                        if(in_array($rol['idrol'], $rolesMenu)){
                            if(!isset($cargado)){
                                $menuRolModel->insert(['idmenu' => $idmenu, 'idrol' => $rol['idrol']]);
                            }
                        }else{
                            if(isset($cargado)){
                                $menuRolModel->where('idmenu', $idmenu)->where('idrol', $rol['idrol'])->delete();
                            }
                        }
                    }
                }else{
                    $menuRolModel = new MenuRolModel();
                    $menuRolModel->where('idmenu', $idmenu)->delete();
                }
            }else{
                $this->error='Error al editar el menu';
            }
        }else{
            $this->error='Menu no encontrado';
        }
        
        return $editado;
    }

}