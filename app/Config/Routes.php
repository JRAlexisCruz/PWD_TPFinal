<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


/* PRODUCTOS */
$routes->get('/products', 'ProductController::listar');
$routes->get('/products/detail/(:num)', 'ProductController::detail/$1');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/create', 'ProductController::create');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->get('/products/delete/(:num)', 'ProductsController::delete/$1');

/* CARRITO DE COMPRAS */
$routes->get('/cart', 'CartController::index');

/* LOGIN */
$routes->get('/login', 'Session::index');
$routes->post('/login', 'Session::iniciar');

/* REGISTRO */
$routes->get('/registro','Session::registro');
$routes->post('/registro','Session::registrar');

