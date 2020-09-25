<?php

namespace App\Http\Controllers\user;
use App\ReviewModel;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests; //
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\user\HomeController;
class DetailsProductController extends HomeController{

    public function show_details($meta_slug, request $request){
        $show_details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('meta_slug',$meta_slug)->get();

        //SẢN PHÂM ĐC QUAN TÂM (SẢN PHẨM MỚI)
        $show_details_product_recommended = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->whereNotIn('tbl_product.meta_slug',[$meta_slug])
        ->limit('3')->orderby('product_id','desc')->get();


        foreach($show_details_product as $value){
        $category_product_id = $value->category_id;

        $brand_product_id =$value->brandcode_id;


        $meta_desc= $value->meta_desc;
        $meta_keyword = $value->meta_keyword;
        $meta_title = $value->product_Name;
        $url_canonical = $request->url();

        ///SEO
        }
        if(isset($brand_product_id)){
            $related_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
            ->where('tbl_brand_code_product.brandcode_id',$brand_product_id)->whereNotIn('tbl_product.meta_slug',[$meta_slug])->limit('3')
            ->orderby('product_id','asc')->get();
        }else{
            return redirect('trang-chu');
        }

        //LẤY SẢN PHẨM THEO DANH MỤC
        $show_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('tbl_product.category_id',$category_product_id)->limit(5)->get();

        $reviewModel = ReviewModel::where('meta_slug',$meta_slug)->limit(4)->orderby('Rid','desc')->get();

        return view('user.details_product.details_product')
        ->with('details_product',$show_details_product)
        ->with('show_details_product_recommended',$show_details_product_recommended)
        ->with('related_product',$related_product)
        ->with('show_product',$show_product)

        //SEO
        ->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('reviewModel',$reviewModel);
    }

    // Bình luận đánh giá sản phẩm
    public function insertComment($meta_slug , request $request){
        $reviewModel = new ReviewModel();

        $reviewModel->Rname = $request['name'];

        $reviewModel->Remail = $request['email'];

        $reviewModel->Rcomment = $request['comment'];

        $reviewModel->status = 0;

        $reviewModel->meta_slug=$meta_slug;

        if(empty($request['name']&&$request['email']&&$request['comment'])){

            Session::put('alert',"<div style='color:red'> bạn không được để trống ở bất kì mục nào</div>"); //admin_Id trong dbs`

            return back();

        }else{
            $reviewModel=$reviewModel->save();

            return back();
        }
    }
}