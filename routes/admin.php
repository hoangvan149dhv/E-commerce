<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([ 'name' => 'admin.'],function () {
    Route::post('/admin-quanly', 'admin\loginController@check_login');

    //LOGOUT
    Route::get('/logout','admin\loginController@log_out');
});

//////////////////////////////////-------------------DELIVERY---------------------//////////////////////////////////////
Route::get('/add-delivery','DeliveryController@layout_add_delivery');
//////////////////////////////////----------------DUMP DATABASE-----------------////////////////////////////////////////
//DUMP DATABASE
Route::group([ 'name' => 'admin.', 'middleware' => 'verfiy-account'],function () {
    Route::get('/admin-login', 'admin\loginController@login');
    Route::get('/admin-quanly', 'admin\AdminController@index');
    Route::get('/our_backup_database', 'admin\dumpDatabasesController@backup_database')->name('backup_database');

    //Print P
    Route::get('/print-pdf/{orderId}/{status}', 'pdfController@getTemplateOrder');
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

    //Send test m
    Route::get('/send-test-mail','sendMailController@sendtestMail');
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


////////////////////////////////////////----ADMIN---////////////////////////////////////////////////////////////////////


/////////////////////////////////////////-------Config------/////////////////////////////////////////////////////////////

    Route::get('/admin-config', 'admin\configAdmincontroller@configlayout');

    Route::post('/save-config', 'admin\configAdmincontroller@updateConfig');
//UPLOAD IMAGE
    Route::post('ckeditor/image_upload', 'admin\AdminController@upload')->name('uploads');




/////////////////////////////////////////-------ORDER------/////////////////////////////////////////////////////////////
//ORDER MANAGEMENT
    Route::get('/admin-quanly-donhang/{order_status}', 'admin\AdminController@order');

/////UPDATE- STATUS ORDER
    Route::get('/update-status/{order_id}/{order_status}','admin\AdminController@update_status');

//REMOVE MUTI ORDERS
    Route::get('/destroy-order', 'admin\AdminController@destroy_order');

//ORDERS FIND
//    Route::post('/search-order', 'admin\AdminController@search_order');

//PRODUCTS FIND
    Route::post('/tim-kiem-san-pham', 'admin\AdminController@searchProduct');

//SHOP ITEM ORDER DETAIL
    Route::get('/order_status', 'admin\AdminController@display_order_status');
    /////////////////////////////////////////////////////////-----CLEAR CACHE-----///////////////////////////////////////////////////////////
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return back();
    });
});

