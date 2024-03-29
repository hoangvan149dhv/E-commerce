<?php

namespace App\Http\Controllers\user;

use DB;
use Session;
use App\Http\Model\sliderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Model\contactinfoModel;
use App\Http\Model\count;
use App\Http\Model\newsadminModel;
use App\Http\library\product_detail;
class HomeController extends Controller
{
    public function __construct(request $request)
    {
        $contactinfoModel = contactinfoModel::select()->get();
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();

        product_detail::removeExpiredSales();
        //SEO
        if (config('config_admin.SEO')) {
            $meta_Robots = 'index, follow';
        }
        else{
            $meta_Robots = 'noindex, nofollow';
        }
        $url_canonical = $request->url();

        //SEO
        view()->share('category_product', $category_product);
        view()->share('brand_code_product', $brandcode_product);
        view()->share('meta_Robots',$meta_Robots);
        view()->share('meta_desc', config('config_admin.meta_desc'));
        view()->share('meta_keyword', config('config_admin.meta_keywords'));
        view()->share('meta_title', config('config_admin.meta_title'));
        view()->share('url_canonical', $url_canonical);
        view()->share('contactinfoModel', $contactinfoModel);

    }

    public function index(Request $request)
    {
        $all_product = \App\Http\library\product_detail::getProductPublish()
            ->orderby('product_price_promotion', 'desc')
            ->orderby('product_id', 'desc')
            ->paginate(8);
        $blogs = newsadminModel::select()->orderby('news_id','desc')->take(4)->get();

        $slider = sliderModel::where('status', 1)->orderby('id', 'desc')->take(1)->get();
        //Visitor
        $count = count::findOrFail(1);
        $response = new Response();

        $cookie = $response->withcookie("abc" . rand(0, 9999), "abc" . rand(0, 9999), 1111);

        if ($cookie) {
            $count->increment('counts');
        }
        return view('frontend.home.home')
            ->with('count', $count)
            ->with(compact('all_product', 'slider', 'blogs'));
    }

    public function search(Request $request)
    {
        $key_word = $request->search;

        if ($key_word == '') {
            return back();
        } else {
            $search = \App\Http\library\product_detail::getProductPublish()
                ->where('product_Name', 'like', '%' . $key_word . '%')
                ->orderby('product_price_promotion', 'desc')
                ->orderby('product_id', 'desc')
                ->paginate(15);

            return view('user.search.search')
                ->with('search', $search);
        }
    }

    public function promotion()
    {
        $slider = sliderModel::where('status', 1)->orderby('id', 'desc')->take(3)->get();

        $promotion = \App\Http\library\product_detail::getProductPublish()
            ->where('product_price_promotion', '>', '1')
            ->where('promotion_end_date', '>=', self::getcurrentTime())
            ->orderby('product_price_promotion', 'desc')
            ->paginate(10);

        return view('frontend.promotion.promotion')
            ->with('promotion', $promotion)
            ->with(compact('slider'));
    }

    public static function getcurrentTime()
    {
        return \App\Http\library\product_detail::getcurrentTime();
    }
}

