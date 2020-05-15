<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session; // THƯ VIỆN SỬ DỤNG SESSION
// use App\Http\Requests; // 
// use Illuminate\Support\Facades\Redirect;
// session_start();
use App\contactModel;
use Illuminate\Support\Facades\Redirect;
// use App\Rules\Captcha; 
use Validator;  //neu cac ban co su dung validate
class contactController extends Controller
{
    public function __construct(request $request)
    {
        
       //lấy ra DANH MỤC VÀ THƯƠNG HIỆU
         $category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
                //category_id trong sql, 
        
         $brandcode_product =DB::table('tbl_brand_code_product')->orderby('code_id','desc')->get();
        //SEO        
         $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
         $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục";     //Từ khóa trên google khi người dùng tìm kiếm
         $meta_title = "Vải áo dài xinh- Khuyến Mãi"; //Tile là tên trang đó
         $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
        //SEO
        view()->share('category_product',$category_product);
        view()->share('brand_code_product',$brandcode_product);
        view()->share('meta_desc',$meta_desc);
        view()->share('meta_keyword',$meta_keyword);
        view()->share('meta_title',$meta_title);
        view()->share('url_canonical',$url_canonical);
    }
    public function Contact(Request $request){
        //SEO
        $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
        $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục, liên hệ";     //Từ khóa trên google khi người dùng tìm kiếm
        $meta_title = "Liên hệ - Vải áo dài xinh"; //Tile là tên trang đó
        $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
        //SEO
                return view('user.contact.contact')->with('meta_desc',$meta_desc)
        ->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
    public function insertContact(request $request)
    {
         //SEO
         $meta_desc= "Chuyênn bán vải áo dài,may tại xưởng, giá rẻ, in sỉ, lẻ , chất lượng"; //META DESCRIPTION
         $meta_keyword = "Áo dài in 3D, áo dài đẹp, áo dài in sỉ lẻ, đồng phục, liên hệ";     //Từ khóa trên google khi người dùng tìm kiếm
         $meta_title = "Liên hệ - Vải áo dài xinh"; //Tile là tên trang đó
         $url_canonical = $request->url(); // url_canonical cái này lấy được cái đường dẫn hiện tại của cái trang  chủ
         //SEO

        $contactModel = new contactModel();
        $contactModel->Con_Name = $request['name'];
        $contactModel->Con_Email= $request['email'];
        $contactModel->Con_Content= $request['content'];
        $contactModel->status= 0;
        $contactModel->save();
        Session::put('success','Cảm ơn bạn đã góp ý');
        return redirect('/lien-he')->with('meta_keyword',$meta_keyword)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// LÀM VIỆC VỚI ADMIN
//////ADMIN
    public function contactadmin(){
        $contact= contactModel::select()->orderby('Con_Id','desc')->paginate(10);
        return view('admin.contact.contact')->with(compact('contact'));
    }
        //CHUYỂN TRẠNG THÁI  CHƯA đọc THÀNH Đã đọc
        public function update_status_0($Con_Id){
            $data['status'] = 1;
            contactModel ::where('Con_Id',$Con_Id)->update($data);
            return redirect('/contact');
        }
        //CHUYỂN TRẠNG THÁI  Đã đọcc THÀNH CHƯA đọc
    public function update_status_1($Con_Id){
        $data['status'] = 0;
        contactModel ::where('Con_Id',$Con_Id)->update($data);
        return redirect('/contact');
    }
        //XÓA Liên hệ
        public function delete_status_1($Con_Id){
        contactModel ::where('Con_Id',$Con_Id)->delete();
        return redirect('/contact');
        }
}
