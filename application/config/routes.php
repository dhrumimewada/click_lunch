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
$route['default_controller'] = 'Home/';
$route['login'] = 'admin/admin_login/login';

$route['register'] = 'register';
$route['home'] = 'home/index';
 
$route['dashboard'] = 'welcome/index';  
$route['form'] = 'welcome/form_validation';  
$route['profile'] = 'welcome/profile';  
$route['table'] = 'table/index'; 
$route['error-page'] = 'welcome/error_page'; 


// Vender
$route['login-vender'] = 'vender/vender_login/login';  
$route['vender-profile'] = 'vender/vender_profile/my_profile';  
$route['vender-change-password'] = 'vender/vender_profile/change_password'; 
$route['vender-forgot-password'] = 'vender/vender_login/vender_forgot_password'; 
$route['vender-reset-password/(:any)'] = 'vender/vender_login/vender_reset_password/$1'; 
$route['vender-logout'] = 'vender/vender_login/logout'; 

$route['vender-dashboard'] = 'vender/dashboard/vender_dashboard';  

// Vender item managment
$route['item-list'] = 'vender/item/item/index'; 
$route['item-delete'] = 'vender/item/item/delete';
$route['item-status'] = 'vender/item/item/active_deactive_item'; 
$route['item-add'] = 'vender/item/item/post/Product'; 
$route['item-update/(:any)'] = 'vender/item/item/put/$1'; 
$route['item-update'] = 'vender/item/item/put'; 

// vender Combo managment
$route['combo-add'] = 'vender/item/item/post/Combo';

// Vender category management
$route['category-list'] = 'vender/category/category/index'; 
$route['category-add'] = 'vender/category/category/post'; 
$route['category-update/(:any)'] = 'vender/category/category/put/$1'; 
$route['category-update'] = 'vender/category/category/index'; 
$route['category-put'] = 'vender/category/category/put'; 
$route['category-delete'] = 'vender/category/category/delete';
$route['category-status'] = 'vender/category/category/active_deactive_category';  

//Vender - Vrient group
$route['variant-group-list'] = 'vender/item/variant_group/index'; 
$route['variant-group-add'] = 'vender/item/variant_group/post'; 
$route['variant-group-delete'] = 'vender/item/variant_group/delete';

//Vender - Vrient group
$route['inventory'] = 'vender/inventory/index'; 
$route['inventory-update'] = 'vender/inventory/put'; 
$route['inventory-view'] = 'vender/inventory/view';

//Vender - Orders
$route['order-processing'] = 'vender/order/order_processing';

//Vender - Shop Employees
$route['employee-list'] = 'vender/employee/employee/index'; 
$route['employee-add'] = 'vender/employee/employee/post'; 
$route['employee-put'] = 'vender/employee/employee/put'; 
$route['employee-delete'] = 'vender/employee/employee/delete'; 
$route['employee-update/(:any)'] = 'vender/employee/employee/put/$1'; 
$route['employee-update'] = 'vender/employee/employee/index'; 
$route['employee-status'] = 'vender/employee/employee/active_deactive_employee'; 

//Promocode
$route['promocode-list'] = 'promocode/promocode/index'; 
$route['promocode-add'] = 'promocode/promocode/post'; 
$route['promocode-delete'] = 'promocode/promocode/delete'; 
$route['promocode-put'] = 'promocode/promocode/put';
$route['promocode-update/(:any)'] = 'promocode/promocode/put/$1'; 
$route['promocode-update'] = 'promocode/promocode/index';
$route['promocode-status'] = 'promocode/promocode/active_deactive_promocode'; 


//Employee
$route['login-employee'] = 'vender/vender_login/login';  
$route['employee-profile'] = 'employee/employee_profile/my_profile';  
$route['employee-change-password'] = 'employee/employee_profile/change_password'; 
// $route['employee-forgot-password'] = 'employee/employee_login/employee_forgot_password'; 

$route['employee-setpassword/(:any)'] = 'employee/employee_login/setpassword/$1'; 
$route['employee-setnewpassword'] = 'employee/employee_login/setpassword'; 

$route['employee-logout'] = 'vender/vender_login/logout'; 


// ADMIN - add admin
$route['admin-list'] = 'admin/admin/admin_list';  
$route['add_admin'] = 'admin/admin/create_new_admin';  
$route['delete-admin'] = 'admin/admin/delete_admin';  
$route['status-admin'] = 'admin/admin/active_deactive_admin';  
$route['login-admin'] = 'admin/admin_login/login';  
$route['logout-admin'] = 'admin/admin_login/logout';  

$route['vender-setpassword/(:any)'] = 'vender/vender_login/setpassword/$1'; 
$route['vender-setnewpassword'] = 'vender/vender_login/setpassword'; 

$route['customer-setpassword/(:any)'] = 'customer/customer_login/setpassword/$1'; 
$route['customer-setnewpassword'] = 'customer/customer_login/setpassword';


// Admin profile - change pw
$route['change-password'] = 'admin/admin/change_password';  
$route['my-profile'] = 'admin/admin/my_profile';  

// Admin - Email Template
$route['email-list'] = 'admin/email_template/index';  
$route['email-update/(:any)'] = 'admin/email_template/put/$1';  
$route['email-save'] = 'admin/email_template/put';  
$route['email-update'] = 'admin/email_template/index';  

// admin - send custom Mail
$route['custom-email-customer'] = 'admin/email_template/custom_email/customer';
$route['custom-email-customer-send'] = 'admin/email_template/custom_email';
$route['custom-email-restaurant'] = 'admin/email_template/custom_email/shop';

//Admin- History
$route['transaction-history'] = 'admin/history/transaction_history'; 
$route['receipt-history'] = 'admin/history/receipt_history'; 
$route['payment-history'] = 'admin/history/payment_history'; 
$route['earning-report'] = 'admin/history/earning_report'; 

// Admin - Vender setting
$route['vender-list'] = 'admin/vender/index'; 
$route['vender-update/(:any)'] = 'admin/vender/put/$1';  
$route['vender-add'] = 'admin/vender/post'; 
$route['vender-save'] = 'admin/vender/post'; 
$route['vender-status'] = 'admin/vender/active_deactive_vender';  
$route['vender-delete'] = 'admin/vender/delete';  
$route['vender-update'] = 'admin/vender/put';  

// admin - vender perc
$route['vender-perc'] = 'admin/vender/vender_perc'; 
$route['vender-perc-update'] = 'admin/vender/put_vender_perc'; 

// Admin - customer setting
$route['customer-list'] = 'admin/customer/index'; 
$route['customer-update/(:any)'] = 'admin/customer/put/$1';  
$route['customer-add'] = 'admin/customer/post'; 
$route['customer-save'] = 'admin/customer/post'; 
$route['customer-status'] = 'admin/customer/active_deactive_customer';  
$route['customer-update'] = 'admin/customer/put';  

// Admin - customer setting
$route['delivery-dispatcher-list'] = 'admin/delivery_dispatcher/index'; 
$route['delivery-dispatcher-update/(:any)'] = 'admin/delivery_dispatcher/put/$1';  
$route['delivery-dispatcher-add'] = 'admin/delivery_dispatcher/post'; 
$route['delivery-dispatcher-save'] = 'admin/delivery_dispatcher/post'; 
$route['delivery-dispatcher-status'] = 'admin/delivery_dispatcher/active_deactive_delivery_dispatcher';  
$route['delivery-dispatcher-update'] = 'admin/delivery_dispatcher/put'; 
$route['delivery-dispatcher-delete'] = 'admin/delivery_dispatcher/delete';

//Admin - cushions
$route['cuisine-list'] = 'admin/cuisine/index';  
$route['location'] = 'admin/cuisine/location';  
$route['cuisine-delete'] = 'admin/cuisine/delete';  
$route['cuisine-status'] = 'admin/cuisine/active_deactive_cuisine';  
$route['cuisine-add'] = 'admin/cuisine/post';  
$route['cuisine-update/(:any)'] = 'admin/cuisine/put/$1'; 
$route['cuisine-update'] = 'admin/cuisine/index';
$route['cuisine-put'] = 'admin/cuisine/put';



// admin - app setting
$route['app-setting'] = 'appsetting/index';  
$route['app-setting-update'] = 'appsetting/put';  

// Admin - Paayment spotal

$route['setup-payment'] = 'admin/setup_payment/index'; 


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//--------------------------------------------------

//Vender

$route['home-page'] = 'user/user/index'; 