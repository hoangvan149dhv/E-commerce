<?php use Carbon\Carbon;?>
@extends('frontend.index')
@section('schema_structure_article_data')
                ,{
                    "@type": "Article",
                    "headline": "{{$meta_title . ' - ' .config('config_admin.site_name') ?? config('config_admin.site_name') }}",
                    "author": {
                        "@type": "Person",
                        "name": "{{config('config_admin.site_name')}}"
                    },
                    "description": "{{ $meta_desc ?? '' }}",
                    "@id": "{{URL::to('/')}}/#schema",
                    "isPartOf": {
                        "@id": "{{URL::to('/')}}/#webpage"
                    },
                    "publisher": {
                        "@id": "{{URL::to('/')}}/#organization"
                    },
                    "inLanguage": "vi",
                    "mainEntityOfPage": {
                        "@id": "{{URL::to('/')}}/#webpage"
                    }
                }
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Our Delightful offerings</span>
                <h2>Sản Phẩm Mới Nhất</h2>
            </div>
        </div>
        <div class="row">
            <!--Product-->
            @foreach ($all_product as $product)
                <div class="col-md-4 col-lg-3 col-12 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center" style="background-image: url(public/upload/{{ $product->product_image }});">
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
            <!--/Product-->
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="#" class="btn btn-primary d-block">Xem thêm<span class="fa fa-long-arrow-right"></span></a>
            </div>
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
                        <a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->meta_slug) }}" class="block-20 img" style="background-image: url('public/upload/{{  $blog->news_image }}');">
                    </a>
                    <div class="text p-4 bg-light">
                        <div class="meta"><span class="fa fa-calendar"></span>
                                {{Carbon::createFromFormat('Y-m-d H:i:s',  $blog->updated_at)->format('d/m/yy') }}
                        </div>
                    <h3 class="heading mb-3"><a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->meta_slug) }}">{{ $blog->news_title }}</a></h3>
                    <p>{{ $blog->news_desc }}</p>
                    <a href="{{ URL::to('/tin-tuc-chia-se/'.$blog->meta_slug) }}" class="btn-custom">Xem thêm<span class="fa fa-long-arrow-right"></span></a>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
  </section>
@endsection
@section('script')
    <script>
        @foreach ($all_product as $product)
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
@section('slider')
    <div class="hero-wrap" style="background-image: url('public/upload/{{$slider[0]->img ?? ''}}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="mb-4">Good <span>Drink</span> for Good <span>Moments</span>.</h1>
                        <p><a href="#" class="btn btn-primary py-2 px-4">Shop Now</a> <a href="#" class="btn btn-white btn-outline-white py-2 px-4">Read more</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="text">
                            <h2>Online Support 24/7</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-cashback"></span>
                        </div>
                        <div class="text">
                            <h2>Money Back Guarantee</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Free Shipping &amp; Return</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(public/upload/83815495_773654023042829_651030464122847232_o6.jpg);">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <span class="subheading">Since 1905</span>
                        <h2 class="mb-4">Desire Meets A New Taste</h2>

                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
                        <p class="year">
                            <strong class="number" data-number="115">0</strong>
                            <span>Years of Experience In Business</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/83815495_773654023042829_651030464122847232_o6.jpg);"></div>
                        <h3>Brandy</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/85137522_773653723042859_9173677491418562560_n30.jpg);"></div>
                        <h3>Phụ nữ</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/84612966_773653896376175_640374783405457408_o42.jpg);"></div>
                        <h3>Cách tân</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/84612966_773653896376175_640374783405457408_o42.jpg);"></div>
                        <h3>Truyền thống</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/83815495_773654023042829_651030464122847232_o6.jpg);"></div>
                        <h3>Cách tân</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url(public/upload/83815495_773654023042829_651030464122847232_o6.jpg);"></div>
                        <h3>Truyền thống</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

