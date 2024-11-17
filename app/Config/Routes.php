<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


/* PRODUCTOS */
$routes->get('/products', 'Products::index');

/* LOGIN */
$routes->get('/login', 'Session::index');
$routes->post('/login', 'Session::iniciar');

/* REGISTRO */
$routes->get('/registro','Session::registro');
$routes->post('/registro','Session::registrar');
