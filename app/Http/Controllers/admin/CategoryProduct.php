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
    protected $table = 'tbl_category_product';

    protected $colum = 'category_id';

    /**
     * Display a listing of the resource.
     *
     */
    public function index() {
        $all_category_product = $this->table->get();

        $category_product = view('admin.categories.allcategoryProduct')->with(
            'allcategory_Productt',
            $all_category_product
        );

        return $category_product;
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $Request) {
        $data['category_name']      = $Request->name;
        $data['category_desc']      = $Request->mota;
        $data['category_status']    = $Request->status;
        $data['category_meta_slug'] = \Mix::utf8tourl($data['category_name'])."-".rand(1, 999);

        $this->table->insert($data);

        Session::put('message', 'Thêm Danh Mục Sản Phẩm Thành Công');

        return back();
    }

    public function update_status($category_id, $status)
    {
        $this->table->where('category_id', $category_id)->update(['category_status' => $status]);
        return back();
    }

    public function edit($category_id)
    {
        return view('admin.categories.updatecategoryproduct')->with(
            'editcategory_Product',
            $this->getInstance($category_id, $this->table)->getTable()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $Request, $id) {

        $data = array();
        $data['category_name'] = $Request->name;
        $data['category_desc'] = $Request->mota;
        $data['category_meta_slug'] = \Mix::utf8tourl($data['category_name']) . "-" . rand(1,999);

        $this->table->where('category_id', $id)->update(
            $data
        );

        Session::put('message', 'Sửa Danh Mục Sản Phẩm Thành Công');

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(request $request){

        $id = $request->category;

        $this->table->whereIn('category_id', $id)->delete();

        return back();
    }
}
