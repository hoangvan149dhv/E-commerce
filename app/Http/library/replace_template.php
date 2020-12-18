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
            return Redirect::to('/');
        }
        $orderModel = new OrderModel();
        $getOrderIds = $orderModel->getOrderId($id);
        $infoOdercustomer = CustomerorderModel::where('orderid', $getOrderIds['orderid'])->get();
        $orderItems = $infoOdercustomer[0]->toArray();
        $productItems = explode(',', $orderItems['product_id']);
        $qtyProductItems = explode(',', $orderItems['qty']);

        if (empty($getOrderIds)) {
            Session::put('error', 'Đơn Hàng Không Tồn Tại');
            return Redirect::to('/');
        }

        //data replace
        $order_id = $getOrderIds['orderid'];
        $cusid = $getOrderIds['cusid'];
        $cusname = $getOrderIds->customer->cusname;
        $product_id = $getOrderIds['product_id'];
        $productname = $getOrderIds['productname'];
        $fee_ship = $getOrderIds['fee_ship'];
        $qty = $getOrderIds['qty'];
        $price = $getOrderIds['price'];
        $total = $getOrderIds['total'];
        $cusphone = $getOrderIds->customer->cusPhone;
        $status = $getOrderIds['status'] == 0 ? "Đang xử Lý" : "Đã giao xong";
        $note = $getOrderIds->customer->cusNote;
        $order_date = $getOrderIds['order_date'];
        $email = $getOrderIds->customer->cusEmail;
        $cus_address = $getOrderIds->customer->cusadd;
        $loop_product = '';
        $product_loop_tag = '';
        for ($i = 0; $i < count($productItems); $i++) {
            $productItem = product_detail::getProductDetail($productItems[$i]);
            // echo $productItem[0]->product_Name;
            $product_loop_tag = '
                        <tr>
                            <td style="text-align:center">{product_name}</td>
                            <td style="text-align:center">{product_price}</td>
                            <td style="text-align:center">{product_quantity}</td>
                        </tr>
                        ';
            $loop_product .= str_replace(array('{product_name}', '{product_price}', '{product_quantity}'),
                array($productItem[0]->product_Name, $productItem[0]->product_price, $qtyProductItems[$i]),
                $product_loop_tag);

        }

        $search = array(
            '{order_id}', '{cus_id}', '{cus_name}', '{product_id}', '{product_name}',
            '{fee_shipping}', '{cus_email}', '{product_quantity}', '{product_price}', '{order_total}', '{cusphone}',
            '{cus_address}', '{order_status}',
            '{cus_note}', '{order_date}', '{loop_product}'
        );

        $item_replace = array(
            $order_id, $cusid, $cusname, $product_id,
            $productname, number_format($fee_ship).' VNĐ', $email, $qty, number_format($price).' VNĐ',
            number_format($total).' VNĐ',
            $cusphone, $cus_address, $status, $note,
            Carbon::createFromFormat('Y-m-d H:i:s', $order_date)->format('d/m/yy | H:i:s'),
            $loop_product
        );

        //content
        return str_replace($search, $item_replace, $template);
    }
}






