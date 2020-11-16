<?php

    namespace App\Http\Controllers\user;

    use App\Http\Controllers\user\HomeController;
    use Illuminate\Http\Request;
    use DB;
    use Session;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;
    use App\contactinfoModel;

    class CategoryProduct extends HomeController
    {
        //SHOW SẢN PHẨM CỦA DAN MỤC
        public function show_category_home($category_id, request $request)
        {
            //category_name
            $category_name = DB::table('tbl_category_product')->where('category_id', $category_id)->limit('1')->get();
            //category_by_id

            $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->where('tbl_product.promotion_end_date', '>=', parent::getTimecurrent())
                ->where('tbl_category_product.category_id', $category_id)->paginate(12);

            // meta
            foreach ($category_name as $value) {
                //SEO
                $meta_desc = $value->category_desc;

                $meta_title = $value->category_name;

                $url_canonical = $request->url();
                ///SEO
            }
            return view('user.category.show_category')
                ->with('category_by_id', $category_by_id)
                ->with('category_name', $category_name)
                //SEO
                ->with('meta_desc', $meta_desc)
                ->with('meta_title', $meta_title)
                ->with('url_canonical', $url_canonical);
        }
    }
