<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; // 
use Illuminate\Support\Facades\Redirect;
use App\contactinfoModel;
// session_start();
class InfocustomerController extends Controller{
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
    $contactinfoModel = contactinfoModel::select()->get();
    view()->share('contactinfoModel',$contactinfoModel);
    view()->share('category_product',$category_product);
    view()->share('brand_code_product',$brandcode_product);
    view()->share('meta_desc',$meta_desc);
    view()->share('meta_keyword',$meta_keyword);
    view()->share('meta_title',$meta_title);
    view()->share('url_canonical',$url_canonical);
    }

    public function info_customer(){

        return view('user.infocustomer.infocustomer');
    
    }
    public function info_customer_phone(Request $request){

        $all_info_customer = DB::table('tbl_customer')->where('cusPhone',$request->phone)->orderby('cusid','desc')->limit(1)->get();
        $all_info_customer_order = DB::table('tbl_order')->where('cusphone',$request->phone)->orderby('cusid','desc')->get();

        if($all_info_customer){
            return view('user.infocustomer.infocustomer_phone')
            ->with('all_info_customer',$all_info_customer)
            ->with('all_info_customer_order',$all_info_customer_order);
        }
        else{

        }
    
    }
    
}