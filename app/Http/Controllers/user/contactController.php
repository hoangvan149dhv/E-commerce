<?php

namespace App\Http\Controllers\user;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Model\contactModel;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Model\contactinfoModel;
use App\Http\Controllers\user\HomeController;
class contactController extends HomeController{
    public function Contact()
    {


    }

    public function insertContact(request $request)
    {
        $contactModel = new contactModel();
        $contactModel->Con_Name = $request['name'];
        $contactModel->Con_Email = $request['email'];
        $contactModel->Con_Content = $request['content'];
        $contactModel->status = 0;

        if (!$contactModel->save())
        {
            Session::put('success','Góp ý thất bại, vui lòng thử lại sau');
        }
        else
        {
            Session::put('success','Cảm ơn bạn đã góp ý');
        }

        return redirect('/lien-he');
    }
}
