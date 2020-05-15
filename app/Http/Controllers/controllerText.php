<?php
// LẤY VÍ DỤ
namespace App\Http\Controllers;
use App\modeltext;  // SỬ DỤNG Model bên  modeltext
use Illuminate\Http\Request;

class controllerText extends Controller
{
    public function insert(){
        // MẤY HÀM NÀY LÀ LÀM VIỆC VỚI MODEL
        $data = request()->validate([ //gửi yêu cầu của mảng
            'name' => 'requied',  // name=>requied (là yêu cầu của <form>)
            'desc' =>'requied'      // desc=>requied (là yêu cầu của <form>)
            //LƯU Ý : MẤY CÁI name, desc là cái <input name=''/> bên view 
        ]);
        $modeltext = new ModelText(); // ModelText là lấy bên model để truyền sang controller


        $modeltext->idName = $data['name'];  //$data['name'] là form
              // idName là cái bên modeltext là biến $array bên modeltext


        $modeltext->idDesc = $data['desc']; //$data['desc'] là form
                // iDesc là cái bên modeltext là biến $array bên modeltext
        $modeltext->save(); //save() == insert MẤY HÀM GIỐNG NHAU VÀ LÀM VIỆC VỚI MODEL
        return view('text')->with(compact('modeltext')); //TÊN BIẾN NÀO THÌ SỬ DỤNG TÊN BIẾN ĐÓ
       // hoặc có thể ghi
        return view('text')->with('modeltext',$modeltext);
    }

    //// LƯU Ý ĐĂNG SAU  return view('text'); dùng with HOẶC compact đều được
                //with phải truyền 2 biến(tênbiến,$biến)
                //compact thì chỉ cần ghi (tênbiến) , // TÊN BIẾN NÀO THÌ SỬ DỤNG TÊN ĐÓ
                    //NẾU CÓ THÊM TRƯỜNG NỮA LÀ THÌ CHỈ CẦN (tênbiến1,tênbiến2)
                //DÙNG CÁCH NÀO CŨNG ĐƯỢC


//hiển thị
    public function edit($id){
        $edit = ModelText::all();
        $id_edit = Modeltext::find($id); //find == where('dbl',$id)
        //$id_edit = Modeltext::find($id);== DB::table('tbl_test)->where('idd',$id)->get();

        return redirect('some/url')->with(compact('id_edit','edit'));// edit là $edit , id_edit là id_edit
        // with(compact('id_edit')) // biến id_edit là mình phải ĐẶT GIỐNG BIẾN $id_edit
    }
    //xóa
    public function delete($id){
        $id_edit = Modeltext::find($id);
        $id_edit->delete();
        return redirect('some/url')->with(compact('id_edit'));
    }

    //PHÂN TRANG
    public function pagination(){
        $paginate = Modeltext::paginate(3); //phân trang
        return redirect('some/url')->with(compact('paginate'));
    
    TRUYỀN BÊN VIEW
     DÙNG {!! paginate->render()  !!} == {!! paginate->links()  !!}
    }
}

///////////////////


