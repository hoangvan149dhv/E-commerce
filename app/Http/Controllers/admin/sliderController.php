<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Model\sliderModel;
use DB;
class sliderController extends AdminController
{
    function add_slider(Request $request) {

        $data = array();
        $data['status'] = $request->status;
        $get_image=$request->file('image');

        if($get_image) {

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $image = md5(time()) . $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/upload', $image); // move == move_upload
            $data['img'] = $image;

            if (!sliderModel::insert($data)) {
                return back()->with('error', 'Vui lòng upload hình ảnh');
            }
            else{
                return back()->with('success','Thêm thành công');
            }
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
        $slider_img_old = $slider_update->img;
        \App\Http\library\media::cleanImage($slider_img_old);
        $get_image = $request->file('image');

        if ($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $image = md5(time()).$name_image.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$image);
            $slider_update->img = $image;
            $slider_update->save();
            return redirect::to('admin/update-layout-slider/'.$id)->with('success','sửa ảnh thành công');
        }
        else
        {
            return redirect::to('admin/update-layout-slider/'.$id)->with('error','Sửa thất bại vui lòng thử lại');
        }

    }
    function update_status_slider($id, $status){
        sliderModel::where('id',$id)->update(['status'=> $status]);

        return redirect::to('admin/all-slider');
    }

    function delete($id)
    {
        $slider = sliderModel::where('id',$id)->get();

        foreach ($slider as $key) {
            $slider_img = $key->img;
            \App\Http\library\media::cleanImage($slider_img);
        }

        sliderModel::where('id',$id)->delete();

        return  redirect::to('admin/all-slider')->with('success','xóa thành công');

    }

    function destroy(request $request){

        $slider_id = $request->slider;

        $slider = sliderModel::whereIn('id',$slider_id)->get();
        $array_slider = (json_decode(json_encode($slider), true));
        foreach ($array_slider as  $value)
        {
            $slider_img = $value['img'];
            \App\Http\library\media::cleanImage($slider_img);
        }
        sliderModel::whereIn('id',$slider_id)->delete();

        return redirect::to('admin/all-slider')->with('success','xóa thành công');
    }
}
