@extends('frontend.index')
@Section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="single_product_thumb">
                <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li class="active product-details" data-target="#product_details_slider" data-slide-to="0"
                            style="background-image: url({{asset('public/upload/'.$details_product[0]->product_image )}});">
                        </li>
                        <li class="product-details" data-target="#product_details_slider" data-slide-to="1"
                            style="background-image: url({{asset('public/upload/'.$details_product[0]->product_image )}});">
                        </li>
                        <li class="product-details" data-target="#product_details_slider" data-slide-to="2"
                            style="background-image: url({{asset('public/upload/'.$details_product[0]->product_image )}});">
                        </li>
                        <li class="product-details" data-target="#product_details_slider" data-slide-to="3"
                            style="background-image: url({{asset('public/upload/'.$details_product[0]->product_image )}});">
                        </li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a class="gallery_img"
                               href="{{asset('public/upload/'.$details_product[0]->product_image )}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/'.$details_product[0]->product_image )}}"
                                     alt="First slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a class="gallery_img"
                               href="{{asset('public/upload/'.$details_product[0]->product_image )}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/'.$details_product[0]->product_image )}}"
                                     alt="Second slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a class="gallery_img"
                               href="{{asset('public/upload/'.$details_product[0]->product_image )}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/'.$details_product[0]->product_image )}}"
                                     alt="Third slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a class="gallery_img"
                               href="{{asset('public/upload/'.$details_product[0]->product_image )}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/'.$details_product[0]->product_image )}}"
                                     alt="Fourth slide">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
            @foreach ($details_product as $detail_product)
                <h3>{{$detail_product->product_Name}}</h3>
                <div>
                    <p><b>Chất Liệu:</b> {{$detail_product->product_material }}</p>
                    <p><b>Thương Hiệu:</b> {{$detail_product->brandcode_name}}</p>
                    <p><b>Danh Mục:</b> {{$detail_product->category_name}}</p>
                </div>
            @endforeach
            @if ($detail_product->product_price_promotion == 1 || $detail_product->product_price_promotion == 0)
                <p class="price"><span>{{number_format($detail_product->product_price)}}.VNĐ</span></p>
            @else
                <p class="price price-sale"
                   style="text-decoration:line-through">{{number_format($detail_product->product_price)}}.VNĐ</p>
                <p class="price"><span>{{number_format($detail_product->product_price_promotion)}}.VNĐ</span></p>
            @endif
            <form action="{{URL::to('/them-gio-hang')}}" method="POST">
                {{ csrf_field() }}
                <div class="row mt-4">
                    <div class="input-group col-md-6 d-flex mb-3">
                        <button type="button" class="quantity-left-minus btn mr-2" data-type="minus" data-field="">
                            <i class="fa fa-minus"></i>
                        </button>
                        <input type="number" id="quantity" name="qty" class="quantity form-control input-number"
                               value="1" min="1" max="100">
                        <button type="button" class="quantity-right-plus btn ml-2" data-type="plus" data-field="">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                    <input type="hidden" name="product_id_hidden" value="{{ $detail_product->product_id }}"/>
                    <button type="submit" class="btn btn-primary py-3 px-5">Thêm giỏ hàng
                    </button>
            </form>
        </div>
    </div>
    <div class="row mt-5 description">
        <div class="col-md-12 nav-link-wrap">
            <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
                   role="tab" aria-controls="v-pills-1" aria-selected="true">Chi tiết</a>
                <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                   aria-controls="v-pills-3" aria-selected="false">Đánh giá</a>

            </div>
        </div>
        <div class="col-md-12 tab-wrap">
            <div class="tab-content bg-light" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                    <div class="p-4">
                        {!! $detail_product->product_desc !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                    <div class="row p-4">
                        <div class="col-md-7">
                            <h3 class="mb-4">{{count($reviewModel)}} Đánh giá</h3>
                            @foreach ($reviewModel as $review)
                                <div class="review">
                                    <a href="#">
                                        <div class="user-img"
                                             style="background-image: url({{asset('public/upload/user/user.png')}}"></div>
                                    </a>
                                    <div class="desc">
                                        <h4>
                                            <span class="text-left">{{$review->Rname}}</span>
                                            <span
                                                class="text-right">{{(date('d-m-Y', strtotime($review->updated_at)))}}</span>
                                        </h4>
                                        <p>{{$review->Rcomment}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/product-details-->
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/'.$details_product[0]->product_image ) ?? ''}})"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ<i class="fa fa-chevron-right"></i></a></span>
                        <span><a href="{{ URL::to('/Danh-muc-san-pham/'.$details_product[0]->category_id) ?? '#'}}">{{$show_product[0]->category_name ?? 'Chi tiết sản phẩm'}}<i
                                    class="fa fa-chevron-right"></i></a></span>
                        <span>{{$details_product[0]->product_Name ?? ''}}</span></p>
                    <h2 class="mb-0 bread">{{$details_product[0]->product_Name ?? ''}}</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.quantity-right-plus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                $('#quantity, #qty').val(quantity + 1);
            });

            $('.quantity-left-minus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                if (quantity > 1) {
                    $('#quantity, #qty').val(quantity - 1);
                }
            });
        });
    </script>
@endsection
