<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Session;

class Autenticacion implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        service('autenticacion');
        $session = new Session();
        $iniciado = $session->validar();
        if(!$iniciado){
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}