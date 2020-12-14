<?php

namespace App\Http\Controllers\admin;
use DB;
use Session;
use App\Http\Model\ReviewModel;
use Validator;
use App\Http\Controllers\admin\AdminController;
class reviewsController extends AdminController {

    public function reviews(){

        $reviews= ReviewModel::select()->orderby('Rid','desc')->paginate(10);

        return view('admin.reviews.reviews')->with(compact('reviews'));

    }

    public function delete_status($Rid){

        ReviewModel ::where('Rid',$Rid)->delete();

        return redirect('/reviews');

    }
}
