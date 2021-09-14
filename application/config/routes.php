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

/*
| -------------------------------------------------------------------------
|FrontEnd   Section start
| -------------------------------------------------------------------------
 * 
 */

$route['default_controller'] = 'website/Home/index';
$route['can-i-get-permit'] = 'website/canIgetPermit/Can_i_get_permits/index';
$route['can_i_get_route_form'] = 'website/canIgetPermit/Can_i_get_permits/can_i_get_route_ajax_form';
$route['can-i-get-permit-calculation-search'] = 'website/canIgetPermit/Can_i_get_permits/can_i_get_permit_calculation';
$route['can_i_get_stored'] = 'website/canIgetPermit/Can_i_get_permits/can_i_get_calculation_stored_session';
$route['test'] = 'website/routePermit/Route_permit/test';
$route['route-permit'] = 'website/routePermit/Route_permit/index';
$route['serach-route-by-address'] = 'website/routePermit/Route_permit/search_route_by_address';
$route['route-permit-form'] = 'website/routePermit/Route_permit/xcmg_route_permit_form_append';
$route['signup'] = 'website/registration/Registration/signup';
$route['login'] = 'website/registration/Registration/xcmgarc_login';
$route['registration'] = 'website/registration/Registration/xcmg_arc_user_registration';
$route['dashboard'] = 'website/dashboard/Dashboard/index';
$route['change-password'] = 'website/dashboard/Dashboard/xcmg_user_password_change';
$route['logout'] = 'website/dashboard/Dashboard/xcmg_user_logout';
$route['edit-profile'] = 'website/dashboard/Dashboard/xcmg_user_profile_update';
$route['forgot-password'] = 'website/registration/Forget_password/index';
$route['reset-password'] = 'website/registration/Forget_password/sent_reset_password_link';
$route['forget-password-update/(:any)/(:any)'] = 'website/registration/Forget_password/xcmg_user_forget_password_form_update_pasword/$1/$2';
$route['update-user-password'] = 'website/registration/Forget_password/xcmg_user_forget_password_update';


/*
/*
| -------------------------------------------------------------------------
|Superadmin   Section start
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin'] = 'superadmin/admin/Login/index';
$route['superadmin/authenticate'] = 'superadmin/admin/Login/super_admin_login';   //validate login
$route['superadmin/unauthenticate'] = 'superadmin/admin/Login/super_admin_Logout';
$route['superadmin/forget-password'] = 'superadmin/admin/Login/forget_password';
$route['superadmin/forget-link'] = 'superadmin/admin/Login/forgetpass';
$route['superadmin/superadmin-forget-password/(:any)/(:any)'] = 'superadmin/admin/Login/admin_password_reset/$1/$2';
$route['superadmin/superadmin-password-update'] = 'superadmin/admin/Login/update_admin_reset_password';


/*
| -------------------------------------------------------------------------
|User section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/user/user_list'] = 'superadmin/user/User/index';
$route['superadmin/user/create-user'] = 'superadmin/user/User/user_add_form';
$route['superadmin/user/update-user-form/(:any)'] = 'superadmin/user/User/user_edit_form/$1';
$route['superadmin/user/user-information-update'] = 'superadmin/user/User/save_user_information_update';
$route['superadmin/user/view-user/(:any)'] = 'superadmin/user/User/view_user_details/$1';
$route['superadmin/user/user-delete/(:any)'] = 'superadmin/user/User/user_deleted/$1';
$route['superadmin/user/user-block/(:any)'] = 'superadmin/user/User/block/$1';
$route['superadmin/user/user-unblock/(:any)'] = 'superadmin/user/User/unblock/$1';

/*
| -------------------------------------------------------------------------
|Permit  section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/permit/state'] = 'superadmin/permit/Manage_state/index';
$route['superadmin/state/create_state'] = 'superadmin/permit/Manage_state/state_add_form';
$route['superadmin/state/create_update_state'] = 'superadmin/permit/Manage_state/create_update_user_information_section';
$route['superadmin/state/state-block/(:any)'] = 'superadmin/permit/Manage_state/block/$1';
$route['superadmin/state/state-unblock/(:any)'] = 'superadmin/permit/Manage_state/unblock/$1';
$route['superadmin/state/state_delete/(:any)'] = 'superadmin/permit/Manage_state/state_delete/$1';
$route['superadmin/state/edit_state/(:any)'] = 'superadmin/permit/Manage_state/state_edit_form/$1';

//permit type
$route['superadmin/permit/permit_type'] = 'superadmin/permit/Manage_Permit_type/index';
$route['superadmin/permit/create_permit_type'] = 'superadmin/permit/Manage_Permit_type/permit_type_add_form';
$route['superadmin/permit/create_update_permit_type'] = 'superadmin/permit/Manage_Permit_type/create_update_permit_type_information_section';
$route['superadmin/permit/permit-type-block/(:any)'] = 'superadmin/permit/Manage_Permit_type/block/$1';
$route['superadmin/permit/permit-type-unblock/(:any)'] = 'superadmin/permit/Manage_Permit_type/unblock/$1';
$route['superadmin/permit/edit_permit_type/(:any)'] = 'superadmin/permit/Manage_Permit_type/permit_type_edit_form/$1';
$route['superadmin/permit/permit_type_delete/(:any)'] = 'superadmin/permit/Manage_Permit_type/permit_type_delete/$1';


//permit calculation 
$route['superadmin/permit/permit_calculation'] = 'superadmin/permit/Manage_Permit_calculation/index';
$route['superadmin/permit/create_permit_calculation'] = 'superadmin/permit/Manage_Permit_calculation/xcmg_create_permit_calculation_form'; 
$route['superadmin/permit/create_update_permi_calculation'] = 'superadmin/permit/Manage_Permit_calculation/permit_calculation_update_insert'; 
$route['superadmin/permit/calculation_block/(:any)'] = 'superadmin/permit/Manage_Permit_calculation/block_permit_calculation/$1';
$route['superadmin/permit/calculation_unblock/(:any)'] = 'superadmin/permit/Manage_Permit_calculation/unblock_permit_calculation/$1';
$route['superadmin/permit/calculation_delete/(:any)'] = 'superadmin/permit/Manage_Permit_calculation/delete_permit_calculation_/$1';
$route['superadmin/permit/edit_permit_calculation/(:any)'] = 'superadmin/permit/Manage_Permit_calculation/permit_calculation_update/$1';
$route['superadmin/permit/view_calculation/(:any)'] = 'superadmin/permit/Manage_Permit_calculation/view_permit_calculation_details/$1';



/*
| -------------------------------------------------------------------------
|Dashboard section 
| -------------------------------------------------------------------------
 * 
 */
 $route['superadmin/dashboard/user_currency_stock'] = 'superadmin/admin/Admin_Dashboard/currency_report_filter_by_user_id';
$route['superadmin/dashboard'] = 'superadmin/admin/Admin_Dashboard/index';
$route['superadmin/edit-profile'] = 'superadmin/admin/Admin_Dashboard/Admin_setting';
$route['superadmin/update-setting'] = 'superadmin/admin/Admin_Dashboard/admin_profile_update';
$route['superadmin/change-password'] = 'superadmin/admin/Admin_Dashboard/superadmin_password_change';



/*
| -------------------------------------------------------------------------
|FrontEnd Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/slider'] = 'superadmin/frontend/Slider/index';
$route['superadmin/home_page_setting'] = 'superadmin/frontend/Home_block_setting/index';

$route['superadmin/home-page-setting-create'] = 'superadmin/frontend/Home_block_setting/create_home_page_setting';

$route['superadmin/home-page-setting-edit/(:any)'] = 'superadmin/frontend/Home_block_setting/edit_home_page_setting/$1';

$route['superadmin/footer-setting-edit/(:any)'] = 'superadmin/frontend/Footer_setting/edit_footer_setting/$1'; //foter setting edit form
$route['superadmin/footer_setting'] = 'superadmin/frontend/Footer_setting/index';  //foter setting
$route['superadmin/update-footer-details'] = 'superadmin/frontend/Footer_setting/footer_setting_information_update'; //foter setting update info


$route['superadmin/update-home-page-setting-details'] = 'superadmin/frontend/Home_block_setting/home_page_setting_information_update';
$route['superadmin/home-seeting-image-delete'] = 'superadmin/frontend/Home_block_setting/home_setting_image_delete';
$route['superadmin/slider-create'] = 'superadmin/frontend/Slider/create_slider_page';
$route['superadmin/slider-details-save'] = 'superadmin/frontend/Slider/save_slider_information';
$route['superadmin/home-page-setting-save'] = 'superadmin/frontend/Home_block_setting/save_home_page_setting';
$route['superadmin/slider-view/(:any)'] = 'superadmin/frontend/Slider/slider_view_details/$1';
$route['superadmin/slider-edit/(:any)'] = 'superadmin/frontend/Slider/edit_slider/$1';
$route['superadmin/update-slider-details'] = 'superadmin/frontend/Slider/slider_information_update';
$route['superadmin/slider-image-delete'] = 'superadmin/frontend/Slider/slider_image_delete';
$route['superadmin/slider-delete/(:any)'] = 'superadmin/frontend/Slider/delete_slider/$1';

/*
| -------------------------------------------------------------------------
|End SuperAdmin Section
| -------------------------------------------------------------------------
 * 
 */



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
