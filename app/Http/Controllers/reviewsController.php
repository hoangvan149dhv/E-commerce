<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session; // THƯ VIỆN SỬ DỤNG SESSION
// use App\Http\Requests; // 
// use Illuminate\Support\Facades\Redirect;
// session_start();
use App\contactModel;
use Illuminate\Support\Facades\Redirect;
use App\ReviewModel;
use Validator;  //neu cac ban co su dung validate
class reviewsController extends Controller
{
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// LÀM VIỆC VỚI ADMIN
//////ADMIN
    public function reviews(){
        $reviews= ReviewModel::select()->orderby('Rid','desc')->paginate(10);
        return view('admin.reviews.reviews')->with(compact('reviews'));
    }   
        // //XÓA Reviews
        public function delete_status_1($Rid){
            ReviewModel ::where('Rid',$Rid)->delete();
        return redirect('/reviews');
        }
}
