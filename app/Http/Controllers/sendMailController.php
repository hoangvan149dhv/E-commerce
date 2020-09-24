<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use App\configMailModel;
use App\templateMailModel;
use View;
use Mail;
use App\Http\Controllers\admin\AdminController;
use DB;
use App\CustomerorderModel;
class sendMailController extends AdminController
{
    public function layoutConfigMail(){
        $configmail = configMailModel::where('id',1)->get();
        return view('admin.mails.layoutconfig')->with('configmail',$configmail);
    }

    //create template mail
    public function layoutcreatetemplatemail(){
        return view('admin.mails.addtemplatemail');
    }

    //save templatemail
    public function savetemplatemail(Request $req){

        $data['template'] = $req->template;
        $data['label'] = $req->label;
        $data['status'] = "Ẩn";
        templateMailModel::insert($data);
        return back();
    }

    //save config mail
    public function saveConfigmail(Request $req){

        $data['Email'] = $req->Email;
        $data['name_email'] = $req->name;
        $configMail = new configMailModel();
        $configMail->where('id',1)->update($data);
        return back();

    }

    //show list templatemail user create
    public function listitemtemplatemail(){
       $itemlisttemplateMail =  templateMailModel::all();
       return view('admin.mails.alltemplate')->with(compact('itemlisttemplateMail'));
    }

    //check status mail
    public function update_status($id){
        $checkstatus_pushlished = templateMailModel::where('status','Hiện')->get();
        $checkstatus_un_pushlished = templateMailModel::where('status','Ẩn')->get();
        if((int) count($checkstatus_pushlished) > 1 || isset($checkstatus_un_pushlished) ){

            templateMailModel::where('status','Hiện')->update(['status'=>'Ẩn']);
        }
        if(isset($checkstatus_un_pushlished) ){
            $show_template = templateMailModel::where('id',$id)->update(['status'=>'Hiện']);
        }


        return back();
    }

    //layout update template mail
    function layout_update_template($id){
        $detailtemplateMail = templateMailModel::where('id',$id)->get();
        return view('admin.mails.updatetemplatemail')->with(compact('detailtemplateMail'));
    }
    //update template mail
    function update_template_mail($id, request $request){
        $detailtemplateMail = templateMailModel::find($id);
        $detailtemplateMail->label = $request['label'];
        $detailtemplateMail->template = $request['template'];
        $detailtemplateMail->status = $detailtemplateMail['status'];
            $detailtemplateMail->save();
            return back()->with('detailtemplateMail',$detailtemplateMail);

    }

    //delete template
    function delete_template_mail($id){
        templateMailModel::find($id)->delete();
        return back();
    }

    //display template Mail
    function templateMail(){
        $template = templateMailModel::where('status','Hiện')->get();

        return view('admin.mails.templatemail')->with(compact('template'));
    }

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
    public function sendMail(&$fromname , &$mailconfig_recipient, &$ccname, &$subject, &$file_template_mail,&$template ,$item_detail_order){

        //template mail display
        $file_template_mail = "mails.order_mail";

        $ccname = array("hoangvan149dhv@gmail.com","hoangvan1491999@gmail.com");

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
        $data = array('email_recipient' => $mailconfig_recipient, 'subject' => $subject, 'fromname' => $fromname, 'ccname' => $ccname);

        //layout message
        view()->share('item_detail_order',$item_detail_order);
        view()->share('template',$template);

        Mail::send($file_template_mail, $data,

        function ($message) use ($data, $value) {

        $message->from( 'vandaovipga1491999@gmail.com',$data['fromname']);
        $message->to( $data['email_recipient'])->cc($data['ccname']);
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


