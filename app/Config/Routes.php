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
$routes->get('/asset','Asset::index');
$routes->get('/generate-kode', 'Asset::generateKode');
$routes->post('/tambah-asset','Asset::tambah');
$routes->get('/get-all-assets','Asset::getall');
$routes->post('/edit-asset', 'Asset::edit');
$routes->post('/delete-asset', 'Asset::delete');
$routes->get('/tambah-jumlah-asset','TambahAsset::index');
$routes->get('/tambah-asset-getall-asset', 'TambahAsset::getAllAssets');
$routes->post('/asset-masuk','TambahAsset::tambah');
$routes->get('/tambah-asset-getdatamasukall','TambahAsset::getdataall');
$routes->post('/delete-masuk','TambahAsset::delete');
$routes->get('/kurang-jumlah-asset','AssetKeluar::index');
$routes->post('/asset-keluar','AssetKeluar::tambah');
$routes->get('/kurang-asset-getdatakeluarall','AssetKeluar::getall');
$routes->post('/delete-keluar','AssetKeluar::delete');


