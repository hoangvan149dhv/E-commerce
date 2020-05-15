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
//đặt TÊN TRÊN URL
//LÀM VIỆC VỚI  USER
Route::get('/','HomeController@index'); // TRIỆU GỌI HÀM trong controller->homeController->gọi hàm index dòng 10

Route::get('/trang-chu','HomeController@index'); // TRẢ VỀ trang chủ

//TIM-KIEM
Route::post('tim-kiem','HomeController@search');\
Route::get('tim-kiem','HomeController@search_product');
//////////////////////////---------DANH MỤC, THƯƠNG HIỆU////////////////////////////////////////////////////
//LẤY RA SẢN PHẨM CỦA DANH MỤC ĐÓ
Route::get('/Danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');
Route::get('/Danh-muc-san-pham/{category_idd}', 'CategoryProduct@show_category');

//LẤY RA SẢN PHẨM CỦA THƯƠNG HIỆU
Route::get('/thuong-hieu/{brandcode_id}', 'BrandcodeProduct@show_brand_home');
//////////////////////////------CHI TIẾT SP////////////////////////////////////////////////////

//CHI-TIẾT-SẢN-PHẨM
Route::get('/chi-tiet/{meta_slug}','DetailsProductController@show_details','DetailsProductController@insertComment');
// Route::get('/hien-thi-gio-hang/{product_id}','DetailsProductController@show_details_cart');
//////////////////////////------bình luận////////////////////////////////////////////////////
//bình-luận khách hàng
// Route::post('/chi-tiet/{product_id}', 'reviewController@insertComment');
Route::post('/chi-tiet/{product_id}','DetailsProductController@insertComment');



///////////////////----------GIỎ HÀNG-------/////////////////////////////////////////////////////////////////////////////////////
//LƯU GIỎ HÀNG BẰNG AJAX
Route::post('/add-cart-ajax','CartController@save_cart_ajax');
//LƯU SẢN PHẨM VÀO GIỎ HÀNG
Route::post('/them-gio-hang','CartController@save_product_cart');

//show CART
Route::get('/hien-thi-gio-hang','CartController@show_cart');

// delete cart
Route::get('/delete/{rowId}','CartController@del_cart');
// Route::get('/hien-thi-gio-hang/{rowId}','CartController@del_cartajax'); //DELETE CARRT AJJAX
//DELETE ALL
Route::get('/delete-all/{rowId}','CartController@del_cart_all');
//update_cart_quantity
Route::post('/update_cart_quantity','CartController@update_Category_quantity');
////////////////////////////////////////////////////////////////////////////////////////////////////////


//THANH TOÁN THÀNH CÔNG
Route::post('/thanh-toan-gio-hang','Payment_orderController@payment_order');
Route::get('/thanh-toan-gio-hang','Payment_orderController@payment_order'); //BẮC BUỘC VÌ BẢO MẬT
/////////////////////////////////////-------/////////////////////////////////////-------
/////////////////////////////////////-------TIN TỨC-------/////////////////////////////////////////////////////////////////////
Route::get('/tin-tuc-chia-se','newsadminController@news_client');
//chi tiết tin đó
Route::get('/tin-tuc-chia-se/{primary_id}','newsadminController@newsdetails_client');

//THONG-TIN-KHACH-HANG
route::get('/thong-tin-khach-hang','InfocustomerController@info_customer');

///hien-thi-thong-tin
route::post('/hien-thi-thong-tin','InfocustomerController@info_customer_phone');
route::get('/hien-thi-thong-tin','InfocustomerController@info_customer_phone');


//LIÊN HỆ KHÁCH HÀNG
Route::get('/lien-he','contactController@Contact');
Route::post('/lien-he','contactController@insertContact');


/////////////////////////////////////-------KHUYẾN MÃI--------/////////////////////////////////////-------
Route::get('khuyen-mai', 'HomeController@promotion');





















////////////////////////////////////////----ADMIN---///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   LÀM VIỆC VỚI ADMIN
Route::get('/admin-login-dashboard', 'AdminController@login'); //URL TRang admin-login

Route::post('/admin-quanly', 'AdminController@check_login'); //quản lý bên controller dòng 15

Route::get('/admin-quanly', 'AdminController@index');
// Route::get('/admin-dashboard','AdminController@dashboard'); //BÊN CONTROLLER dòng 21

//QUẢN LÝ ĐƠN HÀNG
Route::get('/admin-quanly-donhang', 'AdminController@order');

//upload img
Route::post('ckeditor/image_upload', 'AdminController@upload')->name('uploads');
                                                        //name('upload') là truyền tham số bên view admin_layout.blde.php dòng 278        
//ĐĂNG XUẤT
Route::get('/logout','AdminController@log_out');


/////////////////////////////////////-------TRẠNG THÁI ĐƠN HÀNG------/////////////////////////////////////-------
/////UPDATE- STATUS GIAO HÀNG (TRẠNG THÁI Chưa GIAO HAY ĐÃ GIAO)
Route::get('/update-status-0/{order_id}','AdminController@update_status_0');
//UPDATE- STATUS GIAO HÀNG (TRẠNG THÁI ĐÃ GIAO HAY CHƯA GIAO)
Route::get('/update-status-1/{order_id}','AdminController@update_status_1');

//XÓA STATUS ĐÃ GIAO
Route::get('/delete-status-1/{order_id}','AdminController@delete_status_1');
// XÓA NHIỀU ĐƠN HÀNG
Route::get('/destroy-order', 'AdminController@destroy_order');
/////////////////////////////////////-------tìm kiếm đơn hàng--------/////////////////////////////////////-------
//tìm kiếm đơn hàng khách đặt
Route::post('/tim-kiem-admin', 'AdminController@search_order'); //quản lý bên controller dòng 15
Route::get('/tim-kiem-admin', 'AdminController@search_product_order'); //quản lý bên controller dòng 15

//TÌM KIẾM SẢN PHẨM
Route::post('/tim-kiem-san-pham', 'AdminController@searchProduct');
Route::get('/tim-kiem-san-pham', 'AdminController@searchProduct_item');

//ĐƠN HÀNG CHƯA HOÀN THÀNH
Route::get('/order_not_complete', 'AdminController@order_not_complete');

//ĐƠN HÀNG ĐÃ HOÀN THÀNH
Route::get('/order_complete', 'AdminController@order_complete');


/////////////////////////////////////-------DANH MỤC, THƯƠNG HIỆU-----/////////////////////////////////////-------
//CATEGORY PRODUCTT
//ADD
Route::get('/addCategoryProduct', 'CategoryProduct@add_Category_Product');
//SHOW
Route::get('/allCategoryProduct', 'CategoryProduct@all_Category_Product');
    //SAVE-CATEGORY 
Route::post('/save-category-product', 'CategoryProduct@save_Category_Product');

//UPDATE
Route::get('/edit-category-product/{category_product_idd}', 'CategoryProduct@edit_Category_Product');
                                    //category_product_idd đặt gì cũng đc miễn sao có dấu {}
Route::post('/update-category-product/{category_product_idd}', 'CategoryProduct@update_Category_Product');
                                    //category_product_idd đặt gì cũng đc miễn sao có dấu {}

//DELETE CATEGORY
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_Category_Product');
                                //category_product_id đặt gì cũng đc miễn sao có dấu {}
//DESTROY CATEGOY
Route::get('/destroy', 'CategoryProduct@destroy_Category_Product');



///////////HOẠT ĐỘNG CỦA DANH MỤC
//active (ID)
Route::get('/active/{category_product_idd}', 'CategoryProduct@active_Category_Product');
                   //xem bài 14  $category_product_id lag lấy cái ID trong csdl
//unactive (ID)
Route::get('/unactive/{category_product_idd}', 'CategoryProduct@unactive_Category_Product');
                     //xem bài 14  category_product_id là lấy cái ID trong csdl


// CODE BRAND PRODUCT

//add code brand
Route::get('/add-Brand-code-Product', 'BrandcodeProduct@add_Brand_code_Product');
//SHOW brand
Route::get('/all-Brand-code-Product', 'BrandcodeProduct@all_Brand_code_Product');
// SAVE - BRAND-CODE (XÀI CHUNG HẾT)
Route::post('/save-brandcode-product', 'BrandcodeProduct@save_brandcode_product');

//DELETE brand
route::get('/delete-brand-code-product/{brand_code_id}','BrandcodeProduct@delete_brand_code_product');
                                    //brand_code_id cho là gì cũng đc
//UPDATE BRAND-CODE
route::get('edit-brand-code-product/{brand_code_id}','BrandcodeProduct@edit_brand_code_product');

route::post('update-brandcode-product/{brand_code_id}','BrandcodeProduct@update_brand_code_Product');



///////////////////////////////////////------- PRODUCT (SẢN PHẨM)----------/////////////////////////////////////-------

//add  product
Route::get('/add-Product', 'Productcontroller@add_Product');
//SHOW product
Route::get('/all-Product', 'Productcontroller@all_Product');
// SAVE - product (XÀI CHUNG HẾT)
Route::post('/save-product', 'Productcontroller@save_product');

//DELETE product
route::get('/delete-product/{product_id}','Productcontroller@delete_product');
                                    //product_id cho là gì cũng đc
//XÓA NHIỀU SP
Route::get('/destroy-product', 'Productcontroller@destroy_product');
//UPDATE product
route::get('edit-product/{product_id}','Productcontroller@edit_product');

route::post('update-product/{product_id}','Productcontroller@update_Product');
///////////////////////////////////////////////////////////////////////////////////////////////////-------/////////////////////////////////////--------------


///////////////////////////////////////////------- THÔNG TIN KHÁCH HÀNG ĐÃ ĐẶT-------/////////////////////////////////////-------
route::get('/thong-tin-don-hang/{order_id}','AdminController@infocustomerorder');


////////////////////////////////////------- Bài viết----------/////////////////////////////////////-------

//HIỂN THỊ LAYOUT TRANG THÊM BÀI
route::get('/add-news','newsadminController@layoutaddNews');
//THÊM BÀI VIẾT
route::post('/save-news','newsadminController@insertNews');

//HIỂN THỊ BÀI VIẾT
route::get('/all-news','newsadminController@layoutallNews');

//
route::get('/chi-tiet-bai-viet/{primaryKey}','newsadminController@newsdetails');
//XÓA BÀI VIẾT
route::get('/delete-news/{primaryKey}','newsadminController@delete_news');
                                    //product_id cho là gì cũng đc
//UPDATE BÀI VIẾT
route::get('edit-news/{primaryKey}','newsadminController@edit_news');

route::post('update-news/{primaryKey}','newsadminController@update_news');
/////////////////////////////////////-------/////////////////////////////////////-------/////////////////////////////////////-------



// PHẢN HỒI LIÊN HỆ CỦA KHÁCH
Route::get('contact','contactController@contactadmin');
/////UPDATE- STATUS PHẢN HỒI LIÊN HỆ CỦA KHÁCH (TRẠNG THÁI Chưa GIAO HAY ĐÃ GIAO)
Route::get('/updatestatus-0/{Con_Id}','contactController@update_status_0');
//UPDATE- PHẢN HỒI LIÊN HỆ CỦA KHÁCH (TRẠNG THÁI ĐÃ GIAO HAY CHƯA GIAO)
Route::get('/updatestatus-1/{Con_Id}','contactController@update_status_1');

//XÓA STATUS PHẢN HỒI LIÊN HỆ CỦA KHÁCH
Route::get('/deletestatus-1/{Con_Id}','contactController@delete_status_1');


//ĐÁNH GIÁ SẢN PHẨM TỪ KHÁCH HÀNG
Route::get('reviews','reviewsController@reviews');
/////UPDATE- STATUS PHẢN HỒI LIÊN HỆ CỦA KHÁCH (TRẠNG THÁI Chưa GIAO HAY ĐÃ GIAO)
Route::get('/deletestatus1/{Con_Id}','reviewsController@delete_status_1');