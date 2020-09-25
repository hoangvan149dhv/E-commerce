<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use Session;
use App\contactModel;
use Illuminate\Support\Facades\Redirect;
use App\ReviewModel;
use App\contactinfoModel;
use Validator;
use App\Http\Controllers\admin\AdminController;
class reviewsController extends AdminController {

    public function __construct(){
        $this->AuthLogin();
    }

    public function reviews(){

        $reviews= ReviewModel::select()->orderby('Rid','desc')->paginate(10);
        return view('admin.reviews.reviews')->with(compact('reviews'));

    }
        //remove Reviews
    public function delete_status_1($Rid){

        ReviewModel ::where('Rid',$Rid)->delete();
        return redirect('/reviews');

    }
}