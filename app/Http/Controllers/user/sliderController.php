<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\sliderModel;
use DB;
use App\contactinfoModel;
class sliderController extends HomeController
{
    function slider_user(){
        $slider = sliderModel::where('status',1)->orderby('id','desc')->take(3)->get();
        if(isset($slider)){
            $all_productt = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
            ->orderby('product_id','desc')->paginate(20);
            return view('user.home')->with(compact('all_productt','slider'));
        }
        else{
            return false;
        }
    }
}
