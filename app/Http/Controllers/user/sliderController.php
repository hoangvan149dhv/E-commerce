<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\user\HomeController;
use App\Http\Model\sliderModel;
use DB;
class sliderController extends HomeController
{
    function slider_user(){
        $slider = sliderModel::where('status',1)->orderby('id','desc')->take(3)->get();

        if(isset($slider)){

            $all_product = DB::table('tbl_product')
                            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
                            ->orderby('product_id','desc')->paginate(20);

            return view('user.home')->with(compact('all_product','slider'));
        }
        else{

            return false;
        }
    }
}
