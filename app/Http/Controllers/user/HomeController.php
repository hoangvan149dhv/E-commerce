<?php

    namespace App\Http\Controllers\user;

    use DB;
    use Session;
    use App\sliderModel;
    use App\OrderModel;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Http\Response;
    use Carbon\Carbon;
    use App\CustomerorderModel;
    use App\contactinfoModel;
    use Illuminate\Support\Facades\Cookie;
    use App\count;

    class HomeController extends Controller
    {
        public function __construct(request $request)
        {
            $contactinfoModel = contactinfoModel::select()->get();
            $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
            $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();
            $this->getAllProduct();
            //SEO
            $meta_desc = "Chuyên bán vải áo dài, may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng";
            $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";
            $meta_title = "Vải áo dài xinh - Khuyến Mãi";
            $url_canonical = $request->url();

            //SEO
            view()->share('category_product', $category_product);
            view()->share('brand_code_product', $brandcode_product);

            view()->share('meta_desc', $meta_desc);
            view()->share('meta_keyword', $meta_keyword);
            view()->share('meta_title', $meta_title);
            view()->share('url_canonical', $url_canonical);
            view()->share('contactinfoModel', $contactinfoModel);
        }

        public function index(Request $request)
        {
            $all_product = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->where('tbl_product.promotion_end_date', '>=', self::getcurrentTime())
                ->orwhere('tbl_product.promotion_end_date', '=', null)
                ->orwhere('product_price_promotion', '=', 1)
                ->orderby('product_id', 'desc')->paginate(15);

            $slider = sliderModel::where('status', 1)->orderby('id', 'desc')->take(3)->get();
            //SỐ LƯỢT TRUY CẬP
            $count = count::findOrFail(1);
            $response = new Response();

            $response->withcookie("abc" . rand(0, 9999), "abc" . rand(0, 9999), 1111);

            if (isset($response)) {
                $request->cookie("abc" . rand(0, 9999));

                $count->increment('counts');

                return view('user.home')
                    ->with('count', $count)
                    ->with(compact('all_product', 'slider'));


            } else {
                return view('user.home')
                    ->with('count', $count)
                    ->with(compact('all_product', 'slider'));
            }
        }

        //TÌM KIẾM
        public function search(Request $request)
        {
            $key_word = $request->search;

            if ($key_word == '') {
                return back();
            } else {
                $search = DB::table('tbl_product')
                    ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                    ->orderby('product_id', 'desc')->where('product_Name', 'like', '%' . $key_word . '%')
                    ->orwhere('product_material', 'like', '%' . $key_word . '%')
                    ->where('tbl_product.promotion_end_date', '>=', self::getcurrentTime())
                    ->orwhere('tbl_product.promotion_end_date', '=', null)
                    ->orwhere('product_price_promotion', '=', 1)->paginate(15);

                return view('user.search.search')
                    ->with('search', $search);
            }
        }

        public function search_product(Request $request)
        {
            $key_word = $request->search;
            $search = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->orderby('product_id', 'desc')->where('product_Name', 'like', '%' . $key_word . '%')
                ->orwhere('product_material', 'like', '%' . $key_word . '%')
                ->where('tbl_product.promotion_end_date', '>=', self::getcurrentTime())
                ->orwhere('tbl_product.promotion_end_date', '=', null)
                ->orwhere('product_price_promotion', '=', 1)->paginate(20);

            return view('user.search.search')
                ->with('search', $search);

        }

        public function promotion()
        {
            $slider = sliderModel::where('status', 1)->orderby('id', 'desc')->take(3)->get();
            $promotion = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->where('product_price_promotion', '>', '1')
                ->where('tbl_product.promotion_end_date', '>=', self::getcurrentTime())
                ->orwhere('tbl_product.promotion_end_date', '=', null)
                ->orwhere('product_price_promotion', '=', 1)
                ->orderby('product_price_promotion', 'desc')->paginate(10);

            return view('user.promotion.promotion')
                ->with('promotion', $promotion)
                ->with(compact('slider'));
        }

        public function getAllProduct()
        {
            $products = DB::table('tbl_product')->where('tbl_product.promotion_end_date', '<', self::getcurrentTime())->get();


            foreach ($products as $product) {
                $promotion_price = 1;
                $product_price = $product->product_price_promotion;
                DB::table('tbl_product')->where('tbl_product.promotion_end_date', '<', self::getcurrentTime())
                    ->update(array('promotion_end_date'=> null,
                                 'promotion_start_date'=> null,
                    'product_price'=> $product_price, 'product_price_promotion'=> $promotion_price));
            }
        }

        public static function getcurrentTime()
        {
            $timeCurrent = date("Y-m-d");

            return $timeCurrent;
        }
    }

