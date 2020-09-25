<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\sliderModel;
use DB;
class sliderController extends AdminController
{
    public function __construct(){
        $this->AuthLogin();
    }

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

        $slider = sliderModel::where('id',$id)->get();
        foreach ($slider as $key) {
            $slider_img = $slider->img;
            $del_file   ="public/upload/".$slider_img;
            if(file_exists($del_file)){
                unlink($del_file);
            }
        }
        sliderModel::where('id',$id)->delete();
        return  Redirect::to('all-slider')->with('success','xóa thành công');

    }
    function destroy(request $request){

        $slider_id = $request->slider;

        $slider = sliderModel::whereIn('id',$slider_id)->get();
        $array_slider = (json_decode(json_encode($slider), true));
        foreach ($array_slider as  $value) {
            $slider_img = $value['img'];
            $del_file   ="public/upload/".$slider_img;

            if(file_exists($del_file)){
                unlink($del_file);
            }
        }
        sliderModel::whereIn('id',$slider_id)->delete();
        return Redirect::to('all-slider')->with('success','xóa thành công');
    }
}