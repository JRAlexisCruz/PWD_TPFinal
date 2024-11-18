<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Session extends BaseController{

    protected $helpers = ['form'];
    public function index(){
        $iniciado = $this->validar();
        if($iniciado){
            return view('home_prueba_seguro');
        }else{
            return view('home_prueba_no_seguro');
        }
    }

    public function login(){
        return view('login/index.php');
    }

    public function autenticar(){
        $data = $this->request->getPost(['usnombre','uspass']);

        $usuarioModelo = new UsuarioModel();
        $usuario = $usuarioModelo->where(['usnombre'=>$data['usnombre'],'uspass'=>$data['uspass']])->first();
        if($usuario){
            $this->session->set('idusuario',$usuario['idusuario']);
            return redirect()->to(base_url('home')); //Cambiar por pagina principal
        }else{
            return redirect()->back()->withInput()->with('error','Usuario o contraseña incorrectos');
        }
    }

    public function activa(){
        $resp = false;
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                $resp = session_id() === '' ? FALSE : TRUE;
            }
        }
        return $resp;
    }

    public function validar(){
        $activo = false;
        if($this->activa() && $this->session->has('idusuario')){
            $activo = true;
        }
        return $activo;
    }

    public function registro(){
        return view('registro/index.php');
    }

    public function registrar(){
        $data = $this->request->getPost(['usnombre','uspass','usmail']);
        
        $usuarioModelo = new UsuarioModel();
        $usuario = $usuarioModelo->where(['usnombre'=>$data['usnombre']])->first();
        if($usuario){
            return redirect()->back()->withInput()->with('error','El nombre de usuario ya existe');
        }else{
            $idusuario=$usuarioModelo->insert($data);
            $this->session->set('idusuario',$idusuario);
            return redirect()->to(base_url('home')); //Cambiar por pagina principal
        }
    }

    public function cerrar(){
        $this->session->destroy();
        return redirect()->to(base_url('home')); //Cambiar por pagina principal
    }
}