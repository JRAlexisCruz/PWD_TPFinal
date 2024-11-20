<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Session extends BaseController{

    protected $helpers = ['form'];
    public function index(){
        return view('estructura/home');
    }

    public function login(){
        if($this->validar()){
            return redirect()->to(base_url('logout'));
        }else{
            return view('login/index.php');
        }
    }

    public function logout(){
        if($this->validar()){
            return view('login/logout.php');
        }else{
            return redirect()->to(base_url('home'));
        }
    }

    public function autenticar(){
        $data = $this->request->getPost(['usnombre','uspass']);

        $usuarioModelo = new UsuarioModel();
        $usuario = $usuarioModelo->where(['usnombre'=>$data['usnombre'],'uspass'=>$data['uspass']])->first();
        if($usuario){
            $roles=$usuarioModelo->darRoles($usuario['idusuario']);
            $this->session->set('idusuario',$usuario['idusuario']);
            $this->session->set('roles',$roles);
            $this->session->set('rol',$roles[0]);
            $_COOKIE['usnombre']=$usuario['usnombre'];
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
        $session = session();
        if($session->get('idusuario') && $this->activa()){
            $activo = true;
        }
        return $activo;
    }

    public function registro(){
        if($this->validar()){
            return redirect()->to(base_url('logout'));
        }else{
            return view('registro/index.php');
        }
    }

    public function registrar(){
        $data = $this->request->getPost(['usnombre','uspass','usmail']);
        $usuarioModelo = new UsuarioModel();
        $usuario = $usuarioModelo->where(['usnombre'=>$data['usnombre']])->first();
        if($usuario){
            return redirect()->back()->withInput()->with('error','El nombre de usuario ya existe');
        }else{
            $usuarioModelo->insertar($data);
            $idusuario = $usuarioModelo->getInsertID();
            $this->session->set('idusuario',$idusuario);
            $this->session->set('rol','usuario');
            return redirect()->to(base_url('home')); //Cambiar por pagina principal
        }
    }

    public function cerrar(){
        $this->session->destroy();
        return redirect()->to(base_url('home')); //Cambiar por pagina principal
    }
}