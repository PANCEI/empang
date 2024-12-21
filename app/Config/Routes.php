<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/masuk', 'Login::masuk');
$routes->get('/dash','Dashboard::index');
$routes->get('komoditi','Komoditi::index');
$routes->post('/tambah-komoditi','Komoditi::tambah');
$routes->get('/get-komoditi','Komoditi::getKomoditi');
$routes->post('/edit-komoditi','Komoditi::editKomoditi');
$routes->post('/delete-komoditi','Komoditi::delete');
