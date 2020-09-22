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

//////////////////////////--------------USER----------//////////////////////////////////////////////////////////////////
Route::get('/','HomeController@index');

Route::get('/trang-chu','HomeController@index');

//FIND PRODUCTS
Route::post('tim-kiem','HomeController@search');
Route::get('tim-kiem','HomeController@search_product');
///////////////////////////////---------BRANDS - CATEGORIES---------////////////////////////////////////////////////////

//SHOW PRODUCT BY CATEGORIES
Route::get('/Danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');
Route::get('/Danh-muc-san-pham/{category_idd}', 'CategoryProduct@show_category');

//SHOW PRODUCT BY BRANDS
Route::get('/thuong-hieu/{brandcode_id}', 'BrandcodeProduct@show_brand_home');
//////////////////////////////////------DETAIL PRODUCT------////////////////////////////////////////////////////////////

//DETAIL PRODUCT
Route::get('/chi-tiet/{meta_slug}','DetailsProductController@show_details','DetailsProductController@insertComment');

//COMMENT DETAIL PRODUCT
Route::post('/chi-tiet/{product_id}','DetailsProductController@insertComment');



///////////////////----------CART-------////////////////////////////////////////////////////////////////////////////////
///
//SAVE CART AJAX
Route::post('/add-cart-ajax','CartController@save_cart_ajax');
//SAVE CART
Route::post('/them-gio-hang','CartController@save_product_cart');

//SHOW CART
Route::get('/hien-thi-gio-hang','CartController@show_cart');

// REMOVE CART
Route::get('/delete/{rowId}','CartController@del_cart');

//REMOVE ALL CART
Route::get('/delete-all/{rowId}','CartController@del_cart_all');

//UPDATE CART QUANTITY
Route::post('/update_cart_quantity','CartController@update_Category_quantity');


//ORDER SUCCESS
Route::post('/thanh-toan-gio-hang','Payment_orderController@payment_order');
Route::get('/thanh-toan-gio-hang','Payment_orderController@payment_order');


/////////////////////////////////////-------NEWS-------/////////////////////////////////////////////////////////////////

Route::get('/tin-tuc-chia-se','newsadminController@news_client');

//DETAIL NEWS
Route::get('/tin-tuc-chia-se/{primary_id}','newsadminController@newsdetails_client');

//DETAIL INFO ORDER CUSTOMER
route::get('/thong-tin-khach-hang','InfocustomerController@info_customer');

//DETAIL INFO ORDER CUSTOMER
route::post('/hien-thi-thong-tin','InfocustomerController@info_customer_phone');
route::get('/hien-thi-thong-tin','InfocustomerController@info_customer_phone');


//CONTACT CUSTOMER
Route::get('/lien-he','contactController@Contact');
Route::post('/lien-he','contactController@insertContact');


/////////////////////////////////////-------PROMOTION--------///////////////////////////////////////////////////////////
Route::get('khuyen-mai', 'HomeController@promotion');




////////////////////////////////////////----ADMIN---////////////////////////////////////////////////////////////////////

Route::get('/admin-login', 'AdminController@login');

Route::post('/admin-quanly', 'AdminController@check_login');

Route::get('/admin-quanly', 'AdminController@index');

//ORDER MANAGEMENT
Route::get('/admin-quanly-donhang', 'AdminController@order');

//UPLOAD IMAGE
Route::post('ckeditor/image_upload', 'AdminController@upload')->name('uploads');

//LOGOUT
Route::get('/logout','AdminController@log_out');


/////////////////////////////////////////-------ORDER------/////////////////////////////////////////////////////////////

/////UPDATE- STATUS ORDER
Route::get('/update-status-0/{order_id}','AdminController@update_status_0');
//UPDATE- STATUS ORDER
Route::get('/update-status-1/{order_id}','AdminController@update_status_1');

//DELETE STATUS ORDER COMPLETE
Route::get('/delete-status-1/{order_id}','AdminController@delete_status_1');
//REMOVE MUTI ORDERS
Route::get('/destroy-order', 'AdminController@destroy_order');

//ORDERS FIND
Route::post('/tim-kiem-admin', 'AdminController@search_order');
Route::get('/tim-kiem-admin', 'AdminController@search_product_order');

//PRODUCTS FIND
Route::post('/tim-kiem-san-pham', 'AdminController@searchProduct');
Route::get('/tim-kiem-san-pham', 'AdminController@searchProduct_item');

//UNFINIGH ORDERS
Route::get('/order_not_complete', 'AdminController@order_not_complete');

//ORDERS COMPLETE
Route::get('/order_complete', 'AdminController@order_complete');


////////////////////////////////////////-------CATEGORIES - BRANDS-----/////////////////////////////////////////////////

//ADD CATEGORY
Route::get('/addCategoryProduct', 'CategoryProduct@add_Category_Product');
//SHOW CATEGORY
Route::get('/allCategoryProduct', 'CategoryProduct@all_Category_Product');
//SAVE CATEGORY
Route::post('/save-category-product', 'CategoryProduct@save_Category_Product');

//UPDATE CATEGORY
Route::get('/edit-category-product/{category_product_idd}', 'CategoryProduct@edit_Category_Product');

Route::post('/update-category-product/{category_product_idd}', 'CategoryProduct@update_Category_Product');

//DELETE CATEGORY
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_Category_Product');

//DESTROY CATEGOY
Route::get('/destroy', 'CategoryProduct@destroy_Category_Product');



//ACTIVE (ID)
Route::get('/active/{category_product_idd}', 'CategoryProduct@active_Category_Product');

//UNACTIVE (ID)
Route::get('/unactive/{category_product_idd}', 'CategoryProduct@unactive_Category_Product');



//BRAND PRODUCT

//add  BRAND
Route::get('/add-Brand-code-Product', 'BrandcodeProduct@add_Brand_code_Product');
//SHOW BRAND
Route::get('/all-Brand-code-Product', 'BrandcodeProduct@all_Brand_code_Product');
// SAVE BRAND
Route::post('/save-brandcode-product', 'BrandcodeProduct@save_brandcode_product');

//DELETE BRAND
route::get('/delete-brand-code-product/{brand_code_id}','BrandcodeProduct@delete_brand_code_product');

//UPDATE BRAND
route::get('edit-brand-code-product/{brand_code_id}','BrandcodeProduct@edit_brand_code_product');

route::post('update-brandcode-product/{brand_code_id}','BrandcodeProduct@update_brand_code_Product');



///////////////////////////////////////-------------PRODUCT----------------/////////////////////////////////////////////

//ADD  PRODUCT
Route::get('/add-Product', 'Productcontroller@add_Product');
//SHOW PRODUCT
Route::get('/all-Product', 'Productcontroller@all_Product');
// SAVE PRODUCT
Route::post('/save-product', 'Productcontroller@save_product');

//DELETE PRODUCT
route::get('/delete-product/{product_id}','Productcontroller@delete_product');

//DELETE MUTI PRODUCT
Route::get('/destroy-product', 'Productcontroller@destroy_product');
//UPDATE PRODUCT
route::get('edit-product/{product_id}','Productcontroller@edit_product');

route::post('update-product/{product_id}','Productcontroller@update_Product');


///////////////////////////////////////////-------INFO CUSTOMER ORDER-------////////////////////////////////////////////
route::get('/thong-tin-don-hang/{order_id}','AdminController@infocustomerorder');


//////////////////////////////////////////-------NEWS----------/////////////////////////////////////////////////////////

//SHOW DISPLAY NEWS
route::get('/add-news','newsadminController@layoutaddNews');
//ADD NEWS
route::post('/save-news','newsadminController@insertNews');

//SHOW NEWS
route::get('/all-news','newsadminController@layoutallNews');


route::get('/chi-tiet-bai-viet/{primaryKey}','newsadminController@newsdetails');

route::get('/delete-news/{primaryKey}','newsadminController@delete_news');

//UPDATE NEWS
route::get('edit-news/{primaryKey}','newsadminController@edit_news');

route::post('update-news/{primaryKey}','newsadminController@update_news');


////////////////////////////////////////-------CONTACT-CUSTOMER----------///////////////////////////////////////////////

Route::get('contact','contactController@contactadmin');

Route::get('/updatestatus-0/{Con_Id}','contactController@update_status_0');

Route::get('/updatestatus-1/{Con_Id}','contactController@update_status_1');


Route::get('/deletestatus-1/{Con_Id}','contactController@delete_status_1');



Route::get('reviews','reviewsController@reviews');

Route::get('/deletestatus1/{Con_Id}','reviewsController@delete_status_1');

//////////////////////////////////-------------------SLIDER---------------------////////////////////////////////////////

//SHOW ADD SLIDER
Route::get('/add-slider','sliderController@slider_layout');
Route::post('/edit-slider','sliderController@add_slider');

//SLIDER MANAGERMENT
route::get('/all-slider','sliderController@slider_all');

Route::post('/update-slider/{id}','sliderController@update_slider');
Route::get('/update-layout-slider/{id}','sliderController@update_layout_slider');

Route::get('/status-0/{id}','sliderController@status_0');

Route::get('/status-1/{id}','sliderController@status_1');

Route::get('/delete-layout-slider/{id}','sliderController@delete');

Route::get('/destroy-slider','sliderController@destroy');
Route::get('/them-thong-tin/{id}','contactinfoController@layout_insert_Infocontact');
Route::post('/save-info-contact','contactinfoController@save_info_contact');

Route::get('/quen-mat-khau','AdminController@layout_forget_pass');
Route::post('/lay-mat-khau','AdminController@get_pass');

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
Route::get('/our_backup_database', 'dumpDatabasesController@backup_database')->name('backup_database');

///////////////////////////////////////----------------MAIL-----------------////////////////////////////////////////////

//SEND MAIL ORDER
Route::get('/mail-config','sendMailController@layoutConfigMail');

//layout create template mail
Route::get('/template-mail-config','sendMailController@layoutcreatetemplatemail');

//add template mail
Route::post('/save-template-mail','sendMailController@savetemplatemail');
Route::post('/save-config-mail','sendMailController@saveConfigmail');

Route::get('/all-template-mail', 'sendMailController@listitemtemplatemail');

//Convert status template work
Route::get('/status-template/{id}','sendMailController@update_status');

//layout detail update template
Route::get('/chi-tiet-template/{id}','sendMailController@layout_update_template');

//save uptdate template
Route::post('/update-template-mail/{id}','sendMailController@update_template_mail');

//delete layout template
Route::get('/delete-layout-template/{id}','sendMailController@delete_template_mail');

//Display template mail used
Route::get('/template-mail','sendMailController@templateMail');
//SEND MAIL
Route::post('/send','sendMailController@sendMail');

//TEST MAIL
Route::get('/testmail','sendMailController@test');
Route::get('/test',function (){
    return view('mailform');
});
