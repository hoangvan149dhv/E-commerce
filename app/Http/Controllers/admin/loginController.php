<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\count;
use Illuminate\Database\Query\Builder;
class loginController extends Controller
{
    
    //KIỂM TRA ĐĂNG NHẬP
    public function AuthLogin(){
        $session_id = session::get('session_id');

        if(empty($session_id)){
            
            return Redirect::to('admin-login')->send();        
        }
    }
    //check login if user already login
    public function login(){

        $session_id = Session::get('session_id');

        if($session_id){
            
            return Redirect::to('admin-quanly');

        }else{

            return view('admin.login.admin_login');
        }

    }
    //Quên mật khẩu
    public function layout_forget_pass(){

        return view('admin.login.forgetpass');

    }

    public function get_pass(Request $request){

        $admin_name = $request->name;

        $admin_question = $request->question;

        $result = DB::table('tbl_admin')->where('admin_email',$admin_name)->where('admin_phone',$admin_question)->first();

        if($result){

            return  view('admin.login.getpass')->with('result',$result);

        }else{

            echo"<script type='text/javascript'>
                    alert('Câu hỏi bảo mật không đúng');
                 </script>";
                 
            return view('admin.login.admin_login');
        }
    }
    //check user password when user fill  
    public function check_login_user_pass(Request $request){
        $admin_email = $request->Email;

        $admin_pass = addslashes(md5($request->Password));

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_pass',$admin_pass)->first();

        if($result){

            $count = count::find(1);
            
            $date  = Carbon::now()->day;

            $month = Carbon::now()->month;

            $product_order_date = DB::table('tbl_order')->where('status',1)->whereDate('order_date',$date)->get();

            $product_order_month = DB::table('tbl_order')->where('status',1)->whereMonth('order_date',$month)->get();

            session::put('admin_name', $result->admin_name); 

            session::put('session_id',md5( $result->admin_pass . Carbon::now()->day));
            
            session::put('message', DB::table('tbl_order')->where('status',0)->count());
            
            $response = new Response();

            $alert=  $response->withcookie($result->admin_name,$result->admin_name,1000000);

            if(isset($alert)){
                
                view()->share('count',$count);

                return view('admin.dashboard')
                    ->with('alert',$alert)
                    ->with('product_order_date',$product_order_date)
                    ->with('product_order_month',$product_order_month);
            }
            else{

                return view('admin.login.admin_login');
                }
        }else{
            echo "<script type='text/javascript'>
                  alert('Sai Mật Khẩu ');
                  </script>";

            return view('admin.login.admin_login');
        }
    }
}
