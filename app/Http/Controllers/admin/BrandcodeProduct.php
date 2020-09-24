<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class BrandcodeProduct extends AdminController
{
    public function __construct(){
        $this->AuthLogin();
    }
    // LAYOUT ADD
    public function add_Brand_code_Product(){
        return view('admin.brands.addBrandProduct');
    }

    //ALL HIỂN THỊ
    public function all_Brand_code_Product(){

        $allBrandcode_product = DB::table('tbl_brand_code_product')->get();

        $manager_brandcode_product = view('admin.brands.allBrandProduct')->with('allBrandcode_Productt',$allBrandcode_product);

        return view('admin.admin_layout')->with('admin.brands.allBrandProduct',$manager_brandcode_product);
    }

    // THÊM brand
    public function save_brandcode_product(request $Request){

        $data['brandcode_name'] = $Request->name;

        $data['brandcode_id'] = $Request->code;

        DB::table('tbl_brand_code_product')->insert($data);

        Session::put('messages','Thêm Mã Thương Hiệu Thành Công');

        return redirect::to('add-Brand-code-Product');

    }
    //DELETE BRAND-CODE
    public function delete_brand_code_product($brand_code_id){


        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->delete();

        return redirect::to('/all-Brand-code-Product');
    }
    //UPDATE (HIỂN THỊ )
    public function edit_brand_code_product($brand_code_id, request $Request)
    {

        $allBrandcode_product = DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->get();

        $manager_brandcode_product = view('admin.brands.updateBrandProduct')->with('all_Brandcode_product',$allBrandcode_product);

        return view('admin.admin_layout')->with('admin.brands.updateBrandProduct',$manager_brandcode_product);
    }

    public function update_brand_code_Product(Request $Request,$brand_code_id){
        $data = array();
        $data['brandcode_name'] = $Request->name;
        $data['brandcode_id'] = $Request->code;
        //THỰC HIỆN query
        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->update($data);

        Session::put('alert-success','Sửa Mã Thương Hiệu Thành Công');

        return back();
    }
}
