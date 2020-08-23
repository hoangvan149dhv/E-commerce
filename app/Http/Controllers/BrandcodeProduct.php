<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; //SỬ DỤNG DBS
use Session; // THƯ VIỆN SỬ DỤNG SESSION
use App\Http\Requests; // 
use Illuminate\Support\Facades\Redirect;
use App\contactinfoModel;
class BrandcodeProduct extends Controller
{
        //KIỂM TRA ĐĂNG NHẬP
    public function AuthLogin(){
        $admin_id = Session::get('admin_Id');
        if($admin_id){
             return Redirect::to('admin.dashboard');
        }else
        {
            return Redirect::to('admin-login')->send();
                           //Send là == chuyển ĐẾN TRANG -->RẤT QUAN TRỌNG
        }
    }

    // LAYOUT ADD
    public function add_Brand_code_Product(){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 
        return view('admin.addBrandcodeProduct');
    }
    //ALL HIỂN THỊ 
    public function all_Brand_code_Product(){
          //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        
        $allBrandcode_product = DB::table('tbl_brand_code_product')->get(); //get== select trong dbs
        
        $manager_brandcode_product = view('admin.allBrandcodeProduct')->with('allBrandcode_Productt',$allBrandcode_product);
                                        //'admin.allcategoryProduct là trang đó truyền vào biến $all_category_Product
        return view('admin_layout')->with('admin.allBrandcodeProduct',$manager_brandcode_product);
    }
    // THÊM brand
    public function save_brandcode_product(request $Request){
    
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin();
        $data['brandcode_name'] = $Request->name;

        $data['brandcode_id'] = $Request->code;
        
        DB::table('tbl_brand_code_product')->insert($data);
        
        Session::put('messages','Thêm Mã Thương Hiệu Thành Công'); 
        
        return redirect::to('add-Brand-code-Product');

    }
    //DELETE BRAND-CODE
    public function delete_brand_code_product($brand_code_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->delete();
        
        return redirect::to('/all-Brand-code-Product');
    }
    //UPDATE (HIỂN THỊ )
    public function edit_brand_code_product($brand_code_id, request $Request)
    {
          //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

        $allBrandcode_product = DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->get();
                                                                                                    //get == select(sql)
        $manager_brandcode_product=view('admin.updateBrandcodeProduct')->with('all_Brandcode_product',$allBrandcode_product);
        
        return view('admin_layout')->with('admin.updateBrandcodeProduct',$manager_brandcode_product);
    }

    public function update_brand_code_Product(Request $Request,$brand_code_id){
        //KIỂM TRA ĐĂNG NHẬP
        $this->AuthLogin(); 

        $data = array(); //Chuỗi
        $data['brandcode_name'] = $Request->name;  // category_name LÀ TÊN CỦA CỘT TRONG DATABASE
                                    //CÒN name là cái tên của dòng 15 addcategỏyProduct.blade.php
        $data['brandcode_id'] = $Request->code;  // category_desc LÀ TÊN CỦA CỘT TRONG DATABASE 
                                    //CÒN mota là cái "name" tên của dòng 29 updatecategỏyProduct.blade.php
        //THỰC HIỆN query
        DB::table('tbl_brand_code_product')->where('code_id',$brand_code_id)->update($data);//CHỌN table ->insert dữ liệu data
                                                //category_id  trong csdl  
        Session::put('alert-success','Sửa Mã Thương Hiệu Thành Công');                          
        
        return back();
    }
//END FUNCTION ADMIN PAGE
////////////////////////////////////////////////////////////////////////////////////////////////////////
//LÀM VIỆC VỚI FRONT-END
    public function __construct(){
        $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        //category_id trong sql, 
        $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
        
        $contactinfoModel = contactinfoModel::select()->get();
        // $month=  Carbon::now()->month;
        view()->share('contactinfoModel',$contactinfoModel);
        view()->share('category_product',$category_product);
        view()->share('brand_code_product',$brandcode_product);
    }
    //SHOW SẢN PHẨM CỦA THUONG HIEU
    public function show_brand_home($brand_id, request $request){
        //brand_name
        $brand_name = DB::table('tbl_brand_code_product')->where('code_id',$brand_id)->limit('1')->get();
        //category_by_id
        //brand_by_id
        $brand_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_code_product','tbl_brand_code_product.code_id','=','tbl_product.brandcode_id')
        ->where('tbl_brand_code_product.code_id',$brand_id)->paginate(12);
                                                        //paginate( phân trang)
        //lấy ra meta                                                       
        foreach($brand_name as $value){
        $meta_desc= "Chuyên bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
        
        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
        
        $meta_title = $value->brandcode_name; //Tile là tên trang đó
        
        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
        }
        return view('user.brand.show_brandcode')
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name)
         //SEO
        ->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
}