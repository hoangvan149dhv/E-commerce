<?php

namespace App\Http\Controllers\user;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Model\newsadminModel;
use DB;
use App\Http\Controllers\user\HomeController;
class newsadminController extends HomeController
{
    public function news_client(){

        $newsadminModel = newsadminModel::select()->orderby('news_id','desc')->paginate(5);

        return view('user.news.news')
              ->with('newsadminModel',$newsadminModel);

    }

        public function news_details_client($primaryKey,request $request){
        $newsadminModel = newsadminModel::find($primaryKey);
        $news_details = newsadminModel::select()->whereNotIn('news_id',[$primaryKey])->orderby('news_id','desc')->take(5)->get();
        $meta_desc= $newsadminModel->news_desc;
        $meta_title =  $newsadminModel->news_title;
        $url_canonical = $request->url();

        return view('user.news.newsdetails')
                ->with('meta_desc',$meta_desc)
                ->with('meta_title',$meta_title)
                ->with('url_canonical',$url_canonical)
                ->with('newsadminModel',$newsadminModel)
                ->with('news_details',$news_details);
    }
}


