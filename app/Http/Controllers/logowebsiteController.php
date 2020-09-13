<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logowebsiteController extends AdminController
{
    public function layout_Logo(){
        $this->AuthLogin();
        return view('admin.logo.layoutlogo');
    }
}
