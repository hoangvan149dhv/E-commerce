<?php

namespace App\Http\Controllers\user;

use App\Http\Model\configMailModel;
use Illuminate\Http\Request;
use Cart;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\CustomerorderModel;
use App\Http\Controllers\sendMailController;
use App\Http\Model\templateMailModel;
use App\Http\Controllers\user\HomeController;
require dirname(__FILE__, 5). '/mpdf/vendor/autoload.php';

class Payment_orderController extends HomeController
{
    public function payment_order(Request $request){

        $content = Cart::content();

        // INSERT CUSTOMER
        $cus_data['cusname'] = $request->name;
        $cus_data['cusadd'] = $request->add;
        $cus_data['cusPhone'] =$request->phone;

        if(empty($request->phone)|| empty($request->add) || empty($request->name)){

            Session::put('error','Bạn Không Được Để Trống bất kì mục nào');
            return Redirect::to('/hien-thi-gio-hang');

        }else{

            $cus_id = DB::table('tbl_customer')->insertGetId($cus_data);

        // INSERT ORDER_PAYMENT
            foreach($content as $value_content){
                $order_data['cusid']       = $cus_id;
                $order_data['cusname']     = $request->name;
                $order_data['product_id']  = $value_content->id;
                $order_data['productname'] = $value_content->name;
                $order_data['price']       = $value_content->price;
                $order_data['soluong']     = $value_content->qty;
                $order_data['fee_ship']    = $request->val_feeship;
                $order_data['total']       = ($order_data['price'] * $order_data['soluong']) +  $order_data['fee_ship'];
                $order_data['image']       = $value_content->options->images;
                $order_data['cusphone']    = $request->phone;

                if(empty($request->note))
                {
                    $order_data['note'] = "Null";
                }else {
                    $order_data['note'] = $request->note; //GHI CHÚ
                }
                $order_data['status']="đang xử lý"; //TRẠNG THÁI XỬ LÝ

                $getIdorder = DB::table('tbl_orders')->insertGetId($order_data);

                $item_detail_order = CustomerorderModel::where('orderid',$getIdorder)->get();

                try {
                    if ($item_detail_order) {

                        $EmailName = configMailModel::select()->get();
                        foreach ($EmailName as $key => $value) {
                        }

                        //SEND MAIL
                        $sendmail = new sendMailController();
                        //param
                        $template = templateMailModel::where('status', 'Hiện')->get();
                        foreach ($template as $key => $item) {
                        }

                        //CC Name //BCCNAME  //RECEIPT
                        $mailconfig_recipient = $value->Email;
                        $ccname = array("$request->email");
                        $bccname = array("hoangvan149dhv@gmail.com");

                        //Subject (mail)
                        $subject = $item->label;

                        //template order
                        $file_template_mail = "mails.order_mail";

                        if (!$sendmail->sendMail(
                            $fromname,
                            $mailconfig_recipient,
                            $ccname,
                            $bccname,
                            $subject,
                            $file_template_mail,
                            $template,
                            $item_detail_order)){
                            continue;
                        }

                        $mpdf = new \Mpdf\Mpdf();
                        $mpdf->WriteHTML($template[0]->template);
                        $mpdf->Output('hoa don.pdf','I');
                        $mpdf->SetTitle("xxx");
                    }
                } catch (\RuntimeException $e) {

                    throw new \RuntimeException($e->getMessage(), $e->getCode());
                }
            }
            Cart::destroy();


            return view('user.payment.payment_order');
        }
    }
}
