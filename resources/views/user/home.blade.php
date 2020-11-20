@extends('home_page')
@Section('content')
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Sản Phẩm Mới Nhất</h2>
        @foreach ($all_product as $product)
            <div class="col-sm-3 col-xs-6 col-ipad" style="padding:0 5px;">
                <div class="product-image-wrapper product-image">
                    <div class="single-products">
                        <div class="productinfo text-center" id="product">
                            <form action="" style="margin-bottom: 0px;">
                                @csrf {{-- XEM BÀI 63 --}}
                                <input type="hidden" value="{{$product->product_id}}"
                                       class="cart_product_id_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_Name}}"
                                       class="cart_product_name_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_image}}"
                                       class="cart_product_image_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_price}}"
                                       class="cart_product_price_{{$product->product_id}}">
                                <input type="hidden" class="url" url="{{url('/add-cart-ajax')}}"/>
                                <input type="hidden" class="url_addtocart_success" url="{{url('/hien-thi-gio-hang')}}"/>
                                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                <?php
                                // tinh phan tram sale sản phẩm
                                $c = 0;
                                $c = (100 * $product->product_price) / $product->product_price_promotion;
                                $sale = 100 - $c;
                                ?>
                                <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}" title="Chi tiết">
                                    @if ($product->product_price_promotion==1||$product->product_price_promotion==0)

                                    @else
                                        <span class="stick-promotion">-{{ round($sale) }}%</span>
                                        <span class="stick-promotion_countdown"
                                              id="stick-promotions_{{$product->product_id}}"></span>
                                    @endif
                                    <img class="img-fluid" src="public/upload/{{$product->product_image}}"/>
                                    <h5 id="title">{{$product->product_Name}}</h5>
                                </a>
                                <div class="product_price">
                                    @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                                        <p></p>
                                    @else
                                        <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product->product_price_promotion) ."VNĐ"}}</p>
                                    @endif
                                    <p style="margin-bottom:4px;font-size: 16px;">{{number_format($product->product_price)}}
                                        .VNĐ</p>
                                </div>
                                <div class="text-center">
                                    <span><a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}"
                                             class="btn btn-default add-to-cart">Chi tiết</a></span>
                                    <span><button type="button" title="Thêm giỏ hàng"
                                                  class="btn btn-default add-to-cart"
                                                  data-id_product="{{$product->product_id}}" name="add-to-cart">+<i
                                                class="fa fa-shopping-cart"></i></button></span>
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
        {!! $all_product->links() !!}
    </div>
@endsection
@section('pupup')
    <div id="background">
        <img src="public/upload/qc2.png" alt="">
    </div>
@endsection
@section('slider')
    @foreach ($slider as $slider_img)
        <div class="item">
            <div class="col-sm-12">
                <img src="public/upload/{{$slider_img->img}}" class="img-fluid" alt=""/>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        @foreach ($all_product as $product)
        // Set the date we're counting down to
        // Update the count down every 1 second
        var x = setInterval(function () {
            const countDownDate_{{$product->product_id}} = new Date("{{$product->promotion_end_date}}").getTime();
            // Get today's date and time
            var now = new Date().getTime();
            var onedayGMT7 = (1000 * 60 * 60 * 17);
            // Find the distance between now and the count down date
            var distance = (countDownDate_{{$product->product_id}} - now) + onedayGMT7;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if ( document.getElementById("stick-promotions_{{$product->product_id}}") !== null )
            {
                // Display the result in the element with id="demo"
                document.getElementById("stick-promotions_{{$product->product_id}}").innerHTML = "Còn " + days + " ngày " + hours + ":"
                    + minutes + ":" + seconds;
                document.getElementById("stick-promotions_{{$product->product_id}}").style.background = '#fe980f';
                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("stick-promotions_{{$product->product_id}}").innerHTML = "SALE";
                    document.getElementById("stick-promotions_{{$product->product_id}}").style.background = '#fe980f';
                }
            }
        }, 1000);
        @endforeach
    </script>
@endsection
