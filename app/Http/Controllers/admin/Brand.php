<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
class Brand extends AdminController
{
    protected $table = 'tbl_brand_code_product';

    protected $colum = 'code_id';

    //Show brand
    public function show() {

        $allBrandcode_product = DB::table('tbl_brand_code_product')->get();

        $manager_brandcode_product = view('admin.brands.allBrandProduct')->with('allBrandcode_Productt',$allBrandcode_product);

        return view('admin.index')->with('admin.brands.allBrandProduct',$manager_brandcode_product);
    }

    // Create brand
    public function create(request $Request) {
        $data['brandcode_name'] = $Request->name;

        $data['brandcode_id'] = $Request->code;
        $data['brand_meta_slug'] = \Mix::utf8tourl($data['brandcode_name']) . "-" . rand(1,999);
        DB::table('tbl_brand_code_product')->insert($data);

        Session::put('messages','Thêm Mã Thương Hiệu Thành Công');

        return redirect::to('admin/add-Brand-code-Product');

    }

    public function destroy($id) {

        DB::table('tbl_brand_code_product')->where('code_id',$id)->delete();

        return back();
    }

    public function edit($id) {

        $allBrandcode_product = DB::table('tbl_brand_code_product')->where('code_id',$id)->get();

        $manager_brandcode_product = view('admin.brands.updateBrandProduct')->with('all_Brandcode_product',$allBrandcode_product);

        return view('admin.index')->with('admin.brands.updateBrandProduct',$manager_brandcode_product);
    }

    public function update(Request $Request,$id) {

        $data = array();
        $data['brandcode_name'] = $Request->name;
        $data['brandcode_id'] = $Request->code;
        $data['brand_meta_slug'] = \Mix::utf8tourl($data['brandcode_name']) . "-" . rand(1,999);;

        DB::table('tbl_brand_code_product')->where('code_id',$id)->update($data);

        Session::put('alert-success','Sửa Mã Thương Hiệu Thành Công');

        return back();
    }
}
