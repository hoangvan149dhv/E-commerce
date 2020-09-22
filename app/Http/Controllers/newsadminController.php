<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; //
use Illuminate\Support\Facades\Redirect;
use App\newsadminModel;
use DB;
use App\contactinfoModel;
class newsadminController extends HomeController
{
     //KIỂM TRA ĐĂNG NHẬP
     public function AuthLogin(){

        $admin_id = Session::get('admin_Id');

        if($admin_id){

            return Redirect::to('admin.dashboard');

        }else{

            return Redirect::to('admin-login')->send();

             }
        }
    //LAY OUT TRANG THÊM BÀI VIẾT
    public function layoutaddNews(){

        $this->AuthLogin();

        return view('admin.news.addnews');

    }
    //THÊM BÀI VIẾT
    public function insertNews(request $Request){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        //MODEL
        $newsadminModel = new newsadminModel();
        $newsadminModel['news_title'] = $Request['title'];

        $newsadminModel->news_desc = $Request['desc']; // MÔ TẢ NGẮN
        // $newsadminModel->news_image = $Request['image'];
        $newsadminModel->news_content = $Request['content'];

        if( $newsadminModel->news_content==""){

            $newsadminModel->news_content="Chưa có thông tin";

        }

        $get_image=$Request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();// getClientOriginalName(); là lấy name và cả đuôi của hình

            $name_image = current(explode('.',$get_name_image));
                            //explode('.',$get_name_image) có nghĩa nó sẽ PHÂN TÁCH thành chuỗi qua Dấu "."
                    //current là lấy PHẦN ĐẦU CỦA CHUỖI phân tách

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                            //rand(0,99) là TẠO SỐ NGẪU NHIÊN để khi đặt tên ảnh k bị trùng
                                        // .'.'.$get_image->getClientOriginalExtension(); CÓ NGHĨA LÀ LẤY CÁI ĐUÔI ĐẰNG SAU DẤU '.'
                                                    //VD hinh1.png là lấy đuôi (.png)

            $get_image->move('public/upload',$new_image); // move == move_upload trong php
            $newsadminModel->news_image = $new_image; // image là name bên addProduct.blade.php dòng 30
            //$newsadminModel->news_image trong tbl_news

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

        $this->AuthLogin();
        $newsadminModel= newsadminModel::select()->orderBy('news_id','desc')->paginate(10);
        // $newsadminModel
        return view('admin.news.allnews')->with(compact('newsadminModel'));

    }
    //HIỂN THỊ CHI TIẾT TỪNG BÀI VIẾT
    public function newsdetails($primaryKey){

        $this->AuthLogin();
        $newsadminModel= newsadminModel::find($primaryKey);
        return view('admin.news.detailsallnews')->with(compact('newsadminModel'));

    }

        //XÓA BÀI VIẾT
    public function delete_news($primaryKey){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
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
    //UPDATE (HIỂN THỊ )
    public function edit_news($primaryKey){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        //
        $newsadminModel = newsadminModel::find($primaryKey);
        return view('admin.news.updatenews')->with('newsadminModel',$newsadminModel);

    }
    //UPDATE SỬA
    public function update_news($primaryKey,  request $Request){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        //
        $newsadminModel = newsadminModel::find($primaryKey);
        $newsadminModel->news_title = $Request['title'];

        $newsadminModel->news_desc = $Request['desc']; // MÔ TẢ NGẮN
        // $newsadminModel->news_image = $Request['image'];
        $newsadminModel->news_content = $Request['content'];
        if( $newsadminModel->news_content==""){
            $newsadminModel->news_content="Chưa có thông tin";
        }
            //GET IMAGE //BÀI 23
        $get_image=$Request->file('image');
        if(empty($get_image)){
            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');

            ///////// CÁCH 1
            // $updateNews= $newsadminModel;
            // $updateNews = $this->edit_news($primaryKey);
            // return $updateNews;


            ///////////CÁCH 2
            return redirect::to('edit-news/'.$primaryKey);

        }elseif($get_image){

            $get_name_image = $get_image->getClientOriginalName();// getClientOriginalName(); là lấy name và cả đuôi của hình

            $name_image = current(explode('.',$get_name_image));
                                //explode('.',$get_name_image) có nghĩa nó sẽ PHÂN TÁCH thành chuỗi qua Dấu "."
                        //current là lấy PHẦN ĐẦU CỦA CHUỖI phân tách

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                                //rand(0,99) là TẠO SỐ NGẪU NHIÊN để khi đặt tên ảnh k bị trùng
                                            // .'.'.$get_image->getClientOriginalExtension(); CÓ NGHĨA LÀ LẤY CÁI ĐUÔI ĐẰNG SAU DẤU '.'
                                                        //VD hinh1.png là lấy đuôi (.png)

            $get_image->move('public/upload',$new_image); // move == move_upload trong php
            $newsadminModel->news_image = $new_image; // image là name bên addProduct.blade.php dòng 30
            //$newsadminModel->news_image trong tbl_news
            //
            $newsadminModel->save();
            Session::put('updatesuccess','Sửa bản tin Thành Công');

            ///CÁCH 1
            $updateNews= $newsadminModel;
            $updateNews = $this->edit_news($primaryKey);
            return $updateNews;
                ///CÁCH 2
                // return redirect::to('edit-news'.$primaryKey);
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///LÀM VIỆC VỚI CLIENT USER

        //Hiển thị trang tin tức
    public function news_client(request $request){

        $newsadminModel = newsadminModel::select()->orderby('news_id','desc')->paginate(5);

        return view('user.news.news')
        ->with('newsadminModel',$newsadminModel);

    }
         //CHI TIẾT trang tin tức
        public function newsdetails_client($primaryKey,request $request){
        $newsadminModel = newsadminModel::find($primaryKey);
        $news_details = newsadminModel::select()->whereNotIn('news_id',[$primaryKey])->orderby('news_id','desc')->take(5)->get();
        //
        $meta_desc= $newsadminModel->news_desc; //META DESCRIPTION
        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
        $meta_title =  $newsadminModel->news_title; //Tile là tên trang đó
        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ

        return view('user.news.newsdetails')
            ->with('meta_desc',$meta_desc)
            ->with('meta_keyword',$meta_keyword)
            ->with('meta_title',$meta_title)
            ->with('url_canonical',$url_canonical)
            ->with('newsadminModel',$newsadminModel)
            ->with('news_details',$news_details);
    }
}


