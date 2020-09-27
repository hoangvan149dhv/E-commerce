<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\CustomerorderModel;
use App\contactinfoModel;
use App\count;
use App\Http\Controllers\admin\loginController ;
class AdminController extends loginController{

    public function __construct(){
        $count = count::find(1);
        
        $category_product  = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
        $contactinfoModel  = contactinfoModel::select()->get();

        view()->share('count',$count);
        view()->share('contactinfoModel',$contactinfoModel);
        view()->share('category_product',$category_product);
        view()->share('brand_code_product',$brandcode_product);

    }

    //cHUYỂN ĐẾN TRANG CHỦ ADMIN
    public function index(){
        $this->AuthLogin();

        $date=  Carbon::now()->day;

        $month=  Carbon::now()->month;

        $product_order_date = DB::table('tbl_order')->where('status',1)->whereDate('order_date',$date)->get();

        $product_order_month = DB::table('tbl_order')->where('status',1)->whereMonth('order_date',$month)->get();

        session::put('message', DB::table('tbl_order')->where('status',0)->count());

        $response = new Response();

        $alert=  $response->withcookie('hjftgkk','dàdsfs',1000000);

        if(isset($alert)){
            
            return view('admin.dashboard')
                  ->with('alert',$alert)
                  ->with('product_order_date',$product_order_date)
                  ->with('product_order_month',$product_order_month);

        }else{

            return view('admin.login.admin_login');

        }

    }
    //QUẢN LÝ ĐƠN HÀNG
    public function order(){
        $this->AuthLogin();

        $product_order = DB::table('tbl_order')->orderby('orderid','desc')->paginate(10);

        session::put('message', DB::table('tbl_order')->where('status',0)->count());

        return view('admin.order.order')->with('product_order',$product_order);

    }

    public function log_out(){
        Session::put('session_id',null);

        return redirect('/admin-login');

    }

    //convert status 0->1
    public function update_status_0($orderid){
        $this->AuthLogin();

        $data['status'] = 1;

        DB::table('tbl_order')->where('orderid',$orderid)->update($data);

        return back();
    }

    //covert status 1->0
    public function update_status_1($orderid){ 
        $this->AuthLogin();

        $data['status'] = 0;

        DB::table('tbl_order')->where('orderid',$orderid)->update($data);

        return back();

    }

    //remove oder complete
    public function delete_status_1($orderid){
        $this->AuthLogin();

        DB::table('tbl_order')->where('orderid',$orderid)->delete();

        return back();

    }

    //destroy muti order
    public function destroy_order(Request $request){

        $this->AuthLogin();

        $order_id =$request->orderid;

        if(isset($order_id)) {
            DB::table('tbl_order')->whereIn('orderid',$order_id)->delete();

            return back();
        }
        else {

            return back();
        }

    }

    public function search_order(Request $request){
        $this->AuthLogin();

        $key_word = $request->search;

        $search = DB::table('tbl_order')->orderby('orderid','desc')->where('cusname','like','%'.$key_word.'%')
        ->orWhere('status',$key_word)
        ->orWhere('productname','like','%'.$key_word.'%')->paginate(30);

        return view('admin.search.search')->with('search',$search);

    }

    public function search_product_order(Request $request){
        $this->AuthLogin();

        $key_word = $request->search;

        $search = DB::table('tbl_order')->orderby('orderid','desc')->where('cusname','like','%'.$key_word.'%')
        ->orWhere('status',$key_word)
        ->orWhere('productname','like','%'.$key_word.'%')->paginate(30);
        return view('admin.search.search')->with('search',$search);

    }

    public function order_not_complete(){
        $this->AuthLogin();

        $order_not_complete = DB::table('tbl_order')->orderby('orderid','desc')->where('status',0)->paginate(30);
        
        return view('admin.order.order_not_complete')->with('order_not_complete',$order_not_complete);

    }

    public function order_complete(){
        $this->AuthLogin();

        $order_complete = DB::table('tbl_order')->orderby('orderid','desc')->where('status',1)->paginate(30);
        
        return view('admin.order.order_complete')->with('order_complete',$order_complete);

    }

    public function searchProduct(Request $request){

        $this->AuthLogin();

        $key_word = $request->search;

        $search = DB::table('tbl_product')->orderby('product_id','desc')
                ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
                ->orderby('product_id','desc')->where('product_Name','like','%'.$key_word.'%')
                ->orWhere('tbl_category_product.category_name','like','%'.$key_word.'%')
                ->paginate(30);

        return view('admin.search.searchproduct')->with('search',$search);

    }

    public function searchProduct_item(Request $request){

        $this->AuthLogin();
        
        $key_word = $request->search;

        $search = DB::table('tbl_product')->orderby('product_id','desc')
                    ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
                    ->orderby('product_id','desc')->where('product_Name','like','%'.$key_word.'%')
                    ->orWhere('tbl_category_product.category_name','like','%'.$key_word.'%')
                    ->paginate(30);

        return view('admin.search.searchproduct')->with('search',$search);
    }

    //THÔNG TIN ĐƠN HÀNG KHÁCH ĐÃ ĐẶT
    public function infocustomerorder($orderid){

        $this->AuthLogin();

        $infocustomer = CustomerorderModel::where('orderid',$orderid)->get();

        return view('admin.infoOrder.infoOrder',['infocustomerorder'=>$infocustomer]);

    }

    public function upload(Request $request){

        $this->AuthLogin();
        
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File                     //storage/app/public/uploads
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/app/public/uploads/'.$filenametostore);
            $msg = 'Upload Ảnh Thành Công';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;

        }
    }
}
