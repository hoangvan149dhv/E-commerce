<?php

namespace App\Http\Controllers;
use App\Cartcount;
use Illuminate\Http\Request;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; //   
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\CustomerorderModel;
use App\count;
class AdminController extends Controller
{
    //KIỂM TRA ĐĂNG NHẬP
    public function AuthLogin(){
        $admin_id = Session::get('admin_Id');
        if($admin_id){
             return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin-login-dashboard')->send();
                           //Send là == chuyển ĐẾN TRANG -->RẤT QUAN TRỌNG
         }
    }


    // VÀO TRANG ĐĂNG NHẬP
    public function login(){ 

        $admin_id = Session::get('admin_Id');
        if($admin_id){ 
            return Redirect::to('admin-quanly');
        }else{ 
            return view('admin_login'); //Đường Dẫn admin_login.blade.php
        }
    }

    //ĐĂNG NHẬP ĐÚNG TK MK
    //ĐIỀU KHIỂN  //QUẢN LÝ
    public function check_login(Request $request){
        $admin_email = $request->Email; //DÒNG 35 admin_login.blade.php
        $admin_pass = addslashes(md5($request->Password));
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_pass',$admin_pass)->first();
                                 // admin_email, admin_pass là trong dbs first là lấy giá trị đầu tiên

        //NẾU ĐĂNG NHẬP ĐÚNG
        if($result){
            //TRẢ VỀ TRANG THÔNG TIN ĐƠN HÀNG KHÁCH ĐẶT
            $date=  Carbon::now()->day;
            $month=  Carbon::now()->month;
            $product_order_date = DB::table('tbl_order')->where('status',1)->whereDate('order_date',$date)->get();
            $product_order_month = DB::table('tbl_order')->where('status',1)->whereMonth('order_date',$month)->get();
            session::put('admin_name', $result->admin_name); //admin_name trong dbs
            session::put('admin_Id', $result->admin_Id); //admin_Id trong dbs`  
            session::put('message', DB::table('tbl_order')->where('status',0)->count()); // ĐẾM

            $response = new Response();
            $alert=  $response->withcookie($result->admin_name,$result->admin_name,1000000);
                if(isset($alert)){
                    return view('admin.dashboard')
                    ->with('alert',$alert)  
                    ->with('product_order_date',$product_order_date)
                    ->with('product_order_month',$product_order_month);
                }
                else{
                    return view('admin_login');
                }
                    // return view('admin.dashboard')
                    // // ->with('alert',$alert)  
                    // ->with('product_order_date',$product_order_date)
                    // ->with('product_order_month',$product_order_month);
                    // return view('admin.dashboard')
                    // ->with('alert',$alert)
                    // ->with('product_order_date',$product_order_date)
                    // ->with('product_order_month',$product_order_month);
            
                
        }else{
            echo  "<script type='text/javascript'>
                    alert('Sai Mật Khẩu ');
                </script>";
                return view('admin_login');
        }
    }
    public function __construct(){
        //ĐÉM SỐ LƯỢT TRUY CẬP
        $count = count::find(1);
                //Số lượt truy cập trong ngày
        // $date=  Carbon::now()->day;

        // $month=  Carbon::now()->month;
        
        view()->share('count',$count); // all
        // view()->share('count_date',$count_date); //date
        // view()->share('count_month',$count_month); //month
    }
    //cHUYỂN ĐẾN TRANG CHỦ ADMIN 
    public function index(){
            //KIỂM TRA NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP CHƯA
            $this->AuthLogin();
            $date=  Carbon::now()->day;
            $month=  Carbon::now()->month;
            $product_order_date = DB::table('tbl_order')->where('status',1)->whereDate('order_date',$date)->get();
            // $count_date =DB::table('tbl_count')->where('id',1)->whereDate('created_at',$date)->get();
            // $count_month = DB::table('tbl_count')->where('id',1)->whereMonth('created_at',$month)->get();
            $product_order_month = DB::table('tbl_order')->where('status',1)->whereMonth('order_date',$month)->get();
        session::put('message', DB::table('tbl_order')->where('status',0)->count());
        $response = new Response();
        $alert=  $response->withcookie('hjftgkk','dàdsfs',1000000);
        if(isset($alert)){
            return view('admin.dashboard')
            ->with('alert',$alert)  
            ->with('product_order_date',$product_order_date)
            // ->with('count_month',$count_month)
            // ->with('count_date',$count_date)
            ->with('product_order_month',$product_order_month);
        }
        else{
            return view('admin_login');
        }
    }
    
    //QUẢN LÝ ĐƠN HÀNG
    public function order(){
        //KIỂM TRA NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP CHƯA
        $this->AuthLogin();

    $product_order = DB::table('tbl_order')->orderby('orderid','desc')->paginate(10);
    // return Redirect::to('/admin-login'); //Đường Dẫn admin_login.blade.php
    session::put('message', DB::table('tbl_order')->where('status',0)->count());
    return view('admin.order.order')->with('product_order',$product_order);
}
    public function log_out(){
        // return Redirect::to('/admin-login'); //Đường Dẫn admin_login.blade.php
        Session::put('admin_Id',null);
        return redirect('/admin-login-dashboard');
    }


    //CHUYỂN TRẠNG THÁI GIAO HÀNG CHƯA GIAO THÀNH ĐÃ GIAO
    public function update_status_0($orderid){
        $data['status'] = 1;
        DB::table('tbl_order')->where('orderid',$orderid)->update($data);
        return back();
    }
    //CHUYỂN TRẠNG THÁI GIAO HÀNG ĐÃ GIAO THÀNH CHƯA GIAO
    public function update_status_1($orderid){
        $data['status'] = 0;
        DB::table('tbl_order')->where('orderid',$orderid)->update($data);
        return back();
    }
    //XÓA ĐƠN HÀNG ĐÃ GIAO XONG
    public function delete_status_1($orderid){
        DB::table('tbl_order')->where('orderid',$orderid)->delete();
        return back();
    }
    //Hủy nhiều đơn hàng
    public function destroy_order(Request $request){

        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 
        $order_id =$request->orderid;
        if(isset($order_id)){
            DB::table('tbl_order')->whereIn('orderid',$order_id)->delete();
            return back();
        }
            else{
                return back();
            }
    }
    ////////////////TÌM KIÊM Đơn hàng khách đã đặt///////////////////////
    public function search_order(Request $request){
        $this->AuthLogin();
        $key_word = $request->search;

        $search = DB::table('tbl_order')->orderby('orderid','desc')->where('cusname','like','%'.$key_word.'%')
        ->orWhere('status',$key_word)
        ->orWhere('productname','like','%'.$key_word.'%')->paginate(30);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('admin.search.search')->with('search',$search);
    }
    public function search_product_order(Request $request){
        $this->AuthLogin();
        $key_word = $request->search;

        $search = DB::table('tbl_order')->orderby('orderid','desc')->where('cusname','like','%'.$key_word.'%')
        ->orWhere('status',$key_word)
        ->orWhere('productname','like','%'.$key_word.'%')->paginate(30);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('admin.search.search')->with('search',$search);
    }
    
    public function order_not_complete(){
        $this->AuthLogin();
        $order_not_complete = DB::table('tbl_order')->orderby('orderid','desc')->where('status',0)->paginate(30);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('admin.order.order_not_complete')->with('order_not_complete',$order_not_complete);
    }
    public function order_complete(){
        $this->AuthLogin();
        $order_complete = DB::table('tbl_order')->orderby('orderid','desc')->where('status',1)->paginate(30);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('admin.order.order_complete')->with('order_complete',$order_complete);
    }









/////////////////TÌM KIẾM SẢN PHẨM///////////////////
    public function searchProduct(Request $request){
        $this->AuthLogin();
        $key_word = $request->search;

        $search = DB::table('tbl_product')->orderby('product_id','desc')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->orderby('product_id','desc')->where('product_Name','like','%'.$key_word.'%')
        ->orWhere('tbl_category_product.category_name','like','%'.$key_word.'%')
        ->paginate(30);
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
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
                                            //CẤU TRÚC TÌM KIẾM GẦN GIỐNG NHƯ
        return view('admin.search.searchproduct')->with('search',$search);
    }

    //THÔNG TIN ĐƠN HÀNG KHÁCH ĐÃ ĐẶT
    public function infocustomerorder($orderid){
        $this->AuthLogin();
        $infocustomer = CustomerorderModel::where('orderid',$orderid)->get();
        return view('admin.infoOrder.infoOrder',['infocustomerorder'=>$infocustomer]);
    }
    public function upload(Request $request)
    {
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
