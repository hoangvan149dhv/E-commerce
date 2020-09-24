<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; //
use Illuminate\Support\Facades\Redirect;
use App\contactinfoModel;
// session_start();
class CategoryProduct extends Controller
{
    //KIỂM TRA ĐĂNG NHẬP
    public function AuthLogin(){

        $admin_id = Session::get('admin_Id');

        if($admin_id){

            return Redirect::to('admin.dashboard');

        }else{

            return Redirect::to('admin-login')->send();
                           //Send là == chuyển ĐẾN TRANG -->RẤT QUAN TRỌNG
        }

    }

    // LAYOUT ADD
    public function add_Category_Product(){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        return view('admin.categories.addcategoryProduct');

    }
    //ALL
    public function all_Category_Product(){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        $all_category_product = DB::table('tbl_category_product')->get(); //get== select trong dbs

        $manager_category_product = view('admin.categories.allcategoryProduct')->with('allcategory_Productt',$all_category_product);
                                        //'admin.categories.allcategoryProduct là trang đó truyền vào biến $all_category_Product
        return view('admin.admin_layout')->with('admin.categories.allcategoryProduct',$manager_category_product);

    }

    //ADD Save
    public function save_Category_Product(Request $Request){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        // $data = array(); //Chuỗi
        $data['category_name'] = $Request->name;  // category_name LÀ TÊN CỦA CỘT TRONG DATABASE
                                    //CÒN name là cái tên của dòng 15 addcategỏyProduct.blade.php
        $data['category_desc'] = $Request->mota;  // category_desc LÀ TÊN CỦA CỘT TRONG DATABASE
                                    //CÒN mota là cái tên của dòng 15 addcategỏyProduct.blade.php
        $data['category_status'] = $Request->status;
        //THỰC HIỆN query
        DB::table('tbl_category_product')->insert($data);//CHỌN table ->insert dữ liệu data

        Session::put('message','Thêm Danh Mục Sản Phẩm Thành Công');

        return Redirect::to('addCategoryProduct');

    }

    //active
    public function active_Category_Product($category_product_id){ //$category_product_id tự gán
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);

        return Redirect::to('allCategoryProduct');

    }
    //unactive
    public function unactive_Category_Product($category_product_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);

        return Redirect::to('allCategoryProduct');

    }

    //EDIT
    public function edit_Category_Product($category_product_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get(); //get== select trong dbs
                                                                            //category_id  trong csdl
        $manager_category_product = view('admin.categories.updatecategoryproduct')->with('editcategory_Product',$edit_category_product);                                                                                                //$update_category_product là biến truyền vào updatecategory_Product
                                        //'admin.updatecategoryProduct là trang đó truyền vào biến $all_category_Product
        return view('admin.admin_layout')->with('admin.categories.updatecategoryproduct',$manager_category_product);

    }
    //UPDATE
    public function update_Category_Product(Request $Request,$category_product_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        $data = array(); //Chuỗi
        $data['category_name'] = $Request->name;  // category_name LÀ TÊN CỦA CỘT TRONG DATABASE
                                    //CÒN name là cái tên của dòng 15 addcategỏyProduct.blade.php
        $data['category_desc'] = $Request->mota;  // category_desc LÀ TÊN CỦA CỘT TRONG DATABASE
                                    //CÒN mota là cái "name" tên của dòng 29 updatecategỏyProduct.blade.php
        //THỰC HIỆN query
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);//CHỌN table ->insert dữ liệu data
                                                //category_id  trong csdl
        Session::put('message','Sửa Danh Mục Sản Phẩm Thành Công');

        return Redirect::to('/allCategoryProduct');
    }
    public function delete_Category_Product($category_product_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();

        return back();
    }
////DESTROY CATEGOY
    public function destroy_Category_Product(request $request){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();

        $destroy_cate = $request->category;

        DB::table('tbl_category_product')->whereIn('category_id',$destroy_cate)->delete();

        return back();

    }
    //END FUNCTION ADMIN PAGE


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LÀM VIỆC VỚI FRONT-END
    public function __construct(){
    //lấy ra DANH MỤC VÀ THƯƠNG HIỆU
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
                //category_id trong sql,

        $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();

        $contactinfoModel = contactinfoModel::select()->get();

        view()->share('contactinfoModel',$contactinfoModel);

        view()->share('category_product',$category_product);

        view()->share('brand_code_product',$brandcode_product);
    }
    //SHOW SẢN PHẨM CỦA DAN MỤC
    public function show_category_home($category_id, request $request){
        //category_name
        $category_name = DB::table('tbl_category_product')->where('category_id',$category_id)->limit('1')->get();
        //category_by_id
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('tbl_category_product.category_id',$category_id)->paginate(12);
                                                                //paginate( phân trang)
        //lấy ra meta
        foreach($category_name as $value){
        //SEO
        $meta_desc= $value->category_desc; //META DESCRIPTION

        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm

        $meta_title = $value->category_name; //Tile là tên trang đó

        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
        ///SEO
        }
        return view('user.category.show_category')
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name)
        //SEO
        ->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);

    }

}

// $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
// $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
