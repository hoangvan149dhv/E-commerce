<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Model\contactinfoModel;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\admin\AdminController;
class contactinfoController extends AdminController
{

    public function layout_insert_Infocontact(){

        $contactinfoModel = contactinfoModel::where('id_Info',1)->get();

        return view('admin.contact.addinfocontact')->with('contactinfoModel',$contactinfoModel);
    }

    public function save_info_contact(Request $Request){

        $data['google_map'] = $Request->googlemap;

        if($Request->googlemap == ""){
            $data['google_map'] = "";
        }

        $data['info_contact_add'] = $Request->add;
        $data['info_contact_phone'] = $Request->phone;
        $data['info_contact_mail'] = $Request->email;
        $contactinfoModel = new contactinfoModel;
        $contactinfoModel->where('id_Info',1)->update($data);

        return back();
    }
}
