<?php

namespace App\Controllers;
use App\Models\MenuModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function nosotros() {
        return view('estructura/nosotros.php');
    }

    public function admin(){
        $menuModel=new MenuModel();
        $rol=session('rol');
        $menus=$menuModel->darMenusRol($rol);
        return view('privado/menuadmin',["menus"=>$menus]);
    }

    public function notFound(){
        return view('estructura/not_found');
    }
}
