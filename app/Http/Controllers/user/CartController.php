<?php

namespace App\Http\Controllers\user;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use App\Http\Requests; //
use Illuminate\Support\Facades\Redirect;
use App\WardModel;
use App\ProvinceModel;
use App\CityModel;
use App\Http\Controllers\user\HomeController;
use App\feeShipModel;
class CartController extends HomeController
{
    public function show_cart_ajax(Request $request){
        return view('user.cart.show_cartajax');
    }
    public function save_cart_ajax(Request $request){
        $data['id'] =$request->cart_id;
        $data['qty']= $request->cart_qty;
        $data['name'] =$request->cart_name;
        $data['price'] =$request->cart_price;
        $data['weight'] ="session";
        $data['options']['images']=$request->cart_image;
        Cart::add($data);
        session::put('message',Cart::content()->count());
    }

    public function save_product_cart(Request $request){

        $productId = $request->product_id_hidden;

        //lấy sản phẩm
        $product_info = DB::table('tbl_product')->where('tbl_product.product_id',$productId)->first();

        $data['id'] =$productId;
        $data['qty']= 1;
        $data['name'] =$product_info->product_Name;
        $data['price'] =$product_info->product_price;
        $data['weight'] ="session";
        $data['options']['images']=$product_info->product_image;
        Cart::add($data);
        session::put('message',Cart::content()->count());
        return Redirect::to('/hien-thi-gio-hang');
    }

    public function show_cart(Request $request){

        $city = CityModel::orderby('matp','ASC')->get();
        view()->share('city',$city);

        return view('user.cart.show_cart');
    }
    //delete cart
   public function del_cart($rowId){
       $cart = Cart::content();
       if($cart->isNotEmpty())
       {
           Cart::remove($rowId);

           return back();

       }else{

            return back();

       }
    }
   public function del_cart_all($rowId){

    $cart = Cart::content();

    if($cart->isNotEmpty()){

        Cart::destroy($rowId);

        return back();

    }else{

        return back();
        }
    }
   //update cart quantity
   public function update_Category_quantity(Request $request){

    $rowId = $request->rowId_cart;

    $qty = $request->soluong;

    if(is_numeric($qty)){

        Cart::update($rowId,$qty);
        return back();

    }else{

        Cart::destroy($rowId);

        return back();

        }
    }
}
