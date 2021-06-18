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
use App\Http\Controllers\pdfController;
use Illuminate\Support\Facades\Artisan;

//////////////////////////--------------USER----------//////////////////////////////////////////////////////////////////
Route::get('/','user\HomeController@index');

//FIND PRODUCTS
Route::get('/tim-kiem','user\HomeController@search');
///////////////////////////////---------BRANDS - CATEGORIES---------////////////////////////////////////////////////////

//SHOW PRODUCT BY CATEGORIES
Route::get('/Danh-muc-san-pham/{category_meta_slug}', 'user\CategoryProduct@show_products_from_category');

//SHOW PRODUCT BY BRANDS
Route::get('/thuong-hieu/{brandcode_meta_slug}', 'user\Brand@show_products_from_brand');
//////////////////////////////////------DETAIL PRODUCT------////////////////////////////////////////////////////////////

//DETAIL PRODUCT
Route::get('/chi-tiet/{meta_slug}','user\DetailsProductController@show_details','user\DetailsProductController@insertComment');

//COMMENT DETAIL PRODUCT
Route::post('/chi-tiet/{product_id}','user\DetailsProductController@insertComment');

//    Route::get('/abc','user\HomeController@getAllProduct');


///////////////////----------CART-------////////////////////////////////////////////////////////////////////////////////
///save_product_cart
//SAVE CART AJAX
Route::post('/add-cart-ajax','user\CartController@add_cart_ajax');
//SAVE CART
Route::post('/them-gio-hang','user\CartController@save_product_cart');

//SHOW CART
Route::get('/hien-thi-gio-hang','user\CartController@show_cart');

// REMOVE CART
Route::get('/delete/{rowId}','user\CartController@del_cart');

//REMOVE ALL CART
Route::get('/delete-all/{rowId}','user\CartController@del_cart_all');

//UPDATE CART QUANTITY
Route::post('/update_cart_quantity','user\CartController@update_Cart_quantity');

//Checkout
Route::middleware('prevent-back-history')->group(function () {
	Auth::routes();
	Route::get('/thanh-toan','user\checkoutController@checkout');
});


//ORDER SUCCESS
Route::post('/thanh-toan-don-hang','user\orderController@payment_order');
Route::get('/thanh-toan-don-hang', function(){
   die;
});

/////////////////////////////////////-------NEWS-------/////////////////////////////////////////////////////////////////

Route::get('/tin-tuc-chia-se','user\BlogController@news_client');

//DETAIL NEWS
Route::get('/tin-tuc-chia-se/{meta_slug}','user\BlogController@news_details_client');

//DETAIL INFO ORDER CUSTOMER
route::get('/thong-tin-khach-hang','user\InfocustomerController@info_customer');

//DETAIL INFO ORDER CUSTOMER
route::post('/hien-thi-thong-tin','user\InfocustomerController@info_customer_phone');
route::get('/hien-thi-thong-tin','user\InfocustomerController@info_customer_phone');


//CONTACT CUSTOMER

Route::get('/lien-he', 'user\contactController@layout');

Route::post('/lien-he','user\contactController@insertContact');


/////////////////////////////////////-------PROMOTION--------///////////////////////////////////////////////////////////
Route::get('khuyen-mai', 'user\HomeController@promotion');

//CHOOSE WARDS, CITY, PROVICE BEFORE INSERT (AJAX)
Route::post('/select-delivery','DeliveryController@select_delivery');

//INSERT DELIVERY
Route::post('/add-fee-delivery','DeliveryController@insert_fee_delivery');

//SHOW INFO DELIVERY
Route::get('/select-info-delivery','DeliveryController@select_info_delivery');

//UPdate delivery
Route::get('/update-fee-delivery','DeliveryController@update_fee_delivery');

//Remove delivery
Route::get('/del-fee-delivery','DeliveryController@delete_fee_delivery');

//SEARCH fee_ship DELIVERY
Route::get('/search-fee-ship','DeliveryController@search_fee_delivery');

// feeship when checkout USER
Route::post('/select-delivery-feeship','DeliveryController@select_delivery_feeship');

//LOGO
Route::get('/layout-logo','logowebsiteController@layout_Logo');

//////////////////////////////////----------------DUMP DATABASE-----------------////////////////////////////////////////
//DUMP DATABASE
Route::get('/our_backup_database', 'admin\dumpDatabasesController@backup_database')->name('backup_database');

//Convert status template work
Route::get('/status-template/{id}','admin\configmailController@update_status_template');

//layout detail update template
Route::get('/chi-tiet-template/{id}','admin\configmailController@layout_update_template');

//save uptdate template
Route::post('/update-template-mail/{id}','admin\configmailController@update_template_mail');

//delete layout template
Route::get('/delete-layout-template/{id}','admin\configmailController@delete_template_mail');

//Display template mail used
Route::get('/template-mail','admin\configmailController@templateMail');

//SEND MAIL
Route::post('/send','sendMailController@sendMail');



//TEST MAIL
Route::get('/testmail','sendMailController@test');
//Route::get('/test','sendMailController@abc');
Route::get('/guzzle',function () {
	$client = new \GuzzleHttp\Client();
//    $response = $client->request('GET', 'http://van.local/index.php/api/test/abc&drg&hkg');
//
//    echo $response->getStatusCode(); // 200
//    echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
//    echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
	$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
//    $promise = $client->sendAsync($request)->then(function ($response) {
//        echo 'I completed! ' . $response->getBody();
//    });
//
//    $promise->wait();

	//POST
	$response = $client->request('POST', 'http://httpbin.org/post', [
		'form_params' => [
			'field_name' => 'abc',
			'other_field' => '123',
			'nested_field' => [
				'nested' => 'hello'
			]
		]
	]);
	var_dump($response);
});
