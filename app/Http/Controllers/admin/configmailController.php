<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\configMailModel;
use App\templateMailModel;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Config;
class configmailController extends AdminController
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
        $pushlish_mail = empty($req->publish) ? 2 : 1;
        Config::set(['config_admin.mail.publish'=> $pushlish_mail]);

        $data['Email'] = $req->Email;
        $data['name_email'] = $req->name;
        $configMail = new configMailModel();
        $configMail->where('id',1)->update($data);
        var_dump( Config::get('config_admin.mail.publish'));die;
        Session::put('add-config-mail-success','Lưu thông tin thành công');

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

            templateMailModel::where('id',$id)->update(['status'=>'Hiện']);
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
}
