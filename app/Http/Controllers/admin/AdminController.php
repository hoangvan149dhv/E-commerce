<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

class AdminController extends Controller
{
    protected $id;

    /**
     * Cached instances
     *
     * @var  array
     */
    protected static $instances = array();

    /**
     * Table primary key for load item.
     *
     * @var  string
     */
    protected $table = null;

    protected $colum = null;

    /**
     * Constructor
     *
     * @param   mixed $id Identifier of the active item
     */
    public function __construct($id = null)
    {
        if ($id)
        {
            $this->table = DB::table($this->table)->where($this->colum, $id)->get();
        }
        else
        {
            $this->table = false !== DB::table($this->table)->get() ? DB::table($this->table) : '';
        }
    }
    /**
     * Create and return a cached instance
     *
     * @param   integer $id Identifier of the active item
     *
     * @return  $this
     */
    public function getInstance($id = null)
    {
        $class = get_called_class();
        if ($id)
        {
            $this->id = $id;
            return new static($id);
        }
        else
        {
            static::$instances[$class] = new static( $id);
        }

        return static::$instances[$class];
    }

    public function getTable()
    {
        return $this->table ?: '';
    }

    public function index()
    {
        $count = count::find(1);

        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brandcode_product = DB::table('tbl_brand_code_product')->orderby('code_id', 'desc')->get();
        $contactinfoModel = contactinfoModel::select()->get();
        $totalOder = DB::table('tbl_orders')->get();

        $date = Carbon::now();
        $month = Carbon::now()->month;
        $product_order_date = DB::table('tbl_orders')->where('status', 1)->whereDate('order_date', $date)->get();
        $product_order_month = DB::table('tbl_orders')->where('status', 1)->whereMonth('order_date', $month)->get();
        view()->share('dataOderofMonth',$this->getDataOderofMonth());
        view()->share('count', $count);
        view()->share('contactinfoModel', $contactinfoModel);
        view()->share('category_product', $category_product);
        view()->share('brand_code_product', $brandcode_product);
        view()->share('totalOder', $totalOder);
        session::put('message', DB::table('tbl_orders')->where('status', 0)->count());

        return view('admin.home.home')
            ->with('product_order_date', $product_order_date)
            ->with('product_order_month', $product_order_month);
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
