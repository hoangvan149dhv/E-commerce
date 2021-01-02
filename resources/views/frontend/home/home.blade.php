<?php use Carbon\Carbon;?>
@extends('frontend.index')
@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Our Delightful offerings</span>
            <h2>Sản Phẩm Mới Nhất</h2>
        </div>
    </div>
    <div class="row">
        <!--Product-->
        @foreach ($all_product as $product)
            <div class="col-md-3 d-flex">
                <div class="product ftco-animate">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url(public/upload/{{ $product->product_image }});">
                        <div class="desc">
                            <p class="meta-prod d-flex">
                                <form action="" style="margin-bottom: 0px;">
                                    @csrf
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
                                    <a href="#" class="d-flex align-items-center justify-content-center add-to-cart" 
                                        data-id_product="{{$product->product_id}}" name="add-to-cart">
                                        <span class="flaticon-shopping-bag"></span>
                                    </a>
                                </form>
                                <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                            </p>
                        </div>
                    </div>
                    <div class="text text-center">
                        @if ($product->product_price_promotion == 1 ||$product->product_price_promotion ==0)
                        @else
                            <?php
                            // caculate percent discount
                            $c = 0;
                            $c = (100 * $product->product_price) / $product->product_price_promotion;
                            $sale = 100 - $c;
                            ?>
                            <span class="stick-promotion sale">-{{ round($sale) }}%</span>
                            <span class="stick-promotion_countdown"
                                    id="stick-promotions_{{$product->product_id}}"></span>
                        @endif
                        <h2>{{ $product->product_Name }}</h2>
                        <p class="mb-0">
                            @if ($product->product_price_promotion == 1 ||$product->product_price_promotion == 0 )
                                <span></span>
                            @else
                                <span class="price price-sale">{{number_format($product->product_price_promotion) ."VNĐ"}}</span>
                            @endif
                            <span class="price">{{number_format($product->product_price)}}.VNĐ</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        <!--/Product-->
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="#" class="btn btn-primary d-block">Xem thêm<span class="fa fa-long-arrow-right"></span></a>
        </div>
    </div>
@endsection
@section('blog')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Góc chia sẻ</span>
            <h2>Bí quyết làm đẹp</h2>
            </div>
        </div>
        <div class="row d-flex">
            @foreach ($blogs as $blog)
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->news_id) }}" class="block-20 img" style="background-image: url('public/upload/{{  $blog->news_image }}');">
                    </a>
                    <div class="text p-4 bg-light">
                        <div class="meta">
                            <p><span class="fa fa-calendar"></span>
                                {{Carbon::createFromFormat('Y-m-d H:i:s',  $blog->updated_at)->format('d/m/yy') }}
                            </p>
                        </div>
                    <h3 class="heading mb-3"><a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->news_id) }}">{{ $blog->news_title }}</a></h3>
                    <p>{{ $blog->news_desc }}</p>
                    <a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->news_id) }}" class="btn-custom">Xem thêm<span class="fa fa-long-arrow-right"></span></a>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
  </section>	
@endsection
{{-- @section('popup')
    <div id="background">
        <img src="{{asset('public/upload/qc2.png')}}" alt="">
    </div>
@endsection --}}
@section('script')
    <script>
        @foreach ($all_product as $product)
        // Set the date we're counting down to
        // Update the count down every 1 second
        var x = setInterval(function () {
            const countDownDate_{{$product->product_id}} = {{$product->promotion_end_date}} * 1000;
            // Get today's date and time
            var now = new Date().getTime();
            var onedayGMT7 = (1000 * 60 * 60 * 7);
            // Find the distance between now and the count down date
            var distance = (countDownDate_{{$product->product_id}} - now) - onedayGMT7;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (document.getElementById("stick-promotions_{{$product->product_id}}") !== null) {
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

