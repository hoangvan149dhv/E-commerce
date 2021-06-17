<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryProduct extends AdminController
{
    public function show_Categories(){

        $all_category_product = DB::table('tbl_category_product')->get();

        $manager_category_product = view('admin.categories.allcategoryProduct')->with(
            'allcategory_Productt',
            $all_category_product
        );

        return view('admin.index')->with('admin.categories.allcategoryProduct', $manager_category_product);
    }

    //ADD Save
    public function save_Category_Product(Request $Request){
        $data['category_name'] = $Request->name;
        $data['category_desc'] = $Request->mota;
        $data['category_status'] = $Request->status;
        $data['category_meta_slug'] = \Mix::utf8tourl($data['category_name']) . "-" . rand(1,999);
        DB::table('tbl_category_product')->insert($data);

        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');

        return back();
    }

    public function update_status_category($category_product_id, $status)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => $status]);

        return redirect::to('admin/allCategoryProduct');
    }

    //EDIT
    public function edit_Category_Product($category_product_id){

        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();

        $manager_category_product = view('admin.categories.updatecategoryproduct')->with(
            'editcategory_Product',
            $edit_category_product
        );

        return view('admin.index')->with('admin.categories.updatecategoryproduct', $manager_category_product);
    }

    public function update_Category_Product(Request $Request, $category_product_id){

        $data = array();
        $data['category_name'] = $Request->name;
        $data['category_desc'] = $Request->mota;
        $data['category_meta_slug'] = \Mix::utf8tourl($data['category_name']) . "-" . rand(1,999);

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(
            $data
        );

        Session::put('message', 'Sửa Danh Mục Sản Phẩm Thành Công');

        return back();
    }

    public function destroy_Category_Product(request $request){

        $destroy_cate = $request->category;

        DB::table('tbl_category_product')->whereIn('category_id', $destroy_cate)->delete();

        return back();
    }
}
