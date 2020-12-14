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

    public function contactadmin() {

        $contact= contactModel::select()->orderby('id','desc')->paginate(10);

        return view('admin.contact.contact')->with(compact('contact'));
    }

    public function update_status_contact($id, $status){
        $data['status'] = $status;

        contactModel::where('id',$id)->update($data);

        return redirect('/contact');
    }


    public function delete_status($id){

        contactModel ::where('id',$id)->delete();

        return redirect('/contact');
    }
}
