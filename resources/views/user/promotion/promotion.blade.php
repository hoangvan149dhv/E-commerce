@extends('home_page')
@Section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản Phẩm Khuyến Mãi</h2>
     @foreach ($promotion as $product)
    <div class="col-sm-3 col-xs-6 col-ipad " style="padding:0 5px;">
        <div class="product-image-wrapper col-promotion">
            <div class="single-products">
                <div class="productinfo text-center" id="product">
                    <form action="" style="margin-bottom: 0px;">
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_Name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <input type="hidden" class="url" url="{{url('/add-cart-ajax')}}" />
                        <input type="hidden" class="url_addtocart_success" url="{{url('/hien-thi-gio-hang')}}" />
                        <?php
                        // caculate percent
                            $c = 0;
                            $c = (100*$product->product_price)/$product->product_price_promotion;
                            $sale = 100-$c;
                        ?>
                            <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}" title="Chi tiết">
                            @if ($product->product_price_promotion==1||$product->product_price_promotion==0)

                            @else
                                <span class="stick-promotion">-{{ round($sale) }}%</span>
                                    <p id="stick-promotions">
                                        <script>
                                            var end = new Date('2020-11-15');

                                            var _second = 1000;
                                            var _minute = _second * 60;
                                            var _hour = _minute * 60;
                                            var _day = _hour * 24;
                                            var timer;

                                            function showRemaining() {
                                                var now = new Date();
                                                var distance = end - now;
                                                if (distance < 0) {

                                                    clearInterval(timer);
                                                    document.getElementById('stick-promotions').innerHTML = 'EXPIRED!';

                                                    return;
                                                }
                                                var days = Math.floor(distance / _day);
                                                var hours = Math.floor((distance % _day) / _hour);
                                                var minutes = Math.floor((distance % _hour) / _minute);
                                                var seconds = Math.floor((distance % _minute) / _second);

                                                document.getElementById('stick-promotions').innerHTML = days + 'days ';
                                                document.getElementById('stick-promotions').innerHTML += hours + 'hrs ';
                                                document.getElementById('stick-promotions').innerHTML += minutes + 'mins ';
                                                document.getElementById('stick-promotions').innerHTML += seconds + 'secs';
                                            }

                                            timer = setInterval(showRemaining, 1000);

                                            // $(function ($) {
                                            //     var fiveMinutes = 600 * 5,
                                            //         display = $(".productinfo").find("#stick-promotions");
                                            //     startTimer(fiveMinutes, display);
                                            // });
                                        </script>
                                    </p>
                            @endif
                            <img  class="img-fluid" src="public/upload/{{$product->product_image}}" />
                        <h6 id="title">{{$product->product_Name}}</h6>
                        </a>
                        <div class="product_price">
                        @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                            <p></p>
                        @else
                            <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product->product_price_promotion) ."VNĐ"}}</p>
                        @endif
                            <p style="margin-bottom:4px;font-size: 16px;">{{number_format($product->product_price)}} .VNĐ</p>
                        </div>
                        <div class="text-center">
                            <span><a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}" class="btn btn-default add-to-cart">Chi tiết</a></span>
                            <span><button type="button" title="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">+<i class="fa fa-shopping-cart"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--features_items-->
<div class="page" style="text-align:center">
   {!! $promotion->links() !!}
</div>
@endsection
@section('slider')

        @foreach ($slider as $slider_img)
            <div class="item">
                <div class="col-sm-12">
                    <img src="public/upload/{{$slider_img->img}}" class="img-fluid" alt="" />
                </div>
            </div>
        @endforeach
@endsection
