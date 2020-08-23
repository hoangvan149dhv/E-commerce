<?php

namespace App\Http\Controllers;
use App\count;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\sliderModel;
class HomeController extends Controller
{
    public function __construct(request $request)
    {
    
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
    public function index(Request $request){
        //LẤY THÔNG TIN SP
            $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->orderby('product_id','desc')->paginate(20);
                                    //paginate( phân trang)
        //jion == INNER JION KHÔNG CẦN "ON" HAY "WHERE" GÌ  HẾT
        // $slider_first= sliderModel::where('status',1)->first();
        // $slide_id= $slider_first->id;
        $slider = sliderModel::where('status',1)->orderby('id','desc')->take(3)->get();
        //SỐ LƯỢT TRUY CẬP
        $count = count::findOrFail(1);
        $response = new Response();
        $response->withcookie("abc".rand(0,9999),"abc".rand(0,9999),1111);
        if(isset($response)){
            $count->increment('counts');
            return view('user.home')
            ->with('all_productt',$all_product)
            ->with('count',$count)
            ->with(compact('all_product','slider'));
             $request->cookie("abc".rand(0,9999));
        }else{
            // $count->increment('counts');
            return view('user.home')
            ->with('all_productt',$all_product)
            ->with('count',$count)
            ->with(compact('all_product','slider'));
        }
    }
    //TÌM KIẾM
    public function search(Request $request){
        $key_word = $request->search;
        if($key_word==''){
            return back();
        }else{
            $search = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
            ->orderby('product_id','desc')->where('product_Name','like','%'.$key_word.'%')
            ->orwhere('product_material','like','%'.$key_word.'%')->paginate(20);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('user.search.search')
            ->with('search',$search);
        }
    }
    public function search_product(Request $request){
        $key_word = $request->search;
        $search = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->orderby('product_id','desc')->where('product_Name','like','%'.$key_word.'%')
        ->orwhere('product_material','like','%'.$key_word.'%')->paginate(20);
        return view('user.search.search')
        ->with('search',$search);
    }
    public function promotion(Request $request){
        // $slider_first= sliderModel::where('status',1)->first();
        // $slide_id= $slider_first->id;
        $slider = sliderModel::where('status',1)->orderby('id','desc')->take(3)->get();
        $promotion = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('product_price_promotion','>','1')->orderby('product_price_promotion','desc')->paginate(20);
        return view('user.promotion.promotion')
        ->with('promotion',$promotion)
        ->with(compact('slider'));
    }
}

