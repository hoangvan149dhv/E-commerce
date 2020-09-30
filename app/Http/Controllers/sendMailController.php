<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use App\configMailModel;
use App\templateMailModel;
use View;
use Mail;
use App\Http\Controllers\Controller;
use DB;
use App\CustomerorderModel;
class sendMailController extends Controller
{
    /**
     * SEND MAIL
     * @param   string  $subject   label
     * @param   string  $file_template_mail content / display template
     * @param   string  $template
     * @param   string  $fromname name user sendmail
     * @param   string  $mailconfig_recipient  user recipient
     * @param   string  $ccname cc user recipient
     * @param   string  $item_detail_order order detail
     */
    public function sendMail(&$fromname , &$mailconfig_recipient,
                             &$ccname, &$bccname, &$subject, &$file_template_mail,
                             &$template ,$item_detail_order){

        //template mail display
        $file_template_mail = "mails.order_mail";

        $ccname    = array("hoangvan1491999@gmail.com");
        $bccname   = array("hoangvan149dhv@gmail.com");
        $EmailName = configMailModel::select()->get();
        foreach ($EmailName as $key => $value) {
        }

        //value mail config in admin
        $mailconfig_recipient = $value->Email;
        $fromname             = $value->name_email;

        //param
        $template = templateMailModel::where('status','Hiện')->get();
        foreach ($template as $key => $item) {
        }
        $subject              = $item->label;
        $data = array('email_recipient' => $mailconfig_recipient,
                      'subject' => $subject, 'fromname' => $fromname,
                      'ccname' => $ccname, 'bccname' => $bccname);

        //layout message
        view()->share('item_detail_order',$item_detail_order);
        view()->share('template',$template);

        Mail::send($file_template_mail, $data,

        function ($message) use ($data, $value) {

        $message->from( 'vandaovipga1491999@gmail.com',$data['fromname']);
        $message->to( $data['email_recipient'])->cc($data['ccname'])->bcc($data['bccname']);
        $message->subject($data['subject']);
        });
    }










    //demo
    function test(){
//        $item_detail_order = CustomerorderModel::where('orderid',$getIdorder)->get();
        $template = templateMailModel::where('status','Hiện')->get();
        foreach ($template as $key => $item) {
        }
        $item_detail_order = CustomerorderModel::where('orderid',9)->get();
        view()->share('template',$template);
        view()->share('item_detail_order',$item_detail_order);
        return view('mails.order_mail');
//        $EmailName = configMailModel::select()->get();
//        foreach ($EmailName as $key => $value) {
//            $value->Email;
//        }
//        $template = templateMailModel::where('status','Hiện')->get();
//        foreach ($template as $key => $item) {
//        }
//        $fromname = "hoang van";
//        $ccname   = "hoangvan149dhv@gmail.com";
//        $mailconfig_recipient = "van.duong@redweb.dk";
//        $subject =  $item->label;
//        $s = $this->sendMail($fromname , $mailconfig_recipient, $ccname, $subject, $template_mail);
//        if ( $s !== true ) {
//            echo 'Error sending email: ';
//        } else {
//            echo 'Mail sent';
//        }
    }
}


