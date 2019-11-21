<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/', 'Theme\HomeController@index')->name('home');
// Route::get('affiliate', 'Theme\HomeController@showAffiliate')->name('affiliate');
//Route::get('get-pound', 'Theme\HomeController@GetPoundEuro')->name('get-pound');
Route::get('user/dashboard', 'UserController@index')->name('user-dashboard');
Route::get('account-setting', 'UserController@accountSetting')->name('users.account_setting');
Route::post('account-update', 'UserController@accountUpdate')->name('users.account_update');

Route::get('invoice', 'Theme\HomeController@invoice')->name('invoice');
Route::get('invoice', 'Theme\HomeController@invoice')->name('invoice');
Route::post('invoice-store', 'Theme\HomeController@invoiceStore')->name('invoice-store');
Route::post('invoice-self-email', 'Theme\HomeController@self_Email')->name('invoice_self_email');
Route::get('generate-pdf/{id}','Theme\HomeController@generatePDF')->name('generate-pdf');
//Route::get('email-status','Theme\HomeController@emailStatus')->name('email_status');



Route::post('invoice-image', 'Theme\HomeController@logoImage')->name('invoice-image');
Route::post('invoice-store-remove', 'Theme\HomeController@logo_image_remove')->name('invoice-store-remove');

// Route::get('cancel-orders', 'UserController@getCancelOrder')->name('get-cancel-orders');
// Route::post('search-orders', 'UserController@getSearchOrder')->name('get-search-orders');
Route::get('user/edit/', 'UserController@edit')->name('user-edit');
Route::post('user/update/', 'UserController@update')->name('user-update');
// Route::get('cancel-order/{id}', 'UserController@cancelOrder')->name('cancel-order');
Route::get('show-invoice/{id}', 'UserController@showInvoice')->name('show-invoice');
Route::get('show-invoice/{id}/edit', 'Theme\HomeController@edit')->name('show-invoice-edit');
Route::post('show-invoice/{id}/update', 'Theme\HomeController@update')->name('show-invoice-update');
Route::get('show-invoice/{id}/delete', 'Theme\HomeController@destroy')->name('show-invoice-delete');

Route::view('/static-email', 'themes.main-theme.home.static-invoice');

// Route::get('export-pdf/{id}', 'UserController@exportPdf')->name('export-pdf');
// Route::get('make-payment/{id}', 'UserOrdersController@makePayment')->name('make-payment');
// Route::get('make-payment-paypal/{id}', 'UserOrdersController@makePaymentPayPal')->name('make-payment-paypal');
// Route::post('checkout', 'UserOrdersController@CheckOut')->name('processCheckout');
// Route::post('checkout-paypal', 'UserOrdersController@ProcessPayPalCheckout')->name('processCheckoutPaypal');
// Route::post('add-affiliate', 'Theme\HomeController@addAffiliate')->name('add-affiliate');
// route for check status of the payment
Route::get('status/{id}', 'UserOrdersController@getPaymentStatus');

Route::post('service-item/detail', 'Theme\HomeController@getServiceItemDetail')->name('getServiceItem');
Route::get('service-item/{slug}','Theme\HomeController@itemOrder')->where('slug','[\w\d\-\_]+');
Route::get('services/place-order/{slug}','Theme\HomeController@itemOrder')->where('slug','[\w\d\-\_]+');

Route::post('process-contact', 'Theme\HomeController@processContact')->name('process-contact');
Route::post('add-order', 'UserOrdersController@store')->name('add-order');
Route::get('session-order', 'UserOrdersController@sessionStore')->name('session-order');


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile/{id}', 'AdminController@edit')->name('admin-profile');
    Route::patch('/update/{id}', 'AdminController@update')->name('admin-update');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group([
    'middleware'    => ['auth:admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{

    //User Routes
    Route::resource('users','UsersController');
    Route::get('users/edit/{id}', 'UsersController@edit')->name('company-edit');
    Route::post('get-users', 'UsersController@getUsers')->name('admin.getUsers');
    Route::get('users/delete/{id}', 'UsersController@destroy')->name('user-delete');
    Route::post('delete-selected-users', 'UsersController@DeleteSelectedUsers')->name('delete-selected-users');
    Route::get('edit-profile/{id}', 'UsersController@show')->name('edit-profile');

    //Staff Routes
    Route::resource('staff','StaffController');
    Route::get('staff/edit/{id}', 'StaffController@edit')->name('company-edit');
    Route::post('get-staff', 'StaffController@getStaff')->name('admin.getStaff');
    Route::get('staff/delete/{id}', 'StaffController@destroy')->name('staff-delete');
    Route::post('delete-selected-staff', 'StaffController@DeleteSelectedStaff')->name('delete-selected-staff');
    Route::get('edit-profile/{id}', 'StaffController@show')->name('edit-profile');

    //Setting Routes
    Route::resource('settings','SettingsController');
});
