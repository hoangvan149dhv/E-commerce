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
class InfocustomerController extends HomeController {

    public function info_customer(){

        return view('user.infocustomer.infocustomer');

    }
    public function info_customer_phone(Request $request){

        $all_info_customer       = DB::table('tbl_customer')->where('cusPhone',$request->phone)->orderby('cusid','desc')->limit(1)->get();
        $all_info_customer_order = DB::table('tbl_orders')->where('cusphone',$request->phone)->orderby('cusid','desc')->get();

        if($all_info_customer){
            return view('user.infocustomer.infocustomer_phone')
                        ->with('all_info_customer',$all_info_customer)
                        ->with('all_info_customer_order',$all_info_customer_order);
        }

        else{
            return false;
        }
    }
}
