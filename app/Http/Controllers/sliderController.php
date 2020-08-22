<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\sliderModel;
use DB;
use App\contactinfoModel;
class sliderController extends Controller
{
    function slider_layout(){
        return view('admin.slider.addslider');
    }
    function add_slider(Request $request){
        $data = array();
        $data['status'] = $request->status;
        $get_image=$request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $image = md5(time()).$name_image.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$image); // move == move_upload trong php 
            $data['img'] = $image;
            sliderModel::insert($data);
            return back()->with('success','Thêm thành công');
        }else{
            return back()->with('error','Vui lòng upload hình ảnh');
        }
    }
    function slider_all(){
        $slider_all=sliderModel::all();
        return view('admin.slider.allslider')->with(compact('slider_all'));
    }
    function update_layout_slider($id){
        $slider_edit = sliderModel::find($id);
        return view('admin.slider.updateslider')->with(compact('slider_edit'));
    }
    function update_slider($id, request $request){
        $slider_update = sliderModel::find($id);
        $slider_update->status = $request['status'];
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $image = md5(time()).$name_image.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$image); // move == move_upload trong php 
            $slider_update->img = $image;
            $slider_update->save();
            return redirect::to('update-layout-slider/'.$id)->with('success','sửa ảnh thành công');
        }else{
            $slider_update->save();
            return redirect::to('update-layout-slider/'.$id)->with('error','thành công');
        }
    }
    function status_0($id){
        sliderModel::where('id',$id)->update(['status'=>0]);                
        return Redirect::to('all-slider');
    }
    function status_1($id){
        sliderModel::where('id',$id)->update(['status'=>1]);                
        return Redirect::to('all-slider');
    }
    //xóa qc
    function delete($id){
        sliderModel::where('id',$id)->delete();
        return  Redirect::to('all-slider')->with('success','xóa thành công');
    }
    function destroy(request $request){
        $slider_id = $request->slider;
        sliderModel::whereIn('id',$slider_id)->delete();
        return Redirect::to('all-slider')->with('success','xóa thành công');
    }
///////////////////////////////////////////////USER////////////////////////////////////

    function slider_user(){
        // $slider_first= sliderModel::where('status',1)->first();
        // $slide_id= $slider_first->id;
        $slider = sliderModel::where('status',1)->orderby('id','desc')->take(3)->get();
        if(isset($slider)){
            $all_productt = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
            ->orderby('product_id','desc')->paginate(20);
            return view('user.home')->with(compact('all_productt','slider'));
        }
        else{
            return false;
        }
    }
    public function __construct(){
        $contactinfoModel = contactinfoModel::select()->get();
 view()->share('contactinfoModel',$contactinfoModel);
    }
}
