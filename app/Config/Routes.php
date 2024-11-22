<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/* PRODUCTOS */
$routes->group('products', function($routes) {
    $routes->get('/', 'ProductController::listar');
    $routes->get('/detail/(:num)', 'ProductController::detail/$1');
});


/* CARRITO DE COMPRAS */
$routes->group('cart', ['filter' => 'autenticacion'], function($routes) {
    $routes->get('/', 'CartController::index');
    $routes->post('addToCart', 'CartController::addToCart');
    $routes->post('removeFromCart', 'CartController::removeFromCart');
    $routes->post('updateQuantity', 'CartController::updateQuantity'); 
    $routes->post('confirmPurchase', 'CartController::confirmPurchase');
});



/* LOGIN */
$routes->get('/login', 'Session::login');
$routes->post('/login', 'Session::autenticar');

/* REGISTRO */
$routes->get('/registro','Session::registro');
$routes->post('/registro','Session::registrar');

/* HOME */
$routes->get('/home', 'Session::index');
$routes->get('/nosotros', 'Home::nosotros');

/* NOT_FOUND */
$routes->get('/404', 'Home::notFound');

/* CAMBIO ROL */
$routes->get('/cambioRol', 'Session::cambioRol', ['filter'=>'multirol']);

/* OPCIONES CLIENTE */
$routes->get('/perfil/editar', 'UsuarioController::editarPerfil', ['filter'=>'autenticacion']);
$routes->post('/perfil/editar', 'UsuarioController::modificar', ['filter'=>'autenticacion']);
$routes->get('/perfil/buscar', 'UsuarioController::buscar', ['filter'=>'autenticacion']);
$routes->post('/perfil/verificar', 'UsuarioController::verificar', ['filter'=>'autenticacion']);
$routes->get('/perfil/compras', 'CompraController::compras', ['filter'=>'autenticacion']);
$routes->get('/perfil/compras/listarCompras', 'CompraController::listarCompras', ['filter'=>'autenticacion']);
$routes->post('/perfil/compras/cancelar', 'CompraController::cancelar', ['filter'=>'autenticacion']);
$routes->get('/logout', 'Session::logout');
$routes->get('/cerrarsesion', 'Session::cerrar');

/*ADMIN*/
$routes->group('admin',['filter'=>['autenticacion','admindeposito']], function($routes){
    $routes->get('/', 'Home::admin');
    /* ADMIN USUARIOS */
    $routes->group('usuarios', ['filter'=>'administrador'], function($routes){
        $routes->get('/', 'UsuarioController::administrar');
        $routes->get('listar', 'UsuarioController::listar');
        $routes->post('editar', 'UsuarioController::editar');
        $routes->post('crear', 'UsuarioController::crear');
        $routes->post('eliminar', 'UsuarioController::eliminar');
    });

    /* ADMIN PRODUCTOS */
    $routes->group('productos', ['filter'=>'admindeposito'] ,function($routes){
        $routes->get('/', 'ProductController::administrar');
        $routes->get('listar', 'ProductController::list');
        $routes->post('editar', 'ProductController::editar');
        $routes->post('crear', 'ProductController::crear');
        $routes->post('eliminar', 'ProductController::eliminar');
    });

    /* ADMIN ROLES */
    $routes->group('roles', ['filter'=>'administrador'], function($routes){
        $routes->get('/', 'RolController::administrar');
        $routes->get('listar', 'RolController::listar');
        $routes->post('editar', 'RolController::editar');
        $routes->post('crear', 'RolController::crear');
        $routes->post('eliminar', 'RolController::eliminar');
    });

    /* ADMIN MENUS */
    $routes->group('menus', ['filter'=>'administrador'], function($routes){
        $routes->get('/', 'MenuController::administrar');
        $routes->get('listar', 'MenuController::listar');
        $routes->post('listar', 'MenuController::listar');
        $routes->post('editar', 'MenuController::editar');
        $routes->post('crear', 'MenuController::crear');
        $routes->post('eliminar', 'MenuController::eliminar');
    });

    /* ADMIN COMPRAS */
    $routes->group('compras', ['filter'=>'admindeposito'] ,function($routes){
        $routes->post('listar', 'CompraController::listar');
    });

    /* ADMIN ESTADO DE COMPRAS */
    $routes->group('estados', ['filter'=>'admindeposito'] ,function($routes){
        $routes->get('/', 'CompraEstadoController::administrar');
        $routes->get('listar', 'CompraEstadoController::listarProductos');
        $routes->post('actualizar', 'CompraEstadoController::actualizar');
        $routes->post('cancelar', 'CompraEstadoController::cancelar');
    });

    /* ADMIN ESTADO TIPO */
    $routes->group('estadotipo', ['fliter'=>'admindeposito'], function($routes){
        $routes->post('listar', 'CompraEstadoTipoController::listar');
    });
});
