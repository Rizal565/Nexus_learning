<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'DashboardController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route Logout
$route['login'] = 'AuthController/index';
$route['logout'] = 'AuthController/logout';
$route['register'] = 'AuthController/register';

$route['data-admin'] = 'AdminController/index';
$route['data-admin/create'] = 'AdminController/create';
$route['data-admin/edit/(:any)'] = 'AdminController/edit/$1';
$route['data-admin/delete/(:any)'] = 'AdminController/delete/$1';

$route['data-pengunjung'] = 'PengunjungController/index';
$route['data-pengunjung/create'] = 'PengunjungController/create';
$route['data-pengunjung/edit/(:any)'] = 'PengunjungController/edit/$1';
$route['data-pengunjung/delete/(:any)'] = 'PengunjungController/delete/$1';

$route['data-kategori'] = 'KategoriController/index';
$route['data-kategori/create'] = 'KategoriController/create';
$route['data-kategori/edit/(:any)'] = 'KategoriController/edit/$1';
$route['data-kategori/delete/(:any)'] = 'KategoriController/delete/$1';

$route['materi'] = 'MateriController/index';
$route['materi/create'] = 'MateriController/create';
$route['materi/edit/(:any)'] = 'MateriController/edit/$1';
$route['materi/delete/(:any)'] = 'MateriController/delete/$1';
