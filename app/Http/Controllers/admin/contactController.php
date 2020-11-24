<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Model\contactModel;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\admin\AdminController;
class contactController extends AdminController{

    public function contactadmin(){

        $contact= contactModel::select()->orderby('Con_Id','desc')->paginate(10);

        return view('admin.contact.contact')->with(compact('contact'));
    }

    public function update_status_0($Con_Id){

        $data['status'] = 1;

        contactModel ::where('Con_Id',$Con_Id)->update($data);

        return redirect('/contact');
    }

    public function update_status_1($Con_Id){

        $data['status'] = 0;

        contactModel ::where('Con_Id',$Con_Id)->update($data);

        return redirect('/contact');
    }

    public function delete_status_1($Con_Id){

        contactModel ::where('Con_Id',$Con_Id)->delete();

        return redirect('/contact');
    }
}
