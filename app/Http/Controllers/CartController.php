<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Cart;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; //
use Illuminate\Support\Facades\Redirect;
use App\WardModel;
use App\ProvinceModel;
use App\CityModel;
use App\feeShipModel;
class CartController extends HomeController
{
    public function show_cart_ajax(Request $request){
        //SEO
        $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
        $meta_title = "Vải áo dài xinh- chuyên bán sỉ lẻ vải may"; //Tile là tên trang đó
        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ

        ///SEO

        return view('user.cart.show_cartajax')
        ->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }



    ///THÊM CART BẰNG AJAX
    public function save_cart_ajax(Request $request){
        $data['id'] =$request->cart_id; //$data'id'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['qty']= $request->cart_qty;//$data'qty'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['name'] =$request->cart_name;//$data'name'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['price'] =$request->cart_price;//$data'price'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        //
        $data['weight'] ="session";//$data'weight'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        ///Vì trường weight KHÔNG CÓ  trong  sql nên mình để số nào cũng đc miễn k đc rỗng
        //
        $data['options']['images']=$request->cart_image;//$data'options'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
                        //images đặt gì cũng đc nhưng phải gọi nó ra
        Cart::add($data);
        session::put('message',Cart::content()->count());// đếm sản phẩm
    }
    //details_product.blade.php  //XEM BÀI 33
    public function save_product_cart(Request $request){

        // $product_amount = $request->soluong; //LẤY SỐ LƯỢNG BÊN TRANG details_product.blade.php dòng 45
        $productId = $request->product_id_hidden;

        //lấy sản phẩm
        $product_info = DB::table('tbl_product')->where('tbl_product.product_id',$productId)->first();
        //XEM BÀI 33 .... LARAVEL
        //  Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // $data =array();
        $data['id'] =$productId; //product_info->product_id; //$data'id'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['qty']= 1;//$data'qty'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['name'] =$product_info->product_Name;//$data'name'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        $data['price'] =$product_info->product_price;//$data'price'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        //
        $data['weight'] ="session";//$data'weight'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
        ///Vì trường weight KHÔNG CÓ  trong  sql nên mình để số nào cũng đc miễn k đc rỗng
        //
        $data['options']['images']=$product_info->product_image;//$data'options'] "id" ở đây là trong laravel có sẵn MẶC ĐỊNH PHẢI GHI NHƯ VẬY
                        //images đặt gì cũng đc nhưng phải gọi nó ra
        Cart::add($data);
        // $data_cart = array($data['name']);
        session::put('message',Cart::content()->count());// đếm sản phẩm
        return Redirect::to('/hien-thi-gio-hang');
        // Cart::destroy();
    }






    public function show_cart(Request $request){
        //SEO
        $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
        $meta_title = "Vải áo dài xinh- chuyên bán sỉ lẻ vải may"; //Tile là tên trang đó
        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ

        ///SEO

        $city = CityModel::orderby('matp','ASC')->get();

        // $feeship = feeShipModel::orderby('fee_id','desc')->get();
        view()->share('city',$city);

        return view('user.cart.show_cart')
        ->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
    //delete cart
   public function del_cart($rowId){
   $cart = Cart::content();
   if($cart->isNotEmpty()){

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

    $rowId = $request->rowId_cart; // rowId_cart là trang show_cart dòng 54

    $qty = $request->soluong; //soluong là name trang show_cart dòng 52-53

    if(is_numeric($qty)){ // kiểm tra xem có phải số hay không
        Cart::update($rowId,$qty);
        return back();

    }else{

        Cart::destroy($rowId);

        return back();

        }

    }

}

    ////////SẢN PHẨM GỢI Ý///////////////
    // public function show_details(){
        $show_details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')->get();

        //SẢN PHÂM ĐC QUAN TÂM (SẢN PHẨM MỚI)
        $show_details_product_recommended = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->limit('3')->get();

        //SẢN PHẨM GỢI Ý
        foreach($show_details_product as $value){
        $category_product_id = $value->category_id;} //có nghĩa là lấy tất cả sản phẩm có category_id
        //SẢN PHẨM GỢI Ý
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('tbl_category_product.category_id',$category_product_id)->limit('3')->get();

