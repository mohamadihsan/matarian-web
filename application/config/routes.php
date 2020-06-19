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
$route['default_controller'] = 'Login';
$route['404_override'] = 'ErrorPage';
$route['translate_uri_dashes'] = FALSE;


$route['api/web/v1/test']['GET']                 = 'api/web/v1/TestApi/index';

//==================================== API ROUTES =====================================

// Wilayah
$route['api/provinsi']['GET']                   = 'api/Wilayah_Api/provinsi';
$route['api/kabupaten/(:num)']['GET']           = 'api/Wilayah_Api/kabupaten/$1';
$route['api/kecamatan/(:num)']['GET']           = 'api/Wilayah_Api/kecamatan/$1';
$route['api/kelurahan/(:num)']['GET']           = 'api/Wilayah_Api/kelurahan/$1';
$route['api/kode-pos/(:num)']['GET']            = 'api/Wilayah_Api/kode_pos/$1';

// KTP
$route['api/web/v1/ktp']['GET']                 = 'api/web/v1/KTP_Api/show_all';
$route['api/web/v1/ktp/(:num)']['GET']          = 'api/web/v1/KTP_Api/show_by_id/$1';
$route['api/web/v1/ktp']['POST']                = 'api/web/v1/KTP_Api/create';
$route['api/web/v1/ktp/(:num)']['PUT']          = 'api/web/v1/KTP_Api/update/$1';
$route['api/web/v1/ktp']['DELETE']              = 'api/web/v1/KTP_Api/destroy';
$route['api/web/v1/ktp/(:num)/approve']['GET']  = 'api/web/v1/KTP_Api/approve/$1';
$route['api/web/v1/ktp/(:num)/reject']['GET']   = 'api/web/v1/KTP_Api/reject/$1';
