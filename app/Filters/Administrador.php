<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Administrador implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $esAdmin=false;
        $session=session();
        if($session->has('rol') && $session->rol==1){
            $esAdmin=true;
        }
        if(!$esAdmin){
            return redirect()->to(base_url('home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}