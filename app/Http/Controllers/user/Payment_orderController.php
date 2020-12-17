<?php

namespace App\Http\Controllers\user;

use App\Http\library\replace_template;
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

class Payment_orderController extends HomeController
{
    public function payment_order(Request $request){
        $order_data['product_id'] = '';
        $order_data['qty']        = '';
        $content = Cart::content();

        // INSERT CUSTOMER
        $cus_data['cusname'] = $request->name;
        $cus_data['cusEmail'] = $request->email;
        $cus_data['cusadd'] = $request->add;
        $cus_data['cusPhone'] = $request->phone;
        $cus_data['cusNote'] = $request->note;
        if(empty($request->phone)|| empty($request->add) || empty($request->name)){

            Session::put('error','Bạn Không Được Để Trống bất kì mục nào');
            return Redirect::to('/hien-thi-gio-hang');

        }
        else
        {

            $cus_id = DB::table('tbl_customer')->insertGetId($cus_data);
            $order_data['total'] = 0;
        // INSERT ORDER_PAYMENT
            foreach($content as $value_content) {
                $order_data['cusid']       = $cus_id;
                $order_data['product_id']  .= ',' . $value_content->id;
                $order_data['qty']         .= ',' . $value_content->qty;
                $order_data['fee_ship']    = $request->val_feeship;
                $order_data['total']       += ($value_content->price *$value_content->qty) + $order_data['fee_ship'];
                $order_data['status']      = 0;
            }
                $order_data['product_id'] = substr($order_data['product_id'], 1);
                $order_data['qty']        = substr($order_data['qty'], 1);
                $getIdorder = DB::table('tbl_orders')->insertGetId($order_data);

                $item_detail_order = CustomerorderModel::where('orderid',$getIdorder)->get();

                try {
                    if ($item_detail_order) {

                        $EmailName = configMailModel::select()->get();
                        foreach ($EmailName as $key => $value) {

                        }
                        if ( !empty($value->publish)) {
                            //SEND MAIL
                            $sendmail = new sendMailController();
                            //param
                            $template = templateMailModel::where('status', 'Hiện')->get();
                            foreach ($template as $key => $item) {
                            }

                            //CC Name //BCCNAME  //RECEIPT
                            $mailconfig_recipient = $value->Email;
                            $ccname = $cus_data['cusEmail'];
                            $bccname = array("hoangvan149dhv@gmail.com");

                            //Subject (mail)
                            $subject = $item->label;

                            //template order
                            $file_template_mail = "mails.order_mail";

                            $sendmail->sendMail(
                                $fromname,
                                $mailconfig_recipient,
                                $ccname,
                                $bccname,
                                $subject,
                                $file_template_mail,
                                $template,
                                $item_detail_order);
                        }
                        $replace_Template = new replace_template();
                        $mpdf = new \Mpdf\Mpdf();
                        $mpdf->WriteHTML( $replace_Template->replace_orderID($getIdorder, $template[0]->template));
                        $mpdf->Output('hoa don.pdf','I');
                        $mpdf->SetTitle("xxx");die;
                    }
                } catch (\RuntimeException $e) {

                    throw new \RuntimeException($e->getMessage(), $e->getCode());
                }

            Cart::destroy();


            return view('user.payment.payment_order');
        }
    }
}
