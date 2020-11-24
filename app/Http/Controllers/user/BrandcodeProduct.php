<?php

    namespace App\Http\Controllers\user;

    use App\Http\Controllers\user\HomeController;
    use Illuminate\Http\Request;
    use DB;
    use Session;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;

    class BrandcodeProduct extends HomeController
    {
        public function show_brand_home($brand_id)
        {
            //brand_name
            $brand_name = DB::table('tbl_brand_code_product')->where('code_id', $brand_id)->limit('1')->get();

            $brand_by_id = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->where('tbl_product.publish','=', 1)
                ->where('tbl_brand_code_product.code_id', $brand_id)
                ->paginate(12);

            return view('user.brand.show_brandcode')
                ->with('brand_by_id', $brand_by_id)
                ->with('brand_name', $brand_name);
        }
    }
