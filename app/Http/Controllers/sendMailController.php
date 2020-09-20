<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use App\configMailModel;
use App\templateMailModel;
use View;
use Mail;
use DB;
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

    //send mail
    public function sendMail(request $req){
        $EmailName = configMailModel::select()->get();
        foreach ($EmailName as $key => $value) {
             $value->Email;
        }
        $template = templateMailModel::where('status','Hiện')->get();
        foreach ($template as $key => $item) {
        }
        $mailid = $value->Email;
        $subject = $item->label;
        $data = array('email' => $mailid, 'subject' => $subject);
                    //layout message
        view()->share('template',$template);
        Mail::send('mails.mail', $data, 

        function ($message) use ($data, $value) {

        $message->from( 'vandaovipga1491999@gmail.com','Áo dài xinh');
        $message->to( $data['email']);
        $message->subject($data['subject']); 
        });

        return redirect()->back()->with('message','Successfully Send Your Mail Id.');
    }
}