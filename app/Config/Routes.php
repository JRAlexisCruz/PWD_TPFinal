<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


/* PRODUCTOS */
$routes->get('/products', 'ProductController::listar');
$routes->get('products/load', 'ProductController::load');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/create', 'ProductController::create');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->get('/products/delete/(:num)', 'ProductsController::delete/$1');

/* LOGIN */
$routes->get('/login', 'Session::login');
$routes->post('/login', 'Session::autenticar');
$routes->get('/logout', 'Session::cerrar');

/* REGISTRO */
$routes->get('/registro','Session::registro');
$routes->post('/registro','Session::registrar');

/* HOME PRUEBA */
$routes->get('/home', 'Session::index');

/*ADMIN USUARIOS */
/*$routes->get('usuarios', 'UsuarioController::administrar', ['filter' => 'autenticacion']);
$routes->get('usuarios/listar', 'UsuarioController::listar');
$routes->post('usuarios/editar', 'UsuarioController::editar');
$routes->post('usuarios/crear', 'UsuarioController::crear');
$routes->post('usuarios/eliminar', 'UsuarioController::eliminar');*/
$routes->group('admin',['filter'=>'autenticacion'],function($routes){
    $routes->group('usuarios',function($routes){
        $routes->get('/', 'UsuarioController::administrar');
        $routes->get('listar', 'UsuarioController::listar');
        $routes->post('editar', 'UsuarioController::editar');
        $routes->post('crear', 'UsuarioController::crear');
        $routes->post('eliminar', 'UsuarioController::eliminar');
    });
});
