<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; // 
use Illuminate\Support\Facades\Redirect;
use App\ReviewModel;
// session_start();
class Productcontroller extends Controller
{
     //KIỂM TRA ĐĂNG NHẬP
public function AuthLogin(){
        $admin_id = Session::get('admin_Id');
        if($admin_id){
             return Redirect::to('admin.dashboard');
        }else{

            return Redirect::to('admin-login')->send();
                           //Send là == chuyển ĐẾN TRANG -->RẤT QUAN TRỌNG
       
             }
        }
        ////SEO GOOGLE UTF8 convert UTF
public function utf8convert($str) {

            if(!$str) return false;
    
            $utf8 = array(
    
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
    
        'd'=>'đ|Đ',
    
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
    
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
    
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
    
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
    
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    
                        );
    
            foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
    
        return $str;
    
        }
        //HÀM THAY THẾ KÍ TỰ ĐẶC BIỆT(KHOẢNG CÁCH," ", "^", "%",....)
public function utf8tourl($text){
            $text = $this->utf8convert(strtolower($text));
            $text = str_replace( "ß", "ss", $text);
            $text = str_replace( "%", "", $text);
            $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = str_replace("----","-",$text);
            $text = str_replace("---","-",$text);
            $text = str_replace("--","-",$text);
        return $text;
        }

  // LAYOUT ADD
public function add_Product(){                        //CẤU TRÚC VIẾT HÀM SẮP XẾP THEO THỨ TỰ
        
    //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 
        //HIỂN THỊ DANH MỤC SẢN PHẨM BÊN THANH SLIDE-BAR
      $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
                                                                //category_id trong sql, 
        //HIỂN THỊ THƯƠNG HIỆU SẢN PHẨM BÊN THANH SLIDE-BAR
      $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
      
    return view('admin.addProduct')->with('category_product',$category_product)->with('brand_code_product',$brandcode_product);
                                            //'cate_product' là do mình khai báo    //brand_code_product do mimnhf khai báo 
                                                                        //ĐỂ TRUYỀN QUA TRANG admin.addProduct
 }
 //
//ALL HIỂN THỊ TẤT CẢ
public function all_Product(){

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

    // DÙNG INNER JION == JION
    $all_product = DB::table('tbl_product')
    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
    ->orderby('product_id','desc')->paginate(10);
    //jion == INNER JION KHÔNG CẦN "ON" HAY "WHERE" GÌ  HẾT
    
    $manager_product = view('admin.allProduct')->with('all_Productt',$all_product);
                                    //'admin.allProduct là trang đó truyền vào biến $all_Product
    return view('admin_layout')->with('admin.allProduct',$manager_product);
}
//

//THÊM product
public function save_product(request $Request){ 

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

    $data['category_id'] = $Request->category;
    $data['product_Name']=$Request->name; //TEN SP  
    $data['product_desc'] = $Request->mota; //MOTA
    if($data['product_desc']==""){
        $data['product_desc']="Chưa có thông tin";
    }
    $data['product_material'] = $Request->material;// NỘI DUNG SP
    $data['product_price_promotion'] = $Request->promotion_price; //GIÁ
    $data['product_price'] = $Request->price; //GIÁ
    $data['brandcode_id'] = $Request->brandcode; // MÃ CODE THUONG HIỆU
    $data['meta_keyword'] = $Request->meta_keyword; // TỪ KHÓA SẢN PHẨM GOOGLE
    $data['meta_desc'] = $Request->meta_desc;    // MỔ RA SP GOOGLE
    $slugg = $this->utf8convert($data['product_Name']); /// SEO URL
    $data['meta_slug']= $this->utf8tourl($slugg).rand(0, 22220);/// SEO URL
    //GET IMAGE //BÀI 23$
    $get_image=$Request->file('image');
    if($get_image){
    $get_name_image = $get_image->getClientOriginalName();// getClientOriginalName(); là lấy name và cả đuôi của hình
    
    $name_image = current(explode('.',$get_name_image));
                        //explode('.',$get_name_image) có nghĩa nó sẽ PHÂN TÁCH thành chuỗi qua Dấu "."
                //current là lấy PHẦN ĐẦU CỦA CHUỖI phân tách

    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
                         //rand(0,99) là TẠO SỐ NGẪU NHIÊN để khi đặt tên ảnh k bị trùng       
                                    // .'.'.$get_image->getClientOriginalExtension(); CÓ NGHĨA LÀ LẤY CÁI ĐUÔI ĐẰNG SAU DẤU '.'
                                                //VD hinh1.png là lấy đuôi (.png)

    $get_image->move('public/upload',$new_image); // move == move_upload trong php 
    $data['product_image'] = $new_image; // image là name bên addProduct.blade.php dòng 30
    // 

    
    
    DB::table('tbl_product')->insert($data);
    Session::put('alert-success-product','Thêm  Sản phẩm Thành Công');
    return redirect::to('add-Product');
    }else{
        $data['product_image'] ='';
        Session::put('alert-success-product','Thêm  Sản phẩm Thành Công');
        return redirect::to('add-Product');
    }
}
//
//DELETE PRODUCT
public function delete_product($productt_id){

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

        $product= DB::table('tbl_product')->where('product_id',$productt_id)->get();
        foreach ($product as $key) {
            $product_slug = $key->meta_slug;
        }
        DB::table('tbl_product')->where('product_id',$productt_id)->delete();
        DB::table('tbl_order')->where('product_id',$productt_id)->delete();
        ReviewModel ::where('meta_slug',$product_slug)->delete();
        return back();
}
//xóa tất cả sản phẩm
public function destroy_product(Request $request){

    //KIỂM TRA ĐĂNG NHẬP
    $this->AuthLogin(); 
    $product_id =$request->product;
    $product_slug =$request->slug;
    if(isset( $product_id)){
        ReviewModel ::whereIn('meta_slug',$product_slug)->delete();
        DB::table('tbl_order')->where('product_id',$product_id)->delete();
        DB::table('tbl_product')->whereIn('product_id',$product_id)->delete();
        
        return back();}
        else{
            return back();
        }
}

//UPDATE (HIỂN THỊ )
public function edit_product($product_id, request $Request)
{

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //category_id trong sql, 
        //HIỂN THỊ THƯƠNG HIỆU SẢN PHẨM 
        $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
    $all_product = DB::table('tbl_product')->where('product_id',$product_id)
    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
    ->orderby('product_id','desc')->get();
                                                                                                //get == select(sql)
    $manager_product=view('admin.updateProduct')->with('all_product',$all_product)
    ->with('category_product',$category_product)
    ->with('brandcode_product',$brandcode_product);
    return view('admin_layout')->with('admin.updateProduct',$manager_product);
}

//UPDATE
public function update_Product(Request $Request,$product_id){

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

    $data = array(); //Chuỗi
    $data['category_id'] = $Request->category;
    $data['product_Name']=$Request->name; //TEN SP  
    $data['product_desc'] = $Request->mota; //MOTA
    if($data['product_desc']==""){
        $data['product_desc']="Chưa có thông tin";
    }
    $data['product_material'] = $Request->material;// NỘI DUNG SP
    $data['product_price'] = $Request->price; //GIÁ
    $data['product_price_promotion'] = $Request->promotion_price; //GIÁ
    $data['brandcode_id'] = $Request->brandcode; // MÃ CODE THUONG HIỆU
    $data['meta_keyword'] = $Request->meta_keyword;
    $data['meta_desc'] = $Request->meta_desc;
    $slugg = $this->utf8convert($data['product_Name']);/// SEO URL
    $data['meta_slug']= $this->utf8tourl($slugg).rand(0, 1000);/// SEO URL
    $get_image=$Request->file('image');
    //THỰC HIỆN query
    if(empty($get_image)){
    DB::table('tbl_product')->where('product_id',$product_id)->update($data);//CHỌN table ->insert dữ liệu data
                                            //category_id  trong csdl  
    Session::put('alert-successproduct','Sửa  Sản phẩm Thành Công');                         
    return back();
        }elseif ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();// getClientOriginalName(); là lấy name và cả đuôi của hình
    
            $name_image = current(explode('.',$get_name_image));
                                //explode('.',$get_name_image) có nghĩa nó sẽ PHÂN TÁCH thành chuỗi qua Dấu "."
                        //current là lấy PHẦN ĐẦU CỦA CHUỖI phân tách
        
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
                                 //rand(0,99) là TẠO SỐ NGẪU NHIÊN để khi đặt tên ảnh k bị trùng       
                                            // .'.'.$get_image->getClientOriginalExtension(); CÓ NGHĨA LÀ LẤY CÁI ĐUÔI ĐẰNG SAU DẤU '.'
                                                        //VD hinh1.png là lấy đuôi (.png)
        
            $get_image->move('public/upload',$new_image); // move == move_upload trong php 
            $data['product_image'] = $new_image; // image là name bên addProduct.blade.php dòng 30
            // 
        
            
            
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('alert-successproduct','Sửa  Sản phẩm Thành Công');
            return back();
        }
    }
}
