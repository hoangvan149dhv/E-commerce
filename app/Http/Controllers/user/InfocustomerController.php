<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\contactinfoModel;
use App\Http\Controllers\user\HomeController;

class InfocustomerController extends HomeController
{

    public function info_customer()
    {

        return view('user.infocustomer.infocustomer');

    }

    public function info_customer_phone(Request $request)
    {
        $info_customer = DB::table('tbl_customer')->where('cusPhone', $request->phone)->orderby('cusid','desc')->limit(1)->get();

        if (count($info_customer)) {
            $order_item = DB::table('tbl_orders')->where('cusid', $info_customer[0]->cusid)->orderby('cusid',
            'desc')->get();
            if (!count($order_item))
            {
                Session::put('customer-not-found', 'Không có tên hoặc số điện thoại quý khách đã từng mua hàng. Vui lòng thử lại.');
                return redirect::to('/');
            }
            $order_item_value = explode(',', $order_item[0]->product_id);
            $order_item_qty_value = explode(',', $order_item[0]->qty);

            return view('frontend.infocustomer.infocustomer_phone')
                ->with('info_customer', $info_customer)
                ->with('order_item_value', $order_item_value)
                ->with('order_item_qty_value', $order_item_qty_value);
        } else {
            Session::put('customer-not-found', 'Không có tên hoặc số điện thoại quý khách đã từng mua hàng. Vui lòng thử lại.');
            return redirect::to('/');
        }
    }
}
