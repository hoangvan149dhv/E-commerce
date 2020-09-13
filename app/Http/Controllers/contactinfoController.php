<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session; 
use App\contactinfoModel;
use Illuminate\Support\Facades\Redirect;
class contactinfoController extends AdminController
{
    public function layout_insert_Infocontact($info_Id){
        $this->AuthLogin(); 
        $contactinfoModel = contactinfoModel::where('id_Info',$info_Id)->get();
        return view('admin.addinfocontact')->with('contactinfoModel',$contactinfoModel);
    }
    public function save_info_contact(Request $Request){
        $this->AuthLogin();
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