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
use App\Http\Model\customerModel;
use App\Http\Controllers\pdfController as pdfController;

class orderController extends HomeController
{
    public function payment_order(Request $request)
    {
        $order_data['product_id'] = '';
        $order_data['qty'] = '';
        $dataCart = Cart::content();
        // INSERT CUSTOMER
        $cus_data['cusname'] = $request->name;
        $cus_data['cusEmail'] = $request->email;
        $cus_data['cusadd'] = $request->add;
        $cus_data['cusPhone'] = $request->phone;
        $cus_data['cusNote'] = $request->note;
        if (empty($request->phone) || empty($request->add) || empty($request->name)) {
            return Redirect::to('/');
        } else {
            $cus_id = DB::table('tbl_customer')->insertGetId($cus_data);
            $order_data['total'] = 0;
            // INSERT ORDER_PAYMENT
            foreach ($dataCart as $data) {
                $order_data['cusid'] = $cus_id;
                $order_data['product_id'] .= ','.$data->id;
                $order_data['qty'] .= ','.$data->qty;
                $order_data['fee_ship'] = $request->val_feeship;
                $order_data['total'] += ($data->price * $data->qty) + $order_data['fee_ship'];
                $order_data['status'] = 0;
            }
            $order_data['product_id'] = substr($order_data['product_id'], 1);
            $order_data['qty'] = substr($order_data['qty'], 1);

            if ( ! $order_data['product_id']) {
                customerModel::remove($cus_id);
                return Redirect::to('/');
            }

            $orderId = DB::table('tbl_orders')->insertGetId($order_data);

            $item_detail_order = CustomerorderModel::where('orderid', $orderId)->get();
            Cart::destroy();
            try {
                if ($item_detail_order) {
                    $template = templateMailModel::where('status', 'Hiện')->get();
                    // pdfController::convertPDF($orderId, $template[0]->template);
                    $EmailName = configMailModel::select()->get();
                    if ( ! empty($EmailName[0]->publish)) {
                        //SEND MAIL
                        $sendmail = new sendMailController();
                        $mailconfig_recipient = $EmailName[0]->Email;
                        $ccname = $cus_data['cusEmail'];
                        $bccname = array("hoangvan149dhv@gmail.com");

                        //Subject (mail)
                        $subject = $template[0]->label;

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
                }
            } catch (\RuntimeException $e) {

                throw new \RuntimeException($e->getMessage(), $e->getCode());
            }
            return view('user.payment.payment_order');
        }
    }
}
