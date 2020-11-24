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

    public function layoutaddNews(){

        return view('admin.news.addnews');

    }
    //THÊM BÀI VIẾT
    public function insertNews(request $Request){

        $newsadminModel = new newsadminModel();
        $newsadminModel['news_title'] = $Request['title'];

        $newsadminModel->news_desc = $Request['desc'];
        $newsadminModel->news_content = $Request['content'];

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


    // HIỂN THỊ TẤT CẢ BÀI VIẾT
    public function layoutallNews(){

        $newsadminModel= newsadminModel::select()->orderBy('news_id','desc')->paginate(10);
        // $newsadminModel
        return view('admin.news.allnews')->with(compact('newsadminModel'));

    }
    //HIỂN THỊ CHI TIẾT TỪNG BÀI VIẾT
    public function newsdetails($primaryKey){

        $newsadminModel= newsadminModel::find($primaryKey);

        return view('admin.news.detailsallnews')->with(compact('newsadminModel'));

    }

        //XÓA BÀI VIẾT
    public function delete_news($primaryKey){

        $newsadminModel = newsadminModel::find($primaryKey);
        $newsadminModel->delete();

        foreach ($newsadminModel as $key) {
            $news_img = $newsadminModel->news_image;
            $del_file   ="public/upload/".$news_img;
        }
        if(file_exists($del_file)){
            unlink($del_file);
        }
            return back();

    }
    //UPDATE
    public function edit_news($primaryKey){

        $newsadminModel = newsadminModel::find($primaryKey);
        return view('admin.news.updatenews')->with('newsadminModel',$newsadminModel);

    }
    //UPDATE SỬA
    public function update_news($primaryKey,  request $Request){

        $newsadminModel = newsadminModel::find($primaryKey);
        $newsadminModel->news_title = $Request['title'];

        $newsadminModel->news_desc = $Request['desc'];
        $newsadminModel->news_content = $Request['content'];
        if( $newsadminModel->news_content==""){
            $newsadminModel->news_content="Chưa có thông tin";
        }
        $get_image=$Request->file('image');
        if(empty($get_image)){
            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');

            return redirect::to('edit-news/'.$primaryKey);

        }elseif($get_image){

            $get_name_image = $get_image->getClientOriginalName();

            $name_image = current(explode('.',$get_name_image));

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/upload',$new_image);
            $newsadminModel->news_image = $new_image;

            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');

            $updateNews= $newsadminModel;
            $updateNews = $this->edit_news($primaryKey);
            return $updateNews;
        }
    }
}


