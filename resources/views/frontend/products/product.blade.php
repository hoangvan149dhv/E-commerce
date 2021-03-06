<?php use Carbon\Carbon;?>
@extends('frontend.index')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('public/upload/83815495_773654023042829_651030464122847232_o6.jpg')}}"
         data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/')}}">Trang chủ <i
                        class="fa fa-chevron-right"></i></a></span> <span>@foreach ($category_name as $product){{$product->category_name}}@endforeach<i
                        class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">{{$product->category_name}}</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h4 class="product-select"></h4>
                        <select class="selectpicker" multiple>
                            <option>Lụa nhật</option>
                            <option>Co Dãn</option>
                            <option>Rẻ</option>
                            <option>Tinh Hoa</option>
                        </select>
                    </div>
                </div>
                <div class="row">

                    @foreach ($promotion as $product)
                    <div class="col-md-4 col-lg-3 col-12 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center" style="background-image: url({{asset('public/upload/'. $product->product_image )}})">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
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
                                            <span class="flaticon-shopping-bag" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}" class="d-flex align-items-center justify-content-center"><span class="fa fa-search" aria-hidden="true"></span></a>
                                        <div class="stick-promotion_countdown"
                                        id="stick-promotions_{{$product->product_id}}"></div>
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
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                <li>{!! $promotion->links() !!}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Product Types</h3>
                        <ul class="p-0">
                            <li><a href="#">Brandy <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Gin <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Rum <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Tequila <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Vodka <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="#">Whiskey <span class="fa fa-chevron-right"></span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- ##### Single Widget ##### -->
                <div class="widget price mb-50">
                    <!-- Widget Title -->
                    <h6 class="widget-title mb-30">Price</h6>

                    <div class="widget-desc">
                        <div class="slider-range">
                            <div data-min="10" data-max="1000" data-unit="$"
                                 class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                 data-value-min="10" data-value-max="1000" data-label-result="">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            </div>
                            <div class="range-price">$10 - $1000</div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3>Recent Blog</h3>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                        <div class="text">
                            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                blind texts</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        @foreach ($promotion as $product)
        @if (!empty($product->promotion_end_date))
            var countdown = setInterval(function () {
                const countDownDate_{{$product->product_id}} = {{$product->promotion_end_date}} * 1000;
                var now = new Date().getTime();
                var onedayGMT7 = (1000 * 60 * 60 * 7);
                var distance = (countDownDate_{{$product->product_id}} - now) - onedayGMT7;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (document.getElementById("stick-promotions_{{$product->product_id}}") !== null) {
                    document.getElementById("stick-promotions_{{$product->product_id}}").innerHTML = "Còn " + days + " ngày " + hours + ":"
                        + minutes + ":" + seconds;
                    if (distance < 0) {
                        clearInterval(countdown);
                        document.getElementById("stick-promotions_{{$product->product_id}}").innerHTML = "";
                    }
                }
            }, 1000);
            @endif
        @endforeach
    </script>
@endsection