<?php use Carbon\Carbon;
    use \App\Http\library\product_detail as product_detail;
    use \App\Http\Model\CustomerorderModel;
?>
{{--DATA ORDERID--}}
@foreach($item_detail_order as $value => $key)
@endforeach

{{--Dis play template--}}
@foreach ($template as $item)
@endforeach
<?php
$infoOdercustomer = CustomerorderModel::where('orderid',$key->orderid)->get();

$orderItems =  $infoOdercustomer[0]->toArray();
$productItems = explode(',',$orderItems['product_id']);
$qtyProductItems = explode(',',$orderItems['qty']);
//data replace
$order_id     = $key->orderid;
$cusid        = $key->cusid;
$cusname      = $key->customer->cusname;
$product_id   = $key->product_id;
$productname  = $key->productname;
$fee_ship     = $key->fee_ship;
$qty          = $key->qty;
$price        = $key->product_price;
$total        = $key->total;
$cusphone     = $key->customer->cusPhone;
$status       = $key->status == 0 ? "Đang xử Lý" : "Đã giao xong";
$note         = $key->customer->cusNote;
$order_date   = $key->order_date;
$cus_address      = $key->customer->cusadd;
$cus_email        = $key->customer->cusEmail;
//content
$loop_product = '';
$product_loop_tag = '';
$body = $item->template;
for ( $i = 0; $i < count($productItems); $i++)
{
    $productItem = product_detail::getProductDetail($productItems[$i]);
    // echo $productItem[0]->product_Name;
    $product_loop_tag = '
                        <tr>
                            <td style="text-align:center">{product_name}</td>
                            <td style="text-align:center">{product_price}</td>
                            <td style="text-align:center">{product_quantity}</td>
                        </tr>
                        ';
    $loop_product .=  str_replace(array('{product_name}','{product_price}','{product_quantity}'),
    array($productItem[0]->product_Name,$productItem[0]->product_price, $qtyProductItems[$i]), $product_loop_tag);

}
$search       = array('{order_id}','{cus_id}','{cus_name}','{product_id}','{product_name}',
    '{fee_shipping}','{cus_address}','{cus_email}','{product_quantity}','{product_price}','{order_total}','{cusphone}','{order_status}',
    '{cus_note}','{order_date}','{loop_product}');

$item_replace = array($order_id,$cusid,$cusname,$product_id,
    $productname,number_format($fee_ship). ' VNĐ',$cus_address,$cus_email,$qty,number_format($price).' VNĐ',number_format($total).' VNĐ',
    $cusphone,$status,$note,Carbon::createFromFormat('Y-m-d H:i:s', $order_date)->format('d/m/yy | H:i:s'), $loop_product);

echo str_replace($search , $item_replace, $body );
?>





