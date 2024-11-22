<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cliente implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $esCliente=false;
        $session=session();
        if($session->has('rol') && $session->rol==3){
            $esCliente=true;
        }
        if(!$esCliente){
            return redirect()->to(base_url('404'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}