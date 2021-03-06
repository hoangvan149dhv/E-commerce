@extends('frontend.index')
@Section('content')
<section class="ftco-section">
    <div class="container">
    <div class="contact-form">
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
        <div class="row">
            <table class="table cart">
                <thead class="thead-primary">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Gía</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order_item_value as $value)
                    @php
                        $productItem = \App\Http\library\product_detail::getProductDetail($value);
                        $productItem->qty = $value;
                    @endphp
                    <tr style="border: 1px solid #E6E4DF;">
                        <td class="" style="border: 1px solid #E6E4DF;text-align: center">
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
        </div>
            @else
            <div class='note' style='color:red;font-size:20px'>Không có thông tin!!!</div>
        @endif
    </div>
    </div>
</section>
<style>
    .table thead th{
        text-align: center;
    }
</style>
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Lịch sử mua hàng <i
                                    class="fa fa-chevron-right"></i></span></p>
                        <h2 class="mb-0 bread">Lịch sử mua hàng</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
