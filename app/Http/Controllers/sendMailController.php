<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Http\Model\configMailModel;
use App\Http\Model\templateMailModel;
use View;
use Mail;
use DB;
use App\Http\Model\CustomerorderModel;
use App\Http\library\replace_template;
class sendMailController extends Controller
{
    /**
     * SEND MAIL
     * @param   string  $subject   label mail
     * @param   string  $file_template_mail file display template
     * @param   string  $template   body mail
     * @param   string  $fromname name user sendmail
     * @param   string  $mailconfig_recipient  user recipient
     * @param   string  $ccname cc user recipient
     * @param   string  $item_detail_order order detail
     */
    public function sendMail(&$fromname , $mailconfig_recipient,
                             $ccname, $bccname, $subject, $file_template_mail,
                             $template ,$item_detail_order) 
    {
        //template mail display
        $EmailName = configMailModel::select()->get();
        
        if (empty($EmailName[0]->publish)) {
            return ; 
        }
        foreach ($EmailName as $key => $value) {
       
            //value mail config in admin
            $fromname             = $value->name_email;
            
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
    }

    public function sendtestMail(){
        try {
             $EmailName = configMailModel::select()->get();
             if (empty($EmailName[0]->publish)) {
                 Session::put('send-mail-success','Vui lòng bật chức năng gửi mail');
                return back(); 
            }

             foreach ($EmailName as $key => $value) {
             }

             //value mail config in admin

             //SUBJECT
             $subject = "Test Mail thành công";
             $template = "send mail thành công";
             $file_template_mail = "mails.testmail";
             $mailconfig_recipient = $value->Email;
             $ccname    = array("hoangvan1491999@gmail.com");
             $bccname    = array("hoangvan149dhv@gmail.com");

             $this->sendMail($fromname, $mailconfig_recipient,
                 $ccname, $bccname, $subject,
                 $file_template_mail, $template, $item_detail_order = null);

             Session::put('send-mail-success','send mail thành công');
        } catch (Exception $e) {
            // Call report() method of App\Exceptions\Handler
            $this->reportException($e);
    return false;
            // Call render() method of App\Exceptions\Handler
        }

        return back();
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
    public function abc(){
        $template = \App\Http\Model\templateMailModel::where('status', 'Hiện')->get();
        $replace_Template = new replace_template();
        $replace_Template->replace_orderID(39, $template[0]->template);
    }
}


