<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\Dashboard::index');
//route admin dashboard
$routes->get('dashboard', 'Admin\Dashboard::index');

//Routes Sidebar
$routes->get('barang', 'Admin\Stok::index');
$routes->get('admin/barang/stok', 'Admin\Stok::index');
$routes->get('kategori', 'Admin\Kategori::index');
$routes->get('satuan', 'Admin\Satuan::index');
$routes->get('merk', 'Admin\Merk::index');
$routes->get('barangmasuk', 'Admin\BarangMasuk::index');
$routes->get('barangkeluar', 'Admin\BarangKeluar::index');

//routes Stok
$routes->post('Admin/Stok/tambah', 'Admin\Stok::tambah');
$routes->post('Admin/Stok/edit', 'Admin\Stok::edit');
$routes->get('Admin/Stok/delete/(:num)', 'Admin\Stok::delete/$1');

//routes Barang Masuk
$routes->post('Admin/BarangMasuk/tambah', 'Admin\BarangMasuk::tambah');
$routes->get('Admin/BarangMasuk/delete/(:num)', 'Admin\BarangMasuk::delete/$1');

//routes Barang Keluar
$routes->post('Admin/BarangKeluar/tambah', 'Admin\BarangKeluar::tambah');
$routes->get('Admin/BarangKeluar/delete/(:num)', 'Admin\BarangKeluar::delete/$1');
