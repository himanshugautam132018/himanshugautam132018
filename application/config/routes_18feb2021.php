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

/*
| -------------------------------------------------------------------------
|FrontEnd   Section start
| -------------------------------------------------------------------------
 * 
 */

$route['default_controller'] = 'web/Home/index';
$route['home'] = 'web/Home/index';
//$route['contact'] = 'web/Home/contact';
$route['save-contact-query'] = 'web/Home/save_contract_query_information';
//$route['registration'] = 'web/Registration/index';
//$route['fees'] = 'web/Fees/index';
// $route['events'] = 'web/Events/index';
// $route['image-gallery'] = 'web/Image_gallery/index';
// $route['video-gallery'] = 'web/Video_gallery/index';
// $route['blogs'] = 'web/Blog/index';
$route['blog-detail/(:any)'] = 'web/Blog/blog_details/$1';
$route['blog-view-post'] = 'web/Blog/blog_view_post';

// $route['about-us'] = 'web/Aboutus/index';
$route['learn-play'] = 'web/Aboutus/learn_play';
$route['babysitter'] = 'web/Aboutus/babysitter';
$route['activities'] = 'web/Activities/index';
$route['activity-detail']='web/Activities/activity_details';
$route['pages/(:any)']='web/Page/sub_menu_page_configuration/$1';
$route['event-detail/(:any)']='web/Events/event_details_information/$1';

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
|Dashboard section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/dashboard'] = 'superadmin/admin/Admin_Dashboard/index';
$route['superadmin/setting'] = 'superadmin/admin/Admin_Dashboard/Admin_setting';
$route['superadmin/update-setting'] = 'superadmin/admin/Admin_Dashboard/admin_profile_update';
$route['superadmin/change-password'] = 'superadmin/admin/Admin_Dashboard/superadmin_password_change';
/*
| -------------------------------------------------------------------------
|Page Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/page'] = 'superadmin/page/page/index';
$route['superadmin/save-page-details'] = 'superadmin/page/page/save_page_information';
$route['superadmin/page-create'] = 'superadmin/page/page/create_page';
$route['superadmin/page-view/(:any)'] = 'superadmin/page/page/view_page/$1';
$route['superadmin/page-edit/(:any)'] = 'superadmin/page/page/edit_page/$1';
$route['superadmin/update-page-details'] = 'superadmin/page/page/update_page_information';
$route['superadmin/page-image-delete'] = 'superadmin/page/page/page_Image_deleted';
$route['superadmin/page-delete/(:any)'] = 'superadmin/page/page/page_deleted/$1';

/*
| -------------------------------------------------------------------------
|Gallery  Section 
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/gallery'] = 'superadmin/gallery/Gallery/index';
$route['superadmin/save-gallery-category'] = 'superadmin/gallery/Gallery/save_gallery_category_information';
$route['superadmin/gallery-view/(:any)'] = 'superadmin/gallery/Gallery/view_gallery/$1';
$route['superadmin/add-gallery-image'] = 'superadmin/gallery/Gallery/save_gallery_category_images';
$route['superadmin/gallery-image-delete'] = 'superadmin/gallery/Gallery/gallery_Image_deleted';
$route['superadmin/gallery-category-delete/(:any)'] = 'superadmin/gallery/Gallery/gallery_category_deleted/$1';


/*
| -------------------------------------------------------------------------
|Video  Section 
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/video'] = 'superadmin/video/Video/index';
$route['superadmin/video-upload'] = 'superadmin/video/Video/upload_video';
$route['superadmin/save-video-details'] = 'superadmin/video/Video/save_video_upload_information';
$route['superadmin/save-category-video'] = 'superadmin/video/Video/upload_video_category_url';
$route['superadmin/video-view/(:any)'] = 'superadmin/video/Video/view_video/$1';
$route['superadmin/video-url-delete'] = 'superadmin/video/Video/category_wise_Video_URL_deleted';
$route['superadmin/video-delete/(:any)'] = 'superadmin/video/Video/embded_video_delete/$1';


/*
| -------------------------------------------------------------------------
|Event Section  
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/event'] = 'superadmin/event/Event/index';
$route['superadmin/event-add'] = 'superadmin/event/Event/add_event';
$route['superadmin/event-edit/(:any)'] = 'superadmin/event/Event/edit_event/$1';
$route['superadmin/event-view/(:any)'] = 'superadmin/event/Event/view_event/$1';
$route['superadmin/save-event-details'] = 'superadmin/event/Event/save_event_information';
$route['superadmin/update-event-details'] = 'superadmin/event/Event/events_information_update';
$route['superadmin/event-image-delete'] = 'superadmin/event/Event/delete_event_image';
$route['superadmin/event-delete/(:any)'] = 'superadmin/event/Event/delete_event/$1';

/*
| -------------------------------------------------------------------------
|Blog  Section 
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/blogs'] = 'superadmin/blogs/Blogs/index';
$route['superadmin/add-blog'] = 'superadmin/blogs/Blogs/save_blog_information';
$route['superadmin/update-blog'] = 'superadmin/blogs/Blogs/update_blog_information';
$route['superadmin/blog-view'] = 'superadmin/blogs/Blogs/view_blog';
$route['superadmin/blog-add'] = 'superadmin/blogs/Blogs/add_blog';
$route['superadmin/blog-edit/(:any)'] = 'superadmin/blogs/Blogs/edit_blog/$1';
$route['superadmin/blog-image-delete'] = 'superadmin/blogs/Blogs/delete_blog_image';
$route['superadmin/blog-delete/(:any)'] = 'superadmin/blogs/Blogs/delete_blog/$1';

/*
| -------------------------------------------------------------------------
|Blog Category   Section 
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/blog-categories'] = 'superadmin/blogs/Blogs_category/index';
$route['superadmin/save-blog-category-details'] = 'superadmin/blogs/Blogs_category/save_blog_category_information';
$route['superadmin/blog-category-add'] = 'superadmin/blogs/Blogs_category/add_blog_category';
$route['superadmin/blog-category-edit/(:any)'] = 'superadmin/blogs/Blogs_category/edit_blog_category/$1';
$route['superadmin/update-blog-category-details'] = 'superadmin/blogs/Blogs_category/blog_category_information_update';
$route['superadmin/blog-category-image-delete'] = 'superadmin/blogs/Blogs_category/delete_blog_category_image';
$route['superadmin/blog-category-delete/(:any)'] = 'superadmin/blogs/Blogs_category/delete_blog_category/$1';

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
|Student  Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/students'] = 'superadmin/admission/Student/index';  
$route['superadmin/admission-form'] = 'superadmin/admission/Student/student_admission_form';  
$route['superadmin/student-view'] = 'superadmin/admission/Student/view_student';  
$route['superadmin/student-edit'] = 'superadmin/admission/Student/edit_student';


/*
| -------------------------------------------------------------------------
|Teacher  Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/teachers'] = 'superadmin/admission/Teacher/index';  
$route['superadmin/teacher-add'] = 'superadmin/admission/Teacher/add_teacher'; 
$route['superadmin/teacher-view'] = 'superadmin/admission/Teacher/view_teacher'; 
$route['superadmin/teacher-edit'] = 'superadmin/admission/Teacher/edit_teacher'; 

/*
| -------------------------------------------------------------------------
|Fees  Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/fees'] = 'superadmin/admission/Fees/index';

/*
| -------------------------------------------------------------------------
|Fee-Report   Section 
| -------------------------------------------------------------------------
 * 
 */

$route['superadmin/fee-report'] = 'superadmin/admission/Fee_report/index';

/*
| -------------------------------------------------------------------------
|Menu  Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/menus'] = 'superadmin/menu/Menu/index';

/*
| -------------------------------------------------------------------------
|Menu Items   Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/menu-items/(:any)'] = 'superadmin/menu/Menu_items/index/$1';
$route['superadmin/save-menu-items'] = 'superadmin/menu/Menu_items/save_menu_item_information';
$route['superadmin/update-menu-items'] = 'superadmin/menu/Menu_items/edit_menu_item_information';
$route['superadmin/edit-page-menu-items/(:any)'] = 'superadmin/menu/Menu_items/menu_itom_page_append/$1';
$route['superadmin/menu-items-delete/(:any)'] = 'superadmin/menu/Menu_items/delete_menu_items/$1';


/*
| -------------------------------------------------------------------------
|Sub Menu Items   Section 
| -------------------------------------------------------------------------
 * 
 */
$route['superadmin/save-sub-menu-items'] = 'superadmin/menu/Sub_menu_items/save_SubMenu_item_information';
$route['superadmin/sub-menu-items/(:any)/(:any)'] = 'superadmin/menu/Sub_menu_items/index/$1/$2';
$route['superadmin/sub-menu-items-delete/(:any)'] = 'superadmin/menu/Sub_menu_items/delete_sub_menu_items/$1';
$route['superadmin/edit-page-sub-menu-items/(:any)'] = 'superadmin/menu/Sub_menu_items/sub_menu_itom_page_append/$1';
$route['superadmin/update-sub-menu-items'] = 'superadmin/menu/Sub_menu_items/edit_sub_menu_item_information';
/*
| -------------------------------------------------------------------------
|End SuperAdmin Section
| -------------------------------------------------------------------------
 * 
 */


$route['(:any)'] = 'web/Page/page_configuration/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
