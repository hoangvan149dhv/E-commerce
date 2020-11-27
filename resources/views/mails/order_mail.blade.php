<?php use Carbon\Carbon?>
{{--DATA ORDERID--}}
    @foreach($item_detail_order as $value => $key)
    @endforeach

    {{--Dis play template--}}
    @foreach ($template as $item)
    @endforeach
    <?php

    //data replace
    $order_id     = $key->orderid;
    $cusid        = $key->cusid;
    $cusname      = $key->cusname;
    $product_id   = $key->product_id;
    $productname  = $key->productname;
    $fee_ship     = $key->fee_ship;
    $qty      = $key->qty;
    $price        = $key->price;
    $total        = $key->total;
    $cusphone     = $key->cusphone;
    $status       = $key->status;
    $note         = $key->note;
    $order_date   = $key->order_date;
    $email        = $key->customer->cusadd;

    $item_replace = array($order_id,$cusid,$cusname,$product_id,
        $productname,number_format($fee_ship). ' VNĐ',$email,$qty,number_format($price).' VNĐ',number_format($total).' VNĐ',
        $cusphone,$status,$note,Carbon::createFromFormat('Y-m-d H:i:s', $order_date)->format('d/m/yy | H:i:s'));

    $search       = array('{order_id}','{cus_id}','{cus_name}','{product_id}','{product_name}',
        '{fee_shipping}','{address}','{product_quantity}','{product_price}','{order_total}','{cusphone}','{order_status}',
        '{cus_note}','{order_date}');
    //content
    $body = $item->template;

    echo str_replace($search , $item_replace, $body );

    ?>





