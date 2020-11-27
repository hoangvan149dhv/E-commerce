<?php
namespace App\Http\library;
use App\Http\Model\templateMailModel;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Model\OrderModel;
use App\Http\Model\CustomerorderModel;
class replace_template extends BaseController
{
    public function replace_orderID($id, $template)
    {
        if (empty($id)) {
            Session::put('error', 'Đơn Hàng Không Tồn Tại');
            return Redirect::to('/trang-chu');
        }
        $orderModel = new OrderModel();
        $getOrderIds = $orderModel->getOrderId($id);

        //data replace
        $order_id     = $getOrderIds['orderid'];
        $cusid        = $getOrderIds['cusid'];
        $cusname      = $getOrderIds['cusname'];
        $product_id   = $getOrderIds['product_id'];
        $productname  = $getOrderIds['productname'];
        $fee_ship     = $getOrderIds['fee_ship'];
        $qty      = $getOrderIds['qty'];
        $price        = $getOrderIds['price'];
        $total        = $getOrderIds['total'];
        $cusphone     = $getOrderIds['cusphone'];
        $status       = $getOrderIds['status'];
        $note         = $getOrderIds['note'];
        $order_date   = $getOrderIds['order_date'];
        $email        = $getOrderIds->customer->cusadd;

        $item_replace = array($order_id,$cusid,$cusname,$product_id,
            $productname,number_format($fee_ship). ' VNĐ',$email,$qty,number_format($price).' VNĐ',number_format($total).' VNĐ',
            $cusphone,$status,$note,Carbon::createFromFormat('Y-m-d H:i:s', $order_date)->format('d/m/yy | H:i:s'));

        $search       = array('{order_id}','{cus_id}','{cus_name}','{product_id}','{product_name}',
            '{fee_shipping}','{address}','{product_quantity}','{product_price}','{order_total}','{cusphone}','{order_status}',
            '{cus_note}','{order_date}');
        //content
        echo str_replace($search , $item_replace, $template );
        }
}






