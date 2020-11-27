<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\sendMailController;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Http\Model\count;
class loginController extends Controller
{
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

        //SEND MAIL
        $sendmail = new sendMailController();

        $admin_email = $request->name;

        $admin_question = $request->question;

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_question_getpass',$admin_question)->first();

        if($result){
            $ccname             = array();
            $bccname            = array("$admin_email");
            $mailconfig_recipient = array("$admin_email");
            $subject            = "Lấy mật khẩu từ Vải áo dài xinh";
            $file_template_mail = "mails.get_pass_admin";
            $template           = "";
            $item_detail_order  = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_question_getpass',$admin_question)->get();
            $sendmail->sendMail($fromname, $mailconfig_recipient, $ccname,
                                $bccname, $subject, $file_template_mail,
                                $template, $item_detail_order);
            echo "<script type='text/javascript'>
                    alert('Lấy mật khẩu thành công, Vui lòng kiểm tra mail');
                 </script>";

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
        $user_name = $request->Email;

        $admin_pass = addslashes(md5($request->Password));

        $result = DB::table('tbl_admin')->where('user_name',$user_name)->where('admin_pass',$admin_pass)->first();

        if($result)
        {

            $count = count::find(1);

            $date  = Carbon::now()->day;

            $month = Carbon::now()->month;

            $product_order_date = DB::table('tbl_orders')->where('status',1)->whereDate('order_date',$date)->get();

            $product_order_month = DB::table('tbl_orders')->where('status',1)->whereMonth('order_date',$month)->get();

            session::put('admin_name', $result->admin_name);

            session::put('session_id',md5( $result->admin_pass . Carbon::now()->day));

            session::put('message', DB::table('tbl_orders')->where('status',0)->count());

            view()->share('count',$count);

            return view('admin.dashboard')
                    ->with('product_order_date',$product_order_date)
                    ->with('product_order_month',$product_order_month);

        }
        else
        {
            echo "<script type='text/javascript'>
                  alert('Sai Mật Khẩu ');
                  </script>";

            return view('admin.login.admin_login');
        }
    }
}
