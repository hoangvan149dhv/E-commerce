<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
class BrandcodeProduct extends AdminController
{
    //Show brand
    public function show_Brand() {

        $allBrandcode_product = DB::table('tbl_brand_code_product')->get();

        $manager_brandcode_product = view('admin.brands.allBrandProduct')->with('allBrandcode_Productt',$allBrandcode_product);

        return view('admin.index')->with('admin.brands.allBrandProduct',$manager_brandcode_product);
    }

    // Create brand
    public function save_brandcode_product(request $Request) {
        $data['brandcode_name'] = $Request->name;

        $data['brandcode_id'] = $Request->code;
        $data['brand_meta_slug'] = \Mix::utf8tourl($data['brandcode_name']) . "-" . rand(1,999);;
        DB::table('tbl_brand_code_product')->insert($data);

        Session::put('messages','Thêm Mã Thương Hiệu Thành Công');

        return redirect::to('admin/add-Brand-code-Product');

    }

    public function delete_brand_code_product($brand_code_id) {

        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->delete();

        return redirect::to('admin/all-Brand-code-Product');
    }
    //show detail brands
    public function edit_brand_code_product($brand_code_id) {

        $allBrandcode_product = DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->get();

        $manager_brandcode_product = view('admin.brands.updateBrandProduct')->with('all_Brandcode_product',$allBrandcode_product);

        return view('admin.index')->with('admin.brands.updateBrandProduct',$manager_brandcode_product);
    }

    public function update_brand_code_Product(Request $Request,$brand_code_id) {

        $data = array();
        $data['brandcode_name'] = $Request->name;
        $data['brandcode_id'] = $Request->code;
        $data['brand_meta_slug'] = \Mix::utf8tourl($data['brandcode_name']) . "-" . rand(1,999);;

        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->update($data);

        Session::put('alert-success','Sửa Mã Thương Hiệu Thành Công');

        return back();
    }
}
