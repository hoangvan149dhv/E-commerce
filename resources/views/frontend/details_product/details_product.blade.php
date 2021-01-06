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
                            style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});">
                        </li>
                        <li class="product-details" data-target="#product_details_slider" data-slide-to="2"
                            style="background-image: url({{asset('public/upload/86190117_773654536376111_1148412901342576640_n39.jpg' )}});">
                        </li>
                        <li class="product-details" data-target="#product_details_slider" data-slide-to="3"
                            style="background-image: url({{asset('public/upload/83815495_773654023042829_651030464122847232_o94.jpg' )}});">
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
                               href="{{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg')}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg')}}"
                                     alt="Second slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a class="gallery_img"
                               href="{{asset('public/upload/86190117_773654536376111_1148412901342576640_n39.jpg')}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/86190117_773654536376111_1148412901342576640_n39.jpg')}}"
                                     alt="Third slide">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a class="gallery_img"
                               href="{{asset('public/upload/83815495_773654023042829_651030464122847232_o94.jpg')}}">
                                <img class="d-block w-100"
                                     src="{{asset('public/upload/83815495_773654023042829_651030464122847232_o94.jpg')}}"
                                     alt="Fourth slide">
                            </a>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product_details_slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#product_details_slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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
                    <div class="p-4 product-description">
                        {!! $detail_product->product_desc !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                    <div class="row p-4">
                        <div class="col-md-7">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#reviewsProduct">Viết bình luận đánh giá sản phẩm
                            </button>
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
                                                class="text-right"><i class="fa fa-calendar-o"></i> {{(date('d-m-Y', strtotime($review->updated_at)))}}</span>
                                        </h4>
                                        <p>{{$review->Rcomment}}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="modal fade" id="reviewsProduct" tabindex="-1" role="dialog"
                                 aria-labelledby="reviewsProductLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewsProductLabel">Đánh giá</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ URL::to('/chi-tiet/'.$detail_product->product_id) }}"
                                              method="post">
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="pid"
                                                       value="{{$detail_product->product_id}}"/>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Họ tên:</label>
                                                    <input data-validation="length" data-validation-length="5-70"
                                                           class="form-control"
                                                           data-validation-error-msg='vui lòng điền tối đa 70 kí tự'
                                                           type="text" name="name"
                                                           placeholder="Họ tên"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                                    <input data-validation="length" data-validation-length="5-100"
                                                           class="form-control"
                                                           data-validation-error-msg='vui lòng điền tối đa 100 kí tự'
                                                           type="email" name="email"
                                                           placeholder="Email"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Nội dung:</label>
                                                    <textarea class="form-control" name="comment"
                                                              data-validation="length" data-validation-length="1-1000"
                                                              data-validation-error-msg='Vui lòng điền tối đa 1000 ký tự'
                                                              placeholder="Nội dung"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Đóng
                                                </button>
                                                <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/product-details-->
    <!--product-related-->
    <div class="row ftco-animate">
        <div class="col-md-12 heading-section text-center ftco-animate fadeInUp ftco-animated">
            <h2>Một số gợi ý cho bạn</h2>
        </div>
        <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl product-related">
                @foreach ($products_detail_recommended as $product)
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                             style="background-image: url({{asset('public/upload/'.$product->product_image )}});">
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
                                    <input type="hidden" class="url_addtocart_success"
                                           url="{{url('/hien-thi-gio-hang')}}"/>
                                    <input type="hidden" value="1"
                                           class="cart_product_qty_{{$product->product_id}}">
                                    <a href="#" class="d-flex align-items-center justify-content-center add-to-cart"
                                       data-id_product="{{$product->product_id}}" name="add-to-cart">
                                        <span class="fa fa-shopping-cart"></span>
                                    </a>
                                    <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}"
                                       class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-search" aria-hidden="true"></span></a>
                                <div class="stick-promotion_countdown"
                                     id="stick-promotions_{{$product->product_id}}">
                                </div>
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
                                    <span
                                        class="price price-sale">{{number_format($product->product_price_promotion) ."VNĐ"}}</span>
                                @endif
                                <span class="price">{{number_format($product->product_price)}}.VNĐ</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--/product-related-->
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
