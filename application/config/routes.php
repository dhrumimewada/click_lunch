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
$route['default_controller'] = 'welcome';
//$route['default_controller'] = 'web/welcome';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'admin/admin_login/login';

$route['register'] = 'register';
$route['home'] = 'home/index';
 
$route['dashboard'] = 'welcome/index';  
$route['form'] = 'welcome/form_validation';  
$route['profile'] = 'welcome/profile';  
$route['table'] = 'table/index'; 
$route['error-page'] = 'welcome/error_page'; 
$route['maintenance1'] = 'welcome/maintenance'; 
$route['maintenance2'] = 'welcome/maintenance'; 
$route['maintenance3'] = 'welcome/maintenance'; 
$route['maintenance4'] = 'welcome/maintenance'; 
$route['maintenance5'] = 'welcome/maintenance'; 
$route['maintenance6'] = 'welcome/maintenance'; 
$route['maintenance7'] = 'welcome/maintenance'; 
$route['maintenance8'] = 'welcome/maintenance'; 
$route['maintenance9'] = 'welcome/maintenance'; 
$route['maintenance10'] = 'welcome/maintenance'; 

// Vender
$route['login-vender'] = 'vender/vender_login/login';    
$route['vender-profile'] = 'vender/vender_profile/my_profile';  
$route['vender-change-password'] = 'vender/vender_profile/change_password'; 
$route['vender-forgot-password'] = 'vender/vender_login/vender_forgot_password'; 
$route['vender-reset-password/(:any)'] = 'vender/vender_login/vender_reset_password/$1'; 
$route['vender-reset-password'] = 'vender/vender_login/vender_reset_password'; 
$route['vender-logout'] = 'vender/vender_login/logout'; 

$route['vender-dashboard'] = 'vender/dashboard/vender_dashboard';  

// Vender item managment
$route['item-list'] = 'vender/item/item/index'; 
$route['item-delete'] = 'vender/item/item/delete';
$route['item-status'] = 'vender/item/item/active_deactive_item'; 
$route['item-recommended'] = 'vender/item/item/recommended_item'; 
$route['item-add'] = 'vender/item/item/post/Product'; 
$route['item-update/(:any)'] = 'vender/item/item/put/$1'; 
$route['item-update'] = 'vender/item/item/put'; 

// vender Combo managment
$route['combo-add'] = 'vender/item/item/post/Combo';

//Vender - Vrient group
$route['variant-group-list'] = 'vender/item/variant_group/index'; 
$route['variant-group-add'] = 'vender/item/variant_group/post'; 
$route['variant-group-delete'] = 'vender/item/variant_group/delete';

//Vender - Vrient group
$route['inventory'] = 'vender/inventory/index'; 
// $route['inventory-update'] = 'vender/inventory/put'; 
$route['inventory-view'] = 'vender/inventory/view';
$route['inventory-update'] = 'vender/inventory/put';

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

$route['get-products'] = 'promocode/promocode/get_products_by_shop';
$route['promocode-customer-detail/(:any)'] = 'promocode/promocode/get_promocode_customer_detail/$1';
$route['eligible-customer-list/(:any)'] = 'promocode/promocode/eligible_customer_list/$1';

//Employee
$route['login-employee'] = 'employee/employee_login/login';
$route['employee-profile'] = 'employee/employee_profile/my_profile';  
$route['employee-change-password'] = 'employee/employee_profile/change_password'; 
$route['employee-forgot-password'] = 'employee/employee_login/employee_forgot_password'; 

$route['employee-setpassword/(:any)'] = 'employee/employee_login/setpassword/$1'; 
$route['employee-setnewpassword'] = 'employee/employee_login/setpassword'; 

$route['employee-reset-password/(:any)'] = 'employee/employee_login/employee_reset_password/$1'; 
$route['employee-reset-password'] = 'employee/employee_login/employee_reset_password'; 

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

$route['dispatcher-setpassword/(:any)'] = 'dispatcher/dispatcher_login/setpassword/$1';
$route['dispatcher-setnewpassword'] = 'dispatcher/dispatcher_login/setpassword';


// Admin profile - change pw
$route['change-password'] = 'admin/admin/change_password';  
$route['my-profile'] = 'admin/admin/my_profile';  

// Admin - Email Template
$route['email-list'] = 'admin/email_template/index';  
$route['email-update/(:any)'] = 'admin/email_template/put/$1';  
$route['email-save'] = 'admin/email_template/put';  
$route['email-update'] = 'admin/email_template/index';  

// admin - send custom Mail
$route['custom-email-customer'] = 'admin/email_template/custom_email_customer';
$route['custom-email-send'] = 'admin/email_template/custom_email';
$route['custom-email-restaurant'] = 'admin/email_template/custom_email/shop';
$route['custom-email-deliveryboy'] = 'admin/email_template/custom_email/delivery_boy';

// admin - send custom push
$route['custom-push-customer'] = 'admin/email_template/custom_push_customer';
$route['custom-push-restaurant'] = 'admin/email_template/custom_push_shop';

// admin & dispatcher- send custom push to deliebry boy
$route['custom-push-deliveryboy'] = 'admin/custom_push/custom_push_deliveryboy';

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
$route['vender-resend-activation-mail/(:num)'] = 'admin/vender/vender_resend_activation_mail/$1';  

// admin - shop requests list
$route['vender-requests'] = 'admin/vender/vendor_requests'; 
$route['vender-request-save'] = 'admin/vender/vendor_request_put';
$route['vender-request-update/(:any)'] = 'admin/vender/vendor_request_put/$1';
$route['vender-request-delete'] = 'admin/vender/delete';
$route['vender-request-accept'] = 'admin/vender/vendor_request_accept';

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

//Admin - cuisine
$route['cuisine-list'] = 'admin/cuisine/index';  
$route['location'] = 'admin/cuisine/location';  
$route['cuisine-delete'] = 'admin/cuisine/delete';  
$route['cuisine-status'] = 'admin/cuisine/active_deactive_cuisine';  
$route['cuisine-add'] = 'admin/cuisine/post';  
$route['cuisine-update/(:any)'] = 'admin/cuisine/put/$1'; 
$route['cuisine-update'] = 'admin/cuisine/index';
$route['cuisine-put'] = 'admin/cuisine/put';

//Admin - Category
$route['category-list'] = 'admin/category/index';  
$route['category-delete'] = 'admin/category/delete';  
$route['category-status'] = 'admin/category/active_deactive_category';  
$route['category-add'] = 'admin/category/post';  
$route['category-update/(:any)'] = 'admin/category/put/$1'; 
$route['category-update'] = 'admin/category/index';
$route['category-put'] = 'admin/category/put';

//Admin - banner
$route['banner-list'] = 'admin/banner/index'; 
$route['banner-add'] = 'admin/banner/post'; 
$route['banner-delete'] = 'admin/banner/delete';  
$route['banner-update/(:any)'] = 'admin/banner/put/$1';
$route['banner-put'] = 'admin/banner/put';
$route['banner-status'] = 'admin/banner/active_deactive_banner'; 

$route['highlight-list'] = 'admin/banner/highlight';
$route['highlight-update/(:any)'] = 'admin/banner/highlight_put/$1';
$route['highlight-update'] = 'admin/banner/highlight_put';

// Admin - app setting
$route['app-setting'] = 'appsetting/index';  
$route['app-setting-update'] = 'appsetting/put';  

$route['setting'] = 'admin/setting/index';  
$route['admin-setting-update'] = 'admin/setting/put';

// Admin - Paayment spotal
$route['setup-payment'] = 'admin/setup_payment/index'; 

// Admin - Popular Location
$route['popular-location-list'] = 'admin/popular_location/index';
$route['popular-location-add'] = 'admin/popular_location/post';  
$route['popular-location-delete'] = 'admin/popular_location/delete';
$route['popular-location-requests'] = 'admin/popular_location/popular_location_requests';
$route['location-request-delete'] = 'admin/popular_location/request_delete';
$route['location-request-accept'] = 'admin/popular_location/request_accept';

// Admin - All orders
$route['delivery-orders'] = 'admin/orders/delivery_orders';
$route['takeout-orders'] = 'admin/orders/takeout_orders';
$route['weekly-orders'] = 'admin/orders/weekly_orders';

$route['contact-us-data'] = 'admin/contact_us/index'; 
$route['contact-us-delete'] = 'admin/contact_us/delete'; 

//Dispatcher
$route['login-dispatcher'] = 'dispatcher/dispatcher_login/login';
$route['dispatcher-dashboard'] = 'dispatcher/dispatcher/dashboard';  
$route['dispatcher-profile'] = 'dispatcher/dispatcher/profile';
$route['dispatcher-change-password'] = 'dispatcher/dispatcher/change_password';
$route['dispatcher-logout'] = 'dispatcher/dispatcher_login/logout';

// Delivery Boy
$route['delivery-boy-list'] = 'dispatcher/delivery_boy/index'; 
$route['delivery-boy-update/(:any)'] = 'dispatcher/delivery_boy/put/$1';  
$route['delivery-boy-add'] = 'dispatcher/delivery_boy/post'; 
$route['delivery-boy-save'] = 'dispatcher/delivery_boy/post'; 
$route['delivery-boy-status'] = 'dispatcher/delivery_boy/active_deactive_delivery_boy';  
$route['delivery-boy-update'] = 'dispatcher/delivery_boy/put';

// Dispatcher
$route['order-single-assign'] = 'dispatcher/order/order_new';
$route['order-status-update'] = 'dispatcher/order/order_status_update';
$route['order-detail/(:any)'] = 'dispatcher/order/order_detail/$1';

$route['order-accepted'] = 'vender/order/accepted';
$route['order-rejected'] = 'vender/order/rejected';
$route['order-today'] = 'vender/order/today';
$route['order-upcoming'] = 'vender/order/upcoming';
$route['order-completed'] = 'vender/order/completed';
$route['order-trashed'] = 'vender/order/trashed';
$route['order-all'] = 'vender/order/all';
$route['vender-order-detail/(:any)'] = 'vender/order/order_detail/$1';

$route['fetch-db'] = 'dispatcher/order/get_all_db';
$route['set-db'] = 'dispatcher/order/set_db';

$route['quantity-update-reject-order'] = 'dispatcher/order/quantity_update_reject_order';

$route['all-orders'] = 'dispatcher/order/all_orders';
$route['new-orders'] = 'dispatcher/order/db_assigned_orders';
$route['live-orders'] = 'dispatcher/order/live_orders';
$route['cancel-orders'] = 'dispatcher/order/cancel_orders';
$route['completed-orders'] = 'dispatcher/order/completed_orders';
$route['all-weekly-orders'] = 'dispatcher/order/weekly_orders';

//--------------------------------------------------

//Vender

$route['home-page'] = 'user/user/index'; 

// vender  - email
$route['vender-custom-email-customer'] = 'vender/email_push/custom_email_customer';
$route['vender-custom-push-customer'] = 'vender/email_push/custom_push_customer';

// API
$route['customer-activate/(:any)'] = 'customer/customer_login/activate_account/$1';
$route['customer-reset-password/(:any)'] = 'customer/customer_login/reset_password/$1';
$route['customer-reset-password'] = 'customer/customer_login/reset_password';

$route['delivery-boy-reset-password/(:any)'] = 'dispatcher/dispatcher_login/deliveryboy_reset_password/$1';
$route['delivery-boy-reset-password'] = 'dispatcher/dispatcher_login/deliveryboy_reset_password';


// Front
$route['welcome'] = 'web/welcome';
$route['get-shops'] = 'web/welcome/get_shops';
$route['restaurant/(:any)/(:any)/(:any)'] = 'web/welcome/shop/$1/$2/$3';
$route['product/(:any)/(:any)'] = 'web/welcome/item/$1/$2';
$route['cart'] = 'web/cart/my_cart';
$route['add-to-cart/(:any)'] = 'web/cart/cart_add/$1';
$route['cart-destroy'] = 'web/cart/cart_destroy';
$route['cart-item-delete'] = 'web/cart/cart_item_delete';
$route['get-cart-item-data'] = 'web/cart/get_cart_item_data';
$route['update-cart-item-data'] = 'web/cart/update_cart_item_data';
$route['get-recommendation-item-data'] = 'web/cart/get_recommendation_item_data';
$route['add-recommended-item-cart'] = 'web/cart/add_recommendation_item_cart';
$route['add-direct-recommended-item-cart/(:any)'] = 'web/cart/add_direct_recommendation_item_cart/$1';

$route['check-exists-cart'] = 'web/cart/check_exists_cart';

$route['update-quantity'] = 'web/cart/update_quantity';
$route['subscribe'] = 'web/welcome/subscribe';
$route['faq'] = 'web/welcome/faq';
$route['restaurant-partner-form'] = 'web/welcome/restaurant_partner_form';
$route['weekly-planner'] = 'web/welcome/weekly_planner';
$route['delivery-restaurants'] = 'web/welcome/delivery_restaurants';
$route['takeout-restaurants'] = 'web/welcome/takeout_restaurants';

$route['add-request-address'] = 'web/welcome/request_add_popular_address';


/*Customer login - register */
$route['register'] = 'web/welcome/register';
$route['email-check-availability'] = 'web/welcome/email_check_availability';
$route['number-check-availability'] = 'web/welcome/number_check_availability';
$route['register-customer'] = 'web/welcome/register_customer';
$route['login-customer'] = 'web/welcome/login_customer';
$route['forgot-password-customer'] = 'web/welcome/forgot_password_customer';
$route['customer-logout'] = 'web/welcome/logout';

$route['customer-add-address'] = 'web/profile/add_address';
$route['choose-address'] = 'web/profile/all_address';
$route['customer-set-address'] = 'web/profile/set_address';
$route['my-delievry-address/(:any)'] = 'web/profile/my_delievry_address/$1';
$route['delete-delievry-address'] = 'web/profile/delete_delievry_address';
$route['update-delievry-address'] = 'web/profile/update_delievry_address';

$route['contact-info'] = 'web/profile/update_profile';
$route['reset-password'] = 'web/profile/update_password';
$route['customer-payment-setting'] = 'web/profile/payment_setting';
$route['customer-payment-setting/(:any)'] = 'web/profile/payment_setting/$1';
$route['payment-card-delete'] = 'web/profile/payment_card_delete';

$route['change-location'] = 'web/profile/change_location';
$route['checkout'] = 'web/checkout';
$route['apply-promocode/(:any)'] = 'web/cart/set_promocode/$1';
$route['promocode-remove'] = 'web/cart/promocode_remove';
$route['add-card'] = 'web/checkout/add_card';
$route['get-promocode-data'] = 'web/checkout/get_promocode_data';
$route['validate-promocode'] = 'web/checkout/validate_promocode';
$route['place-order'] = 'web/checkout/place_order';
$route['order-success/(:any)'] = 'web/checkout/order_success/$1';

$route['order-history'] = 'web/profile/order_history';
$route['order-history/(:num)'] = 'web/profile/order_history';
$route['favourite-status-update'] = 'web/profile/favourite_status_update';
$route['get-cuisine'] = 'web/profile/get_cuisine';
$route['get-order-history-filtered'] = 'web/profile/get_order_history_filtered';

$route['terms-of-service'] = 'web/welcome/terms_service';
$route['about-us'] = 'web/welcome/about_us';
$route['contact-us'] = 'web/welcome/contact_us';
$route['coming-soon'] = 'web/welcome/coming_soon';

$route['favourite-orders'] = 'web/profile/get_favourite_orders';

$route['get-shops-by-filter'] = 'web/welcome/get_shops_by_filter';
$route['set-order-type-session'] = 'web/welcome/set_order_type_session';






