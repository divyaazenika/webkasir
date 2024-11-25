<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/produk', 'ProdukModels::index');
$routes->post('/produk/simpan', 'ProdukModels::simpan_produk');
$routes->get('/produk/tampil', 'ProdukModels::tampil_produk');
$routes->delete('produk/hapus/(:num)', 'ProdukModels::hapus_produk/$1');
$routes->post('/produk/updateProduk', 'ProdukModels::updateProduk');

$routes->get('/pelanggan', 'Pelanggan::index');

$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');
$routes->delete('pelanggan/hapus/(:num)', 'Pelanggan::hapus_pelanggan/$1');
$routes->post('/pelanggan/updatepelanggan', 'Pelanggan::update_pelanggan');
