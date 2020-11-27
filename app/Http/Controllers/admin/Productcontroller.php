<?php

    namespace App\Http\Controllers\admin;

    use Illuminate\Http\Request;
    use DB;
    use Session;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;
    use App\Http\Model\ReviewModel;
    use App\Http\Model\OrderModel;
    use App\Http\Model\productModel;

    class Productcontroller extends AdminController
    {
        ////SEO GOOGLE UTF8 convert UTF
        public function utf8convert($str)
        {

            if (!$str) return false;

            $utf8 = array(

                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

                'd' => 'đ|Đ',

                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

                'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

                'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

            );

            foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);

            return $str;

        }

        public function utf8tourl($text)
        {
            $text = $this->utf8convert(strtolower($text));
            $text = str_replace("ß", "ss", $text);
            $text = str_replace("%", "", $text);
            $text = preg_replace("/[^_a-zA-Z0-9 -] /", "", $text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = str_replace("----", "-", $text);
            $text = str_replace("---", "-", $text);
            $text = str_replace("--", "-", $text);
            return $text;
        }

        // LAYOUT ADD
        public function add_Product()
        {

            $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();

            $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();

            return view('admin.products.addProduct')->with('category_product', $category_product)->with('brand_code_product', $brandcode_product);

        }

        public function all_Product()
        {
            $all_product = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->orderby('product_id', 'desc')->paginate(10);

            $manager_product = view('admin.products.allProduct')->with('all_Product', $all_product);

            return view('admin.admin_layout')->with('admin.products.allProduct', $manager_product);
        }

        //THÊM product
        public function save_product(request $Request)
        {

            $data['category_id'] = $Request->category;
            $data['product_Name'] = $Request->name;
            $data['product_desc'] = empty($Request->mota) ? "Chưa có thông tin" : $Request->mota;
            $data['publish'] = empty($Request->publish) ? 0 : $Request->publish;

            $data['product_material'] = $Request->material;
            $data['product_price_promotion'] = (empty($Request->promotion_price) || ($Request->promotion_price >= $Request->price)) ? 1 : $Request->promotion_price;
            $data['product_price'] = $Request->price;

            $data['brandcode_id'] = $Request->brandcode;
            $data['meta_keyword'] = $Request->meta_keyword;
            $data['meta_desc'] = $Request->meta_desc;
            if (empty($Request->promotion_start_date) || empty($Request->promotion_end_date) || $Request->promotion_price == 1) {
                $data['promotion_start_date'] = null;
                $data['promotion_end_date'] = null;
                if ($Request->promotion_price > 1) {
                    Session::put('alert-danger-product', 'Vui lòng chọn thời gian khuyến mãi');

                    return back();
                }
                $data['product_price_promotion'] = 1;
                $data['product_price'] = $Request->price;
            } else {
                if (date($Request->promotion_start_date) > date($Request->promotion_end_date)) {
                    Session::put('alert-danger-product', 'Vui lòng chọn thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');

                    return back();
                } else {
                    $data['promotion_start_date'] = date($Request->promotion_start_date);
                    $data['promotion_end_date'] = date($Request->promotion_end_date);
                }

            }
            $slugg = $this->utf8convert($data['product_Name']);
            $data['meta_slug'] = $this->utf8tourl($slugg) . rand(0, 22220);

            $get_image = $Request->file('image');

            if ($get_image) {

                $get_name_image = $get_image->getClientOriginalName();

                $name_image = current(explode('.', $get_name_image));

                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

                $get_image->move('public/upload', $new_image);

                $data['product_image'] = $new_image;

                DB::table('tbl_product')->insert($data);

            } else {
                $data['product_image'] = '';
            }
            Session::put('alert-success-product', 'Thêm Sản phẩm Thành Công');
            return redirect::to('add-Product');
        }

        //xóa tất cả sản phẩm
        public function destroy_product(Request $request)
        {

            $product_id = $request->product;

            if (!empty($product_id)) {
                $products = \App\Http\library\product_detail::getProductDetail($product_id);
                //convert object to array
                $array_product = (json_decode(json_encode($products), true));
                foreach ($array_product as $value) {
                    $product_img_old = $value['product_image'];
                    \App\Http\library\media::cleanImage($product_img_old);
                    productModel::where('product_id', $product_id)->delete();
                    ReviewModel::where('product_id', $product_id)->delete();
                    OrderModel::where('product_id', $product_id)->delete();
                }
            }
            return back();
        }

        //UPDATE (HIỂN THỊ )
        public function edit_product($product_id)
        {

            $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();

            $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();
            $all_product = DB::table('tbl_product')->where('product_id', $product_id)
                ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_brand_code_product', 'tbl_brand_code_product.code_id', '=', 'tbl_product.brandcode_id')
                ->orderby('product_id', 'desc')->get();

            $manager_product = view('admin.products.updateProduct')
                ->with('all_product', $all_product)
                ->with('category_product', $category_product)
                ->with('brandcode_product', $brandcode_product);

            return view('admin.admin_layout')->with('admin.products.updateProduct', $manager_product);
        }

        //UPDATE
        public function update_Product(Request $Request, $product_id)
        {

            $data = array();
            $data['category_id'] = $Request->category;
            $data['product_Name'] = $Request->name;
            $data['product_desc'] = empty($Request->mota) ? "Chưa có thông tin" : $Request->mota;
            $data['publish'] = empty($Request->publish) ? 0 : $Request->publish;
            $data['product_material'] = $Request->material;
            $data['product_price'] = $Request->price;
            $data['product_price_promotion'] = (empty($Request->promotion_price) || ($Request->promotion_price <= $Request->price)) ? 1 : $Request->promotion_price;
            $data['brandcode_id'] = $Request->brandcode;
            $data['meta_keyword'] = $Request->meta_keyword;
            $data['meta_desc'] = $Request->meta_desc;

            if (empty($Request->promotion_start_date) || empty($Request->promotion_end_date) || $Request->promotion_price == 1) {
                $data['promotion_start_date'] = null;
                $data['promotion_end_date'] = null;
                if ($Request->promotion_price > 1) {
                    Session::put('alert-danger-product', 'Vui lòng chọn thời gian khuyến mãi');

                    return back();
                }
                $data['product_price_promotion'] = 1;
                $data['product_price'] = $Request->price;
            } else {
                if (date($Request->promotion_start_date) > date($Request->promotion_end_date)) {
                    Session::put('alert-danger-product', 'Vui lòng chọn thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');

                    return back();
                } else {
                    $data['promotion_start_date'] = date($Request->promotion_start_date);
                    $data['promotion_end_date'] = date($Request->promotion_end_date);
                }

            }
            $slugg = $this->utf8convert($data['product_Name']);
            $data['meta_slug'] = $this->utf8tourl($slugg) . rand(0, 1000);
            $get_image = $Request->file('image');

            if (empty($get_image)) {
                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                Session::put('alert-success-product', 'Sửa Sản phẩm Thành Công');
                return back();

            } elseif ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));

                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

                $get_image->move('public/upload', $new_image);
                $data['product_image'] = $new_image;
                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                Session::put('alert-success-product', 'Sửa  Sản phẩm Thành Công');

                return back();
            }
        }

        public function publish($product_id, $pushlish)
        {
            $product = \App\Http\library\product_detail::getProductPromotionEmptynedDate($product_id);

            if (!empty($product[0])) {
                Session::put('alert-danger-product', 'Thất bại, vui lòng vào chi tiết sản phẩm kiểm tra phần giá khuyến mãi');
            }
            else
            {
                $pushlish = $pushlish == 1 ? 0 : 1;
                $data = array();
                $data['publish'] = $pushlish;
                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            }
            return back();
        }
    }
