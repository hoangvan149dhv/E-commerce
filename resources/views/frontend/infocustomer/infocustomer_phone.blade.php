@extends('user.index')
@Section('content')
    <div class="contact-form">
        <h2 class="title text-center">Lịch sử mua hàng</h2>
        @foreach ($info_customer as $value_content)
            @if(isset($value_content->cusname))
                <tr>
                    <td style="border: 1px solid #E6E4DF;" class="cart_description">
                        <h5 style="text-align:center;">Cảm ơn anh/chị <b
                                style="font-size:18px">{{$value_content->cusname }}</b> đã quan tâm tin tưởng sản phẩm
                            chúng tôi</h5>
                    </td>
                </tr>
                <hr>
            @endif
        @endforeach
    </div>
    <div class="table-responsive cart_info">
        @if(isset($value_content->cusname))
            <table class="table table-condensed table-responsive" style="margin-bottom: 0px;">
                <thead>
                <tr class="cart_menu"
                    style="  border: 1px solid #E6E4DF; background:#FE980F;color:white; text-align: center;">
                    <td class="image"><h4>Hình ảnh</h4></td>
                    <td class="product"><h4>Sản phẩm</h4></td>
                    <td class="price"><h4>Gía</h4></td>
                    <td class="quantity"><h4>Số lượng</h4></td>
                    <td class="total"><h4>Trạng thái</h4></td>
                </tr>
                </thead>
                <tbody>
                @foreach($order_item_value as $value)
                    @php
                        $productItem = \App\Http\library\product_detail::getProductDetail($value);
                        $productItem->qty = $value;
                    @endphp
                    <tr style="border: 1px solid #E6E4DF;">
                        <td class="cart_product" style="border: 1px solid #E6E4DF">
                            <img src="{{asset('public/upload/'.$productItem[0]->product_image)}}" width="70" height="90"
                                 alt="">
                        </td>
                        <td style="border: 1px solid #E6E4DF;" class="cart_description">
                            <h5 style="text-align: center;"><p>{{$productItem[0]->product_Name }}</p></h5>
                        </td>
                        <td style="border: 1px solid #E6E4DF;" class="cart_price">
                            <p style="text-align: center;">{{number_format($productItem[0]->product_price)}}.VNĐ</p>
                        </td>
                        <td style="border: 1px solid #E6E4DF;" class="cart_quantity">
                            <div class="cart_quantity_button" style="text-align: center;">
                                <p width="50px">{{$productItem->qty}}</p>
                            </div>
                        </td>
                        <td>
                            <div style="text-align:center">
                                @if($productItem[0]->status==0)
                                    <p style='color:red;'>Đang Xử Lý</p>
                                @else
                                    <p style='color:green;'>Đã Xong</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class='note' style='color:red;font-size:20px'>Không có thông tin!!!</div>
        @endif
    </div>
@endsection
