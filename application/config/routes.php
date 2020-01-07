<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['member/(:num)'] = 'member/index/$1';
$route['api/get/info'] = 'API/get_info';
$route['api/get/product/jual'] = 'API/get_jual';
$route['api/get/ads'] = 'API/get_ads';
$route['api/get/product/pinjam'] = 'API/get_pinjam';
$route['api/get/product/detail/(:num)'] = 'API/get_product_detail/$1';
$route['api/get/mawapres'] = 'API/get_mawapres';
$route['api/post/absen'] = 'API/post_absen';
$route['api/post/mawapres/vote'] = 'API/vote_mawapres';
$route['api/post/brawijaya/sambat'] = 'API/get_sambat';
$route['api/post/brawijaya/sambat/(:num)'] = 'API/get_sambat/$1';
$route['api/post/brawijaya/sambat/posting'] = 'API/post_sambat';
$route['api/post/brawijaya/sambat/komentar/(:num)'] = 'API/post_komentar/$1';
$route['peminjaman'] = 'pinjam';
$route['informasi'] = 'informasi';
$route['shortlink'] = 'link';
$route['iklan'] = 'ads';
$route['iklan/hapus'] = 'ads/hapus';
$route['iklan/autoload'] = 'ads/autoload';
$route['iklan/tambah'] = 'ads/tambah';
$route['iklan/ubah'] = 'ads/ubah';
$route['iklan/getdata'] = 'ads/getdata';
$route['iklan/ubahdata'] = 'ads/ubahdata';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
