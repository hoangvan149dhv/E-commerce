<?php

namespace App\Http\library;
use DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Model\productModel;
use Carbon\Carbon;
class product_detail  extends BaseController
{
    public static function getProductDetail($pid) {
        // echo $pid;
        $productData = productModel::where('product_id',$pid)->get();
        return $productData;
    }

    public static function removeExpiredSales()
    {
        // Update product when promotion_end_date over time
        DB::table('tbl_product')->where('tbl_product.promotion_end_date', '<', self::getcurrentTime())
            ->update(array('promotion_end_date' => 0,
                'promotion_start_date' => 0,
                'publish' => 1));

        // Update product price
        productModel::where('product_price_promotion', '>', 1 )->where('promotion_start_date', '=', 0)
            ->where('promotion_end_date', '=', 0)->update(array('product_price_promotion' => 1,
                'publish' => 0));
    }

    public static function getProductPublish()
    {
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
            ->where('tbl_product.publish', '=', 1);

        return $all_product;
    }

    public static function getcurrentTime()
    {
        $timeCurrent = Carbon::now()->toDateTimeString();

        return strtotime($timeCurrent);
    }

    public static function getProductPromotionEmptyDate($pid)
    {
        $products = productModel::where('product_price_promotion', '>', 1 )->where('promotion_end_date', '=', null)
            ->where('promotion_end_date', '=', null)->where('product_id', '=', $pid)->get();

        return $products;
    }

    public static function getallProduct()
    {
        $getProducts = DB::table('tbl_product')->orderby('product_id','desc')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id');

        return $getProducts;
    }
}
