<?php

namespace App\Http\Controllers\admin;

use App\Http\Model\OrderModel;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Http\Model\CustomerorderModel;
use App\Http\Model\contactinfoModel;
use App\Http\Model\count;
use App\Http\Controllers\admin\loginController;

class AdminController extends loginController
{

    public function __construct()
    {
        $count = count::find(1);

        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();
        $contactinfoModel = contactinfoModel::select()->get();
        $totalOder = DB::table('tbl_orders')->get();
        view()->share('dataOderofMonth',$this->getDataOderofMonth());
        view()->share('count', $count);
        view()->share('contactinfoModel', $contactinfoModel);
        view()->share('category_product', $category_product);
        view()->share('brand_code_product', $brandcode_product);
        view()->share('totalOder', $totalOder);
        //check login
//        $this->middleware(function ($request, $next) {
//            $session_id = session::get('session_id');
//
//            if (empty($session_id)) {
//
//                return redirect::to('admin/admin/admin-login')->send();
//            }
//
//            return $next($request);
//        });
    }

    public function index()
    {
        $req = new Request();
        $date = Carbon::now();
        $month = Carbon::now()->month;
        $product_order_date = DB::table('tbl_orders')->where('status', 1)->whereDate('order_date', $date)->get();
        $product_order_month = DB::table('tbl_orders')->where('status', 1)->whereMonth('order_date', $month)->get();

        session::put('message', DB::table('tbl_orders')->where('status', 0)->count());

        return view('admin.home.home')
            ->with('product_order_date', $product_order_date)
            ->with('product_order_month', $product_order_month);
    }

    public function update_status($orderid, $order_status)
    {
        $data['status'] = $order_status;

        DB::table('tbl_orders')->where('orderid', $orderid)->update($data);

        return back();
    }

    public function destroy_order(Request $request)
    {
        $order_id = $request->orderid;
        isset($order_id) ? DB::table('tbl_orders')->whereIn('orderid', $order_id)->delete() : "";

        return back();
    }

//    public function search_order(Request $request)
//    {
//
//        $key_word = $request->search;
//
//        $search = DB::table('tbl_orders')->where('productname', 'like', '%'.$key_word.'%')
//            ->orWhere('status', $key_word)
//            ->orderby('orderid', 'desc')->paginate(30);
//
//        return view('admin.search.search')->with('search', $search);
//    }

    public function order($status)
    {
        $orderModel = new OrderModel();

        $order_item = is_numeric($status) ? $orderModel->where('status', $status)->orderby('orderid',
            'desc')->paginate(15)
            : $orderModel->orderby('orderid', 'desc')->paginate(15);

        session::put('message', DB::table('tbl_orders')->where('status', 0)->count());

        return view('admin.order.order')->with('product_order', $order_item);
    }

    public function searchProduct(Request $request)
    {
        $key_word = $request->search;

        $search = \App\Http\library\product_detail::getallProduct()
            ->orderby('product_id', 'desc')->where('product_Name', 'like', '%'.$key_word.'%')
            ->orWhere('tbl_category_product.category_name', 'like', '%'.$key_word.'%')
            ->paginate(30);

        return view('admin.search.searchproduct')->with('search', $search);
    }

    //Order Detail
    public function infocustomerorder($orderid)
    {

        $infocustomer = CustomerorderModel::where('orderid', $orderid)->get();
        $orderItems = $infocustomer[0]->toArray();

        $getProductItems = explode(',', $orderItems['product_id']);
        $order_item_qty_value = explode(',', $orderItems['qty']);

        return view('admin.infoOrder.infoOrder')
            ->with('getProductItems', $getProductItems)
            ->with('infocustomerorder', $infocustomer)
            ->with('order_item_qty_value', $order_item_qty_value);
    }

    public function getDataOderofMonth()
    {
        $data             = (Object)
        $total = 0;
        $dataStringformJson = '';
        for ($i = 1; $i <= 12; $i++) {
            $dataOders = OrderModel::whereMonth('order_date', '=', $i)->where('status', '=' ,1)->get();
            foreach ($dataOders as $dataOder) {
                $total += (int) $dataOder->total;

            }
            $data->Month = 'Tháng ' . $i;
            $data->Total = $total;
            unset($data->scalar);
            $dataStringformJson .= ',' . json_encode($data);
        }
        return '['. substr($dataStringformJson,1) . ']' ;
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File                     //storage/app/public/uploads
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/app/public/uploads/'.$filenametostore);
            $msg = 'Upload Ảnh Thành Công';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;

        }
    }
}
