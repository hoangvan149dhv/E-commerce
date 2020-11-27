@extends('layout')
@Section('content')
<div class="contact-form">
    <h2 class="title text-center">Lịch sử mua hàng</h2>
    @foreach ($all_info_customer as $value_content)
        <?php
            if(isset($value_content->cusname)){
        ?>
            <tr >
                <td style="border: 1px solid #E6E4DF;" class="cart_description">
                <h5 style="text-align:center;" >Cảm ơn anh/chị <b style="font-size:18px">{{$value_content->cusname }}</b> đã quan tâm tin tưởng sản phẩm chúng tôi</h5>
                </td>
            </tr>
            <hr>
        <?php
        }
        ?>
    @endforeach
</div>
<div class="table-responsive cart_info">
<table class="table table-condensed table-responsive"style="margin-bottom: 0px;">
    <thead>
        <tr class="cart_menu" style="  border: 1px solid #E6E4DF; background:#FE980F;color:white; text-align: center;">
            <td class="image"><h4>Hình ảnh</h4></td>
            <td class="product"><h4>Sản phẩm</h4></td>
            <td class="price"><h4>Gía</h4></td>
            <td class="quantity"><h4>Số lượng</h4></td>
            <td class="total"><h4>Trạng thái</h4></td>
        </tr >
    </thead>
    <tbody>
         @foreach ($all_info_customer_order as $value)
        <?php
            if(isset($value->cusname)){
        ?>
         <tr style="border: 1px solid #E6E4DF;">
            <td  class="cart_product" style="border: 1px solid #E6E4DF">
                <img src="public/upload/{{$value->image}}" width="70" height="90" alt="">
            </td >
            <td style="border: 1px solid #E6E4DF;" class="cart_description">
                <h5  style="text-align: center;"><p>{{$value->productname }}</p></h5>
            </td>
            <td style="border: 1px solid #E6E4DF;" class="cart_price">
                <p style="text-align: center;">{{number_format($value->price)}}.VNĐ</p>
            </td>
            <td style="border: 1px solid #E6E4DF;" class="cart_quantity">
                <div class="cart_quantity_button" style="text-align: center;">
                    <p width="50px">{{$value->qty}}</p>
                </div>
            </td>
            <td>
                <div style="text-align:center">
                    <?php
                        if($value->status==0){
                            echo "<p style='color:red;'>Đang Xử Lý</p>";
                        }else{
                            echo "<p style='color:green;'>Đã Xong</p>";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <?php }else{ ?>
                <div class='note' style='color:red;font-size:20px'>Không có thông tin!!! </div>
        <?php } ?>
        @endforeach
    </tbody>
</table>
</div>
@endsection
