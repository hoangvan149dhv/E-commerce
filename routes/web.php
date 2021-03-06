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
Route::get('/thuong-hieu/{brandcode_meta_slug}', 'user\BrandcodeProduct@show_products_from_brand');
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


Route::get('cc', 'admin\loginController@get_session_userlogin');

////////////////////////////////////////----ADMIN---////////////////////////////////////////////////////////////////////

Route::get('/admin-login', 'admin\loginController@login');

Route::post('/admin-quanly', 'admin\loginController@check_login_user_pass');

Route::get('/admin-quanly', 'admin\AdminController@index');

/////////////////////////////////////////-------Config------/////////////////////////////////////////////////////////////

Route::get('/admin-config', 'admin\configAdmincontroller@configlayout');

Route::post('/save-config', 'admin\configAdmincontroller@updateConfig');
//UPLOAD IMAGE
Route::post('ckeditor/image_upload', 'admin\AdminController@upload')->name('uploads');

//LOGOUT
Route::get('/logout','admin\loginController@log_out');


/////////////////////////////////////////-------ORDER------/////////////////////////////////////////////////////////////
//ORDER MANAGEMENT
Route::get('/admin-quanly-donhang/{order_status}', 'admin\AdminController@order');

/////UPDATE- STATUS ORDER
Route::get('/update-status/{order_id}/{order_status}','admin\AdminController@update_status');

//REMOVE MUTI ORDERS
Route::get('/destroy-order', 'admin\AdminController@destroy_order');

//ORDERS FIND
Route::get('/search-order', 'admin\AdminController@search_order');

//PRODUCTS FIND
Route::post('/tim-kiem-san-pham', 'admin\AdminController@searchProduct');

//SHOP ITEM ORDER DETAIL
Route::get('/order_status', 'admin\AdminController@display_order_status');

//PRINT PDF
Route::get('/print-pdf/{orderId}/{status}', 'pdfController@getTemplateOrder');
////////////////////////////////////////-------CATEGORIES - BRANDS-----/////////////////////////////////////////////////

//ADD CATEGORY
Route::get('/addCategoryProduct', function () {
    return view('admin.categories.addcategoryProduct');
});
//SHOW CATEGORY
Route::get('/allCategoryProduct', 'admin\CategoryProduct@show_Categories');
//SAVE CATEGORY
Route::post('/save-category-product', 'admin\CategoryProduct@save_Category_Product');

//UPDATE CATEGORY
Route::get('/edit-category-product/{category_product_idd}', 'admin\CategoryProduct@edit_Category_Product');

Route::post('/update-category-product/{category_product_idd}', 'admin\CategoryProduct@update_Category_Product');

//DESTROY CATEGOY
Route::get('/destroy', 'admin\CategoryProduct@destroy_Category_Product');



//ACTIVE (ID)
Route::get('/status/{category_product_id}/{status}', 'admin\CategoryProduct@update_status_category');


//BRAND PRODUCT

//add  BRAND
Route::get('/add-Brand-code-Product',function () {
    return view('admin.brands.addBrandProduct');
});
//SHOW BRAND
Route::get('/all-Brand-code-Product', 'admin\BrandcodeProduct@show_Brand');
// SAVE BRAND
Route::post('/save-brandcode-product', 'admin\BrandcodeProduct@save_brandcode_product');

//DELETE BRAND
route::get('/delete-brand-code-product/{brand_code_id}','admin\BrandcodeProduct@delete_brand_code_product');

//UPDATE BRAND
route::get('edit-brand-code-product/{brand_code_id}','admin\BrandcodeProduct@edit_brand_code_product');

route::post('update-brandcode-product/{brand_code_id}','admin\BrandcodeProduct@update_brand_code_Product');



///////////////////////////////////////-------------PRODUCT----------------/////////////////////////////////////////////

//ADD  PRODUCT
Route::get('/add-Product', 'admin\Productcontroller@show_product');
//SHOW PRODUCT
Route::get('/all-Product', 'admin\Productcontroller@all_Product');
// SAVE PRODUCT
Route::post('/save-product', 'admin\Productcontroller@save_product');

//DELETE MUTI PRODUCT
Route::get('/destroy-product', 'admin\Productcontroller@destroy_product');
//UPDATE PRODUCT
route::get('/edit-product/{product_id}','admin\Productcontroller@edit_product');

route::post('/update-product/{product_id}','admin\Productcontroller@update_Product');

//PUSHLISH PRODUCTS
route::get('/check-publish-product/{product_id}/{publish}','admin\Productcontroller@publish');

///////////////////////////////////////////-------INFO CUSTOMER ORDER-------////////////////////////////////////////////
route::get('/thong-tin-don-hang/{order_id}','admin\AdminController@infocustomerorder');


//////////////////////////////////////////-------NEWS----------/////////////////////////////////////////////////////////

//SHOW DISPLAY NEWS
route::get('/add-news', function() {
    return view('admin.news.addnews');
});
//ADD NEWS
route::post('/save-news','admin\newsadminController@insertNews');

//SHOW NEWS
route::get('/all-news','admin\newsadminController@layoutallNews');


route::get('/chi-tiet-bai-viet/{primaryKey}','admin\newsadminController@newsdetails');

route::get('/delete-news/{primaryKey}','admin\newsadminController@delete_news');

//UPDATE NEWS
route::get('edit-news/{primaryKey}','admin\newsadminController@edit_news');

route::post('update-news/{primaryKey}','admin\newsadminController@update_news');


////////////////////////////////////////-------CONTACT-CUSTOMER----------///////////////////////////////////////////////

Route::get('contact','admin\contactController@contactadmin');

Route::get('/update_status_contact/{Con_Id}/{status}','admin\contactController@update_status_contact');



Route::get('/delete_status/{Con_Id}','admin\contactController@delete_status');



Route::get('reviews','admin\reviewsController@reviews');

    Route::get('/delete_review_status/{Con_Id}','admin\reviewsController@delete_status');
//////////////////////////////////-------------------SLIDER---------------------////////////////////////////////////////

//SHOW ADD SLIDER
Route::get('/add-slider', function() {
    return view('admin.slider.addslider');
});
Route::post('/edit-slider','admin\sliderController@add_slider');

//SLIDER MANAGERMENT
route::get('/all-slider','admin\sliderController@slider_all');

Route::post('/update-slider/{id}','admin\sliderController@update_slider');
Route::get('/update-layout-slider/{id}','admin\sliderController@update_layout_slider');

Route::get('/update_status_slider/{id}/{status}','admin\sliderController@update_status_slider');

Route::get('/delete-layout-slider/{id}','admin\sliderController@delete');

Route::get('/destroy-slider','admin\sliderController@destroy');
Route::get('/them-thong-tin','admin\contactinfoController@layout_insert_Infocontact');
Route::post('/save-info-contact','admin\contactinfoController@save_info_contact');

Route::get('/quen-mat-khau','admin\loginController@layout_forget_pass');
Route::post('/lay-mat-khau','admin\loginController@get_pass');

//////////////////////////////////-------------------DELIVERY---------------------//////////////////////////////////////
Route::get('/add-delivery','DeliveryController@layout_add_delivery');

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

///////////////////////////////////////----------------MAIL-----------------////////////////////////////////////////////

//SEND MAIL ORDER
Route::get('/mail-config','admin\configmailController@layoutConfigMail');

//layout create template mail
Route::get('/template-mail-config','admin\configmailController@layoutcreatetemplatemail');

//add template mail
Route::post('/save-template-mail','admin\configmailController@savetemplatemail');
Route::post('/save-config-mail','admin\configmailController@saveConfigmail');

Route::get('/all-template-mail', 'admin\configmailController@listitemtemplatemail');

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

Route::get('/send-test-mail','sendMailController@sendtestMail');

/////////////////////////////////////////////////////////-----CLEAR CACHE-----///////////////////////////////////////////////////////////
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return back();
});

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
