<?php

    namespace App\Http\Controllers\user;

    use App\Http\Controllers\user\HomeController;
    use Illuminate\Http\Request;
    use DB;
    use Session;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;

    class Brand extends HomeController
    {
        public function show_products_from_brand($brand_meta_slug)
        {
            //brand_name
            $brand_name = DB::table('tbl_brand_code_product')->where('brand_meta_slug', $brand_meta_slug)->limit('1')->get();
            $brand_id = $brand_name[0]->code_id;

            $productData = \App\Http\library\product_detail::getProductPublish()
                            ->where('tbl_brand_code_product.code_id', $brand_id)
                            ->orderby('tbl_product.product_price_promotion', 'desc')
                            ->paginate(12);

            return view('frontend.brand.showcode')
                ->with('productDataFromBrand', $productData)
                ->with('brand_name', $brand_name);
        }
    }
