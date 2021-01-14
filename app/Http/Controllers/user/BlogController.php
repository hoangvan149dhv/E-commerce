<?php

namespace App\Http\Controllers\user;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Model\newsadminModel;
use DB;
use App\Http\Controllers\user\HomeController;
class BlogController extends HomeController
{
    public function news_client() {

        $newsadminModel = newsadminModel::select()->orderby('news_id','desc')->paginate(4);

        return view('frontend.blogs.blogs')
              ->with('newsadminModel',$newsadminModel);
    }

    public function news_details_client($meta_slug,request $request){
    $newsadminModel = newsadminModel::select()->where('meta_slug',$meta_slug)->get();

    $news_details = newsadminModel::select()->whereNotIn('meta_slug',[$meta_slug])->orderby('news_id','desc')->take(5)->get();

    $meta_desc= $newsadminModel[0]->news_desc;
    $meta_title =  $newsadminModel[0]->news_title;
    $url_canonical = $request->url();

    return view('frontend.blogs.blogdetail')
            ->with('meta_desc',$meta_desc)
            ->with('meta_title',$meta_title)
            ->with('url_canonical',$url_canonical)
            ->with('newsadminModel',$newsadminModel)
            ->with('news_details',$news_details);
    }
}


