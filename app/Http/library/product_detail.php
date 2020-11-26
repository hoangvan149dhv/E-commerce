<?php

namespace App\Http\library;
use DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Model\productModel;
class product_detail  extends BaseController
{
    public static function getProductDetail($pid) {
        $productData = productModel::where('product_id',$pid)->get();

        return $productData;
    }

    public static function getAllProduct()
    {
        // Update product when promotion_end_date over time
        DB::table('tbl_product')->where('tbl_product.promotion_end_date', '<', self::getcurrentTime())
            ->update(array('promotion_end_date' => null,
                'promotion_start_date' => null,
                'publish' => 0));

        // Update product price
        productModel::where('product_price_promotion', '>', 1 )->where('promotion_end_date', '=', null)
            ->where('promotion_end_date', '=', null)->update(array('product_price_promotion' => 1,
                'publish' => 0));
    }

    public static function getcurrentTime()
    {
        $timeCurrent = date("Y-m-d");

        return $timeCurrent;
    }
    public static function getProductPromotionEmptynedDate($pid)
    {
        $products = productModel::where('product_price_promotion', '>', 1 )->where('promotion_end_date', '=', null)
            ->where('promotion_end_date', '=', null)->where('product_id', '=', $pid)->get();

        return $products;
    }
}
