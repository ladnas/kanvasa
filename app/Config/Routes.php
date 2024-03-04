<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Views
$routes->get('/', 'Home::index');
$routes->get('jelajahi', 'Home::jelajah');
$routes->get('detail/(:num)', 'Home::detail/$1');
$routes->get('profil', 'Home::profil');

// Login, Logout, Register, Verifikasi email
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->get('logout', 'Auth::logout');
$routes->post('auth/valid_register', 'Auth::valid_register');
$routes->post('auth/valid_login', 'Auth::valid_login');
$routes->get('verifyaccount/(:any)', 'Auth::verifyAccount/$1');
$routes->get('verify', 'Auth::verify');

// CRUD
$routes->get('buat', 'Post::buat');
$routes->post('buat_post', 'Post::posting');
$routes->get('edit/(:num)', 'Post::editDetail/$1');
$routes->post('edit_post/(:num)', 'Post::update/$1');
$routes->get('delete/(:num)', 'Post::delete/$1');

// USER EDIT
$routes->get('edit_profil', 'User::edit_profil');
$routes->post('editProfil/(:num)', 'User::editProfil');

// KOMENTAR
$routes->post('komentar/tambah', 'Komentar::tambahKomentar');

// LIKE
$routes->post('like/(:num)', 'Likes::tambah_like/$1');
$routes->post('dislike/(:num)', 'Likes::tambah_dislike/$1');
$routes->post('like_dislike/(:num)', 'Likes::likeDislike/$1');  


// ALBUM
$routes->post('/album/create/(:any)', 'Albums::createAlbum/$1' );
$routes->get('Albumitem/addToAlbum/(:num)/(:num)', 'Albumitem::addToAlbum/$1/$2');
$routes->get('albumdetail/(:num)', 'Albumitem::viewPhoto/$1');
$routes->get('/removepost/(:num)/(:num)', 'Albumitem::removeFromAlbum/$1/$2');
$routes->post('album/edit/(:num)', 'Albums::edit/$1');
// Route untuk menampilkan modal konfirmasi penghapusan album
$routes->get('album/delete/(:num)', 'Albums::deleteConfirmationModal/$1');
// Route untuk mengkonfirmasi penghapusan album
$routes->post('album/confirmDelete', 'Albums::confirmDelete');

// SEARCH
$routes->get('/post/search', 'Post::search');