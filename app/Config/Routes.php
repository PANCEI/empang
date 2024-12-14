<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/masuk', 'Login::masuk');
$routes->get('/dash','Dashboard::index');
