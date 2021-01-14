<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\newsadminModel;
use DB;
use App\Http\Controllers\admin\AdminController;
class newsadminController extends AdminController
{

    public function insertNews(request $Request) {

        $newsadminModel = new newsadminModel();
        $newsadminModel['news_title'] = $Request['title'];

        $newsadminModel->news_desc = $Request['desc'];
        $newsadminModel->news_content = $Request['content'];
        $newsadminModel->meta_slug = \Mix::utf8tourl($newsadminModel['news_title']). "-" . rand(1,999);

        if( $newsadminModel->news_content==""){

            $newsadminModel->news_content="Chưa có thông tin";

        }

        $get_image=$Request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();

            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/upload',$new_image);
            $newsadminModel->news_image = $new_image;

        }else{
            $newsadminModel->news_image =='';
            Session::put('success','Thêm bản tin Thành Công');

            return redirect::to('add-news');
        }

        $newsadminModel->save();
        Session::put('success','Thêm bản tin Thành Công');

        return redirect::to('add-news');

    }

    public function layoutallNews(){

        $newsadminModel= newsadminModel::select()->orderBy('news_id','desc')->paginate(10);
        // $newsadminModel
        return view('admin.news.allnews')->with(compact('newsadminModel'));

    }
    //Show detail reviews on product
    public function newsdetails($primaryKey){

        $newsadminModel= newsadminModel::find($primaryKey);

        return view('admin.news.detailsallnews')->with(compact('newsadminModel'));

    }

    public function delete_news($primaryKey){
        $newsadminModel = newsadminModel::find($primaryKey);
        $news_img_old = $newsadminModel->news_image;
        \App\Http\library\media::cleanImage($news_img_old);
        $newsadminModel->delete();

        return back();

    }
    //UPDATE
    public function edit_news($primaryKey) {

        $newsadminModel = newsadminModel::find($primaryKey);
        return view('admin.news.updatenews')->with('newsadminModel',$newsadminModel);

    }

    public function update_news($primaryKey,  request $Request) {

        $newsadminModel = newsadminModel::find($primaryKey);
        $newsadminModel->news_title = $Request['title'];
        $newsadminModel->news_desc = $Request['desc'];
        $newsadminModel->news_content = $Request['content'];
        $newsadminModel->meta_slug = \Mix::utf8tourl($newsadminModel->news_title). "-" . rand(1,999);
        $get_image = $Request->file('image');
        $news_img_old = $newsadminModel->news_image;

        //remove image old if user update
        \App\Http\library\media::cleanImage($news_img_old);

        if ( $newsadminModel->news_content=="")
        {
            $newsadminModel->news_content="Chưa có thông tin";
        }

        if (empty($get_image)) {



            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');

            return redirect::to('edit-news/'.$primaryKey);

        } elseif ($get_image) {

            $get_name_image = $get_image->getClientOriginalName();

            $name_image = current(explode('.',$get_name_image));

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/upload',$new_image);
            $newsadminModel->news_image = $new_image;

            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');
            $newsadminModel = $this->edit_news($primaryKey);

            return $newsadminModel;
        }
    }
}


