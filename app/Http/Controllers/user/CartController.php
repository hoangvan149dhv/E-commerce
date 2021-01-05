<?php

namespace App\Http\Controllers\user;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\CityModel;
use App\Http\Controllers\user\HomeController;

class CartController extends HomeController
{
    public function add_cart_ajax(Request $request)
    {
        $data['id'] = $request->cart_id;
        $data['qty'] = 1;
        $data['name'] = $request->cart_name;
        $data['price'] = $request->cart_price;
        $data['weight'] = 0; //default
        $data['options']['images'] = $request->cart_image;
        if ( ! Cart::add($data)) {
            return back();
        }
        $data['itemCart'] = '';
        $data['images'] = $data['options']['images'];
        $currrentQty = \Illuminate\Support\Facades\Session::get('Qty', 0);
        $currrentQty += $data['qty'];
        \Illuminate\Support\Facades\Session::put('Qty', $currrentQty);

        $data['totalQty'] = $currrentQty;

        $dataCarts = Cart::content();

        $data['itemCart'] .= '<div class="cart_products">';
        foreach ($dataCarts as $dataCart) {
            $product = DB::table('tbl_product')->where('tbl_product.product_id', $dataCart->id)->first();

            $data['itemCart'] .= '<div class="dropdown-item d-flex align-items-start" href="#">
                        <a href="'.url('/chi-tiet/'.$product->meta_slug).'">
                            <div class="img" style="background-image: url(public/upload/'.$product->product_image.');"></div>
                            <div class="text pl-3">
                                <h4>'.$dataCart->name.'</h4>
                                <p class="mb-0"><a href="#" class="price">'.number_format($dataCart->price) .'.VNĐ</a><span
                                        class="quantity ml-3">Số Lượng: '.$dataCart->qty.'</span></p>
                            </div>
                        </a>
                    </div>';
        }
        $data['itemCart'] .= '</div> <h3 class="dropdown-item text-center btn-link d-block w-100">Tổng: '.Cart::subtotal(0).'.VNĐ</h3><a class="dropdown-item text-center btn-link d-block w-100"
                                       href="'.url('/hien-thi-gio-hang').'">
                                        Đến giỏ hàng
                                        <span class="ion-ios-arrow-round-forward"></span>
                                    </a>';
        unset($data['id'], $data['qty'], $data['options']);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function save_product_cart(Request $request)
    {
        $productId = $request->product_id_hidden;
        //Get product
        $product_info = DB::table('tbl_product')->where('tbl_product.product_id', $productId)->first();

        $data['id'] = $productId;
        $data['qty'] = $request->qty ?? 1;
        $data['name'] = $product_info->product_Name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0;
        $data['options']['images'] = $product_info->product_image;
        if ( ! Cart::add($data)) {
            return back();
        }
        $currrentQty = session::get('Qty');
        $currrentQty += $data['qty'];

        session::put('Qty', $currrentQty);

        return Redirect::to('/hien-thi-gio-hang');
    }

    public function show_cart()
    {
        $city = CityModel::orderby('matp', 'ASC')->get();
        view()->share('city', $city);

        return view('user.cart.show_cart');
    }

    //Remove cart
    public function del_cart($rowId)
    {
        $cart = Cart::content();
        if ($cart->isNotEmpty()) {
            Cart::remove($rowId);
            return back();
        } else {

            return back();
        }
    }

    public function del_cart_all($rowId)
    {

        $cart = Cart::content();

        if ($cart->isNotEmpty()) {

            Cart::destroy($rowId);

            return back();

        } else {

            return back();
        }
    }

    //update cart quantity
    public function update_Cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->qty;
        if (is_numeric($qty)) {
            Cart::update($rowId, $qty);

            return back();

        } else {
            Cart::destroy($rowId);

            return back();
        }
    }
}
