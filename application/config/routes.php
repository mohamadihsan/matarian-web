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

//==================================== WEB ROUTES =====================================

$route['login']                     = 'Login/index';
$route['register']                  = 'Register/index';
$route['reset-password']            = 'ResetPassword/index';
$route['reset-password/(:any)']     = 'ResetPassword/confirm/$1';
$route['ktp']                       = 'KTP/index';
$route['npwp']                      = 'NPWP/index';
$route['import-document']           = 'Import_Document/index';
$route['users']                     = 'User/index';
$route['users/profile']             = 'User/profile';
$route['users/activation']          = 'User/index';
$route['users/verified']            = 'User/index';
$route['users/rejected']            = 'User/index';
$route['user-group']                = 'User_Group/index';
$route['user-privilege']            = 'User_Privilege/index';
$route['menu']                      = 'Menu/index';
$route['langganan']                 = 'ACCDLGN/index';
$route['accardat/tagihan/klik2']    = 'ACCARDAT/index';
$route['accardat/tagihan/klik3/(:any)/(:any)/from/(:any)/to/(:any)']        = 'ACCARDAT/detail/$1/$2/$3/$4';
$route['accardat/tagihan/klik4/(:any)']     = 'ACCARDAT/nota/$1';
$route['accardat/tagihan/klik2/(:any)/(:any)/(:any)/(:any)/export']         = 'ACCARDAT/export_pdf_klik2/$1/$2/$3/$4';
$route['accardat/tagihan/klik3/(:any)/(:any)/from/(:any)/to/(:any)/export'] = 'ACCARDAT/export_pdf_klik3/$1/$2/$3/$4';
$route['report/sales']              = 'Report/sales';
$route['report/sales/barang-langganan']              = 'Report/by_barang_langganan';
$route['report/stock']          = 'Report/stock';
$route['news']          = 'News/index';
$route['news/(:num)']   = 'News/detail/$1';

//==================================== API ROUTES WEB =====================================

// Login & Logout
$route['api/web/v1/login']['POST']                          = 'api/web/v1/Login_Api/login';
$route['api/web/v1/logout']['POST']                         = 'api/web/v1/Logout_Api/logout';

// Register
$route['api/web/v1/register']['POST']                       = 'api/web/v1/Register_Api/index';
// Reset Password
$route['api/web/v1/reset-password']['POST']                 = 'api/web/v1/Register_Api/reset_password';
$route['api/web/v1/reset-password/confirm']['POST']         = 'api/web/v1/Register_Api/confirm_reset_password';

// Profile
$route['api/web/v1/profile']['GET']                         = 'api/web/v1/User_Api/profile';
$route['api/web/v1/profile/update']['POST']                 = 'api/web/v1/User_Api/profile_update';
$route['api/web/v1/profile/change-password']['PUT']         = 'api/web/v1/User_Api/profile_change_password';

// Dashboard 
$route['api/web/v1/dashboard']['GET']                       = 'api/web/v1/Dashboard_Api/index';
$route['api/web/v1/dashboard/tagihan']['GET']               = 'api/web/v1/Dashboard_Api/show_all_tagihan';
$route['api/web/v1/dashboard/tagihan/count']['GET']         = 'api/web/v1/Dashboard_Api/count_tagihan';
$route['api/web/v1/dashboard/ktp/count']['GET']             = 'api/web/v1/Dashboard_Api/count_ktp';
$route['api/web/v1/dashboard/npwp/count']['GET']            = 'api/web/v1/Dashboard_Api/count_npwp';
$route['api/web/v1/dashboard/accdbrg/count']['GET']         = 'api/web/v1/Dashboard_Api/count_accdbrg';
$route['api/web/v1/dashboard/accdlgn/count']['GET']         = 'api/web/v1/Dashboard_Api/count_accdlgn';
$route['api/web/v1/dashboard/accarbon/count']['GET']        = 'api/web/v1/Dashboard_Api/count_accarbon';
$route['api/web/v1/dashboard/accardat/count']['GET']        = 'api/web/v1/Dashboard_Api/count_accardat';
$route['api/web/v1/dashboard/user-login/limit/(:num)']['GET']     = 'api/web/v1/Dashboard_Api/user_login/$1';
$route['api/web/v1/dashboard/best-buyer/year/(:num)/month/(:num)/limit/(:num)']['GET']     = 'api/web/v1/Dashboard_Api/best_buyer/$1/$2/$3';
$route['api/web/v1/dashboard/best-seller/year/(:num)/month/(:num)/limit/(:num)']['GET']    = 'api/web/v1/Dashboard_Api/best_seller/$1/$2/$3';

// Wilayah
$route['api/wilayah']['POST']                   = 'api/Wilayah_Api/index';
$route['api/wilayah-v2']['POST']                = 'api/Wilayah_Api/index_v2';
$route['api/provinsi']['GET']                   = 'api/Wilayah_Api/provinsi';
$route['api/provinsi']['POST']                  = 'api/Wilayah_Api/provinsi';
$route['api/kabupaten/(:num)']['GET']           = 'api/Wilayah_Api/kabupaten/$1';
$route['api/kabupaten/(:num)/(:any)']['GET']    = 'api/Wilayah_Api/kabupaten/$1/$2';
$route['api/kecamatan/(:num)']['GET']           = 'api/Wilayah_Api/kecamatan/$1';
$route['api/kecamatan/(:num)/(:any)']['GET']    = 'api/Wilayah_Api/kecamatan/$1/$2';
$route['api/kelurahan/(:num)']['GET']           = 'api/Wilayah_Api/kelurahan/$1';
$route['api/kelurahan/(:num)/(:any)']['GET']    = 'api/Wilayah_Api/kelurahan/$1/$2';
$route['api/kode-pos/(:num)']['GET']            = 'api/Wilayah_Api/kode_pos/$1';
$route['api/kode-pos/(:num)/(:any)']['GET']     = 'api/Wilayah_Api/kode_pos/$1/$2';

// KTP
$route['api/web/v1/ktp']['GET']                 = 'api/web/v1/KTP_Api/show_all';
$route['api/web/v1/ktp/count']['GET']           = 'api/web/v1/KTP_Api/count';
$route['api/web/v1/ktp/(:num)']['GET']          = 'api/web/v1/KTP_Api/show_by_id/$1';
$route['api/web/v1/ktp']['POST']                = 'api/web/v1/KTP_Api/create';
$route['api/web/v1/ktp/(:num)']['PUT']          = 'api/web/v1/KTP_Api/update/$1';
$route['api/web/v1/ktp/(:num)']['DELETE']       = 'api/web/v1/KTP_Api/destroy/$1';
$route['api/web/v1/ktp/(:num)/approve']['GET']  = 'api/web/v1/KTP_Api/approve/$1';
$route['api/web/v1/ktp/(:num)/reject']['GET']   = 'api/web/v1/KTP_Api/reject/$1';

// NPWP
$route['api/web/v1/npwp']['GET']                 = 'api/web/v1/NPWP_Api/show_all';
$route['api/web/v1/npwp/count']['GET']           = 'api/web/v1/NPWP_Api/count';
$route['api/web/v1/npwp/(:num)']['GET']          = 'api/web/v1/NPWP_Api/show_by_id/$1';
$route['api/web/v1/npwp']['POST']                = 'api/web/v1/NPWP_Api/create';
$route['api/web/v1/npwp/(:num)']['PUT']          = 'api/web/v1/NPWP_Api/update/$1';
$route['api/web/v1/npwp/(:num)']['DELETE']       = 'api/web/v1/NPWP_Api/destroy/$1';
$route['api/web/v1/npwp/(:num)/approve']['GET']  = 'api/web/v1/NPWP_Api/approve/$1';
$route['api/web/v1/npwp/(:num)/reject']['GET']   = 'api/web/v1/NPWP_Api/reject/$1';

// Import Document
$route['api/web/v1/import-document']['POST']    = 'api/web/v1/Import_Document_Api/create';

// News
$route['api/web/v1/news']['GET']                = 'api/web/v1/News_Api/show';
$route['api/web/v1/news/(:num)']['GET']         = 'api/web/v1/News_Api/show/$1';
$route['api/web/v1/news']['POST']               = 'api/web/v1/News_Api/create';
$route['api/web/v1/news/(:num)']['POST']        = 'api/web/v1/News_Api/update/$1';
$route['api/web/v1/news/(:num)']['DELETE']      = 'api/web/v1/News_Api/destroy/$1';

// User Group
$route['api/web/v1/user-group']['GET']              = 'api/web/v1/User_Group_Api/show_all';
$route['api/web/v1/user-group/count']['GET']        = 'api/web/v1/User_Group_Api/count';
$route['api/web/v1/user-group']['POST']             = 'api/web/v1/User_Group_Api/create';
$route['api/web/v1/user-group/(:num)']['PUT']       = 'api/web/v1/User_Group_Api/update/$1';
$route['api/web/v1/user-group/(:num)']['DELETE']    = 'api/web/v1/User_Group_Api/destroy/$1';


// User Privilege
$route['api/web/v1/user-privilege/show']['POST']    = 'api/web/v1/User_Privilege_Api/show_all';
$route['api/web/v1/user-privilege/menu']['GET']     = 'api/web/v1/User_Privilege_Api/menu';
$route['api/web/v1/user-privilege']['POST']         = 'api/web/v1/User_Privilege_Api/create';
$route['api/web/v1/user-privilege/(:num)']['PUT']   = 'api/web/v1/User_Privilege_Api/update/$1';


// User
$route['api/web/v1/user']['GET']                    = 'api/web/v1/User_Api/show_all';
$route['api/web/v1/user/sales']['GET']              = 'api/web/v1/User_Api/user_sales';
$route['api/web/v1/user/count']['GET']              = 'api/web/v1/User_Api/count';
$route['api/web/v1/user/reject/count']['GET']       = 'api/web/v1/User_Api/count_reject';
$route['api/web/v1/user/verify/count']['GET']       = 'api/web/v1/User_Api/count_verify';
$route['api/web/v1/user/activation']['GET']         = 'api/web/v1/User_Api/show_pending_activation';
$route['api/web/v1/user/activation/count']['GET']   = 'api/web/v1/User_Api/count_pending_activation';
$route['api/web/v1/user']['POST']                   = 'api/web/v1/User_Api/create';
$route['api/web/v1/user/(:num)']['PUT']             = 'api/web/v1/User_Api/update/$1';
$route['api/web/v1/user/(:num)']['DELETE']          = 'api/web/v1/User_Api/destroy/$1';
$route['api/web/v1/user/(:num)/approve']['PUT']     = 'api/web/v1/User_Api/approve/$1';
$route['api/web/v1/user/(:num)/reject']['PUT']      = 'api/web/v1/User_Api/reject/$1';
$route['api/web/v1/user-access-data']['POST']       = 'api/web/v1/User_Api/user_access_data';
$route['api/web/v1/user-access-data/(:num)']['PUT'] = 'api/web/v1/User_Api/set_permission/$1';


// ACCARDAT
$route['api/web/v1/accardat']['GET']                                                     = 'api/web/v1/ACCARDAT_Api/show_all';
$route['api/web/v1/accardat/count']['GET']                                               = 'api/web/v1/ACCARDAT_Api/count';
$route['api/web/v1/accardat/tagihan']['POST']                                            = 'api/web/v1/ACCARDAT_Api/tagihan_klik2';
$route['api/web/v1/accardat/tagihan/nota']['POST']                                       = 'api/web/v1/ACCARDAT_Api/tagihan_klik3';
$route['api/web/v1/accardat/tagihan/nota/detail']['POST']                                = 'api/web/v1/ACCARDAT_Api/tagihan_klik4';
$route['api/web/v1/accardat/tagihan/page/(:num)/per-page/(:num)']['POST']                = 'api/web/v1/ACCARDAT_Api/tagihan_klik2_pagination/$1/$2';
$route['api/web/v1/accardat/tagihan/nota/page/(:num)/per-page/(:num)']['POST']           = 'api/web/v1/ACCARDAT_Api/tagihan_klik3_pagination/$1/$2';
$route['api/web/v1/accardat/tagihan/nota/detail/page/(:num)/per-page/(:num)']['POST']    = 'api/web/v1/ACCARDAT_Api/tagihan_klik4_pagination/$1/$2';
$route['api/web/v1/accardat/tagihan/user']['GET']                                        = 'api/web/v1/ACCARDAT_Api/tagihan_user';
$route['api/web/v1/accardat/tagihan/detail/(:any)']['GET']                               = 'api/web/v1/ACCARDAT_Api/detail_tagihan/$1';
$route['api/web/v1/accardat/pagination/page/(:num)/per-page/(:num)']['GET']              = 'api/web/v1/ACCARDAT_Api/show_all_pagination/$1/$2';
$route['api/web/v1/accardat/tagihan/pagination/page/(:num)/per-page/(:num)']['GET']      = 'api/web/v1/ACCARDAT_Api/tagihan_pagination/$1/$2';

// ACCDLGN
$route['api/web/v1/accdlgn']['GET']                                                     = 'api/web/v1/ACCDLGN_Api/show_all';

// ACCDBRG
$route['api/web/v1/accdbrg']['GET']                                                     = 'api/web/v1/ACCDBRG_Api/show_all';

// REPORT
$route['api/web/v1/report/sales']['POST']       = 'api/web/v1/Report_Api/sales';
$route['api/web/v1/report/sales/by-barang-langganan']['POST']       = 'api/web/v1/Report_Api/by_sales_langganan';
$route['api/web/v1/report/stock']['POST']   = 'api/web/v1/Report_Api/stock';



//==================================== API ROUTES MOBILE =====================================

// Login & Logout
$route['api/mobile/v1/login']['POST']                          = 'api/mobile/v1/Login_Api/login';
$route['api/mobile/v1/logout']['POST']                          = 'api/mobile/v1/Logout_Api/logout';

// Profile
$route['api/mobile/v1/profile']['GET']                          = 'api/mobile/v1/User_Api/profile';

// Dashboard
$route['api/mobile/v1/dashboard']['GET']                        = 'api/mobile/v1/Dashboard_Api/index';
$route['api/mobile/v1/dashboard/tagihan']['GET']                = 'api/mobile/v1/Dashboard_Api/show_all_tagihan';
$route['api/mobile/v1/dashboard/tagihan/count']['GET']          = 'api/mobile/v1/Dashboard_Api/count_tagihan';
$route['api/mobile/v1/dashboard/ktp/count']['GET']              = 'api/mobile/v1/Dashboard_Api/count_ktp';
$route['api/mobile/v1/dashboard/npwp/count']['GET']             = 'api/mobile/v1/Dashboard_Api/count_npwp';
$route['api/mobile/v1/dashboard/accdbrg/count']['GET']          = 'api/mobile/v1/Dashboard_Api/count_accdbrg';
$route['api/mobile/v1/dashboard/accdlgn/count']['GET']          = 'api/mobile/v1/Dashboard_Api/count_accdlgn';
$route['api/mobile/v1/dashboard/accarbon/count']['GET']         = 'api/mobile/v1/Dashboard_Api/count_accarbon';
$route['api/mobile/v1/dashboard/accardat/count']['GET']         = 'api/mobile/v1/Dashboard_Api/count_accardat';
$route['api/mobile/v1/dashboard/best-buyer/year/(:num)/month/(:num)/limit/(:num)']['GET']     = 'api/mobile/v1/Dashboard_Api/best_buyer/$1/$2/$3';
$route['api/mobile/v1/dashboard/best-seller/year/(:num)/month/(:num)/limit/(:num)']['GET']    = 'api/mobile/v1/Dashboard_Api/best_seller/$1/$2/$3';

// KTP
$route['api/mobile/v1/ktp/pagination/page/(:num)/per-page/(:num)']['GET']   = 'api/mobile/v1/KTP_Api/pagination/$1/$2';
$route['api/mobile/v1/ktp/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/KTP_Api/pagination/$1/$2';

// NPWP
$route['api/mobile/v1/npwp/pagination/page/(:num)/per-page/(:num)']['GET']   = 'api/mobile/v1/NPWP_Api/pagination/$1/$2';
$route['api/mobile/v1/npwp/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/NPWP_Api/pagination/$1/$2';

// NEWS
$route['api/mobile/v1/news/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/News_Api/pagination/$1/$2';


// ACCDLGN
$route['api/mobile/v1/accdlgn/pagination/page/(:num)/per-page/(:num)']['POST']          = 'api/mobile/v1/ACCDLGN_Api/show_all/$1/$2';

// ACCARBON
$route['api/mobile/v1/accarbon/pagination/year/(:num)/month/(:num)/page/(:num)/per-page/(:num)']['GET']   = 'api/mobile/v1/ACCARBON_Api/pagination/$1/$2/$3/$4';

// ACCARDAT
$route['api/mobile/v1/accardat']['GET']                                                     = 'api/mobile/v1/ACCARDAT_Api/show_all';
$route['api/mobile/v1/accardat/count']['GET']                                               = 'api/mobile/v1/ACCARDAT_Api/count';
$route['api/mobile/v1/accardat/tagihan']['POST']                                            = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik2';
$route['api/mobile/v1/accardat/tagihan/nota']['POST']                                       = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik3';
$route['api/mobile/v1/accardat/tagihan/nota/detail']['POST']                                = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik4';
$route['api/mobile/v1/accardat/tagihan/page/(:num)/per-page/(:num)']['POST']                = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik2_pagination/$1/$2';
$route['api/mobile/v1/accardat/tagihan/nota/page/(:num)/per-page/(:num)']['POST']           = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik3_pagination/$1/$2';
$route['api/mobile/v1/accardat/tagihan/nota/detail/page/(:num)/per-page/(:num)']['POST']    = 'api/mobile/v1/ACCARDAT_Api/tagihan_klik4_pagination/$1/$2';
$route['api/mobile/v1/accardat/tagihan/user']['GET']                                        = 'api/mobile/v1/ACCARDAT_Api/tagihan_user';
$route['api/mobile/v1/accardat/tagihan/detail/(:any)']['GET']                               = 'api/mobile/v1/ACCARDAT_Api/detail_tagihan/$1';
$route['api/mobile/v1/accardat/pagination/page/(:num)/per-page/(:num)']['GET']              = 'api/mobile/v1/ACCARDAT_Api/show_all_pagination/$1/$2';
$route['api/mobile/v1/accardat/tagihan/pagination/page/(:num)/per-page/(:num)']['GET']      = 'api/mobile/v1/ACCARDAT_Api/tagihan_pagination/$1/$2';


// REPORT
$route['api/mobile/v1/report/sales/pagination/page/(:num)/per-page/(:num)']['POST']       = 'api/mobile/v1/Report_Api/sales/$1/$2';
$route['api/mobile/v1/report/stock/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/Report_Api/stock/$1/$2';
// search
$route['api/mobile/v1/search/langganan/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/Report_Api/search_langganan_pagination/$1/$2';
$route['api/mobile/v1/search/langganan/detail/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/Report_Api/search_langganan_detail_pagination/$1/$2';
$route['api/mobile/v1/search/barang/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/Report_Api/search_barang_pagination/$1/$2';
$route['api/mobile/v1/search/barang/detail/pagination/page/(:num)/per-page/(:num)']['POST']   = 'api/mobile/v1/Report_Api/search_barang_detail_pagination/$1/$2';
