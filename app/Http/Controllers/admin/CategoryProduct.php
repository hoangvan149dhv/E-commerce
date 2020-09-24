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
    public function __construct(){
        $this->AuthLogin();
    }
    // LAYOUT ADD
    public function add_Category_Product()
    {
        return view('admin.categories.addcategoryProduct');
    }

    public function all_Category_Product()
    {
        $all_category_product = DB::table('tbl_category_product')->get();

        $manager_category_product = view('admin.categories.allcategoryProduct')->with(
            'allcategory_Productt',
            $all_category_product
        );
        //'admin.categories.allcategoryProduct là trang đó truyền vào biến $all_category_Product
        return view('admin.admin_layout')->with('admin.categories.allcategoryProduct', $manager_category_product);
    }

    //ADD Save
    public function save_Category_Product(Request $Request)
    {
        $data['category_name'] = $Request->name;
        $data['category_desc'] = $Request->mota;
        $data['category_status'] = $Request->status;
        //THỰC HIỆN query
        DB::table('tbl_category_product')->insert($data);//CHỌN table ->insert dữ liệu data

        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');

        return Redirect::to('addCategoryProduct');
    }

    //active
    public function active_Category_Product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);

        return Redirect::to('allCategoryProduct');
    }

    //unactive
    public function unactive_Category_Product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);

        return Redirect::to('allCategoryProduct');
    }

    //EDIT
    public function edit_Category_Product($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get(
        );
        $manager_category_product = view('admin.categories.updatecategoryproduct')->with(
            'editcategory_Product',
            $edit_category_product
        );
        return view('admin.admin_layout')->with('admin.categories.updatecategoryproduct', $manager_category_product);
    }

    public function update_Category_Product(Request $Request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $Request->name;
        $data['category_desc'] = $Request->mota;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(
            $data
        );

        Session::put('message', 'Sửa Danh Mục Sản Phẩm Thành Công');

        return Redirect::to('/allCategoryProduct');
    }

    public function delete_Category_Product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();

        return back();
    }

////DESTROY CATEGOY
    public function destroy_Category_Product(request $request)
    {
        $destroy_cate = $request->category;

        DB::table('tbl_category_product')->whereIn('category_id', $destroy_cate)->delete();

        return back();
    }
}
