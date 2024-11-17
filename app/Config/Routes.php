<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


/* ROUTER PRODUCTOS */
$routes->get('/products', 'ProductController::listar');
$routes->get('products/load', 'ProductController::load');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/create', 'ProductController::create');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->get('/products/delete/(:num)', 'ProductsController::delete/$1');

