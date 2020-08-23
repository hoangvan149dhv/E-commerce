<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; // 
use Illuminate\Support\Facades\Redirect;
// session_start();
class Payment_orderController extends Controller
{
    public function __construct(request $request){
        
       //lấy ra DANH MỤC VÀ THƯƠNG HIỆU
         $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
                //category_id trong sql, 
        
         $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
        //SEO        
         $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
         $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
         $meta_title = "Vải áo dài xinh- Khuyến Mãi"; //Tile là tên trang đó
         $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
        //SEO
        view()->share('category_product',$category_product);
        view()->share('brand_code_product',$brandcode_product);
        view()->share('meta_desc',$meta_desc);
        view()->share('meta_keyword',$meta_keyword);
        view()->share('meta_title',$meta_title);
        view()->share('url_canonical',$url_canonical);
    }
    public function payment_order(Request $request){
        //KẾT NỐI Cart
        $content = Cart::content();
        //

        // INSERT CUSTOMER
        $cus_data['cusname'] = $request->name;
        $cus_data['cusadd'] = $request->add;
        $cus_data['cusphone'] =$request->phone;

        if(empty($request->phone)|| empty($request->add) || empty($request->name)){

            Session::put('error','Bạn Không Được Để Trống bất kì mục nào');
            return Redirect::to('/hien-thi-gio-hang');
        
        }else{
        
            $cus_id = DB::table('tbl_customer')->insertGetId($cus_data);
        
        // INSERT ORDER_PAYMENT
            foreach($content as $value_content){
                $order_data['cusid'] = $cus_id;  //MÃ ID KHÁCH HÀNG
                $order_data['cusname'] = $request->name; //họ tên khachd hang
                $order_data['product_id'] = $value_content->id; // MÃ ĐƠN HÀNG
                $order_data['productname'] = $value_content->name;  //TÊN MẶT HÀNG
                $order_data['price'] = $value_content->price; //GIÁ CỦA TỔNG SẢN PHẨM ĐÓ
                $order_data['soluong']= $value_content->qty; // SỐ LƯỢNG
                $order_data['total']=  $order_data['price'] * $order_data['soluong'];// SỐ LƯỢNG
                $order_data['image']= $value_content->options->images; //HÌNH ẢNH
                $order_data['cusphone']=$request->phone;  //ĐIỆN THOẠI
                $order_data['note']=$request->note; //GHI CHÚ
                $order_data['status']="đang xử lý"; //TRẠNG THÁI XỬ LÝ
                DB::table('tbl_order')->insert($order_data);
            }
            Cart::destroy();
        
            return view('user.payment.payment_order');
        }
    }
}