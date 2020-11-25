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
}
