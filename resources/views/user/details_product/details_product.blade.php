@extends('layout') {{-- "triệu gọi trang layout như include" LƯU Ý:TRONG LARAVEL ĐẶT FILE PHẢI CÓ .BLADE.PHP --}} {{-- GỌI folder routes/web.php dòng 15 --}} @Section('content') {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
<div class="product-details">
    <!--product-details-->
    @foreach ($details_product as $details_product)
    <div class="col-sm-4">
        <div class="view-product">
            <?php
				// tinh phan tram sale sản phẩm
					$c = 0;
					$c = (100*$details_product->product_price)/$details_product->product_price_promotion;
					$sale = 100-$c;
			?>
                @if ($details_product->product_price_promotion==1||$details_product->product_price_promotion==0)
                <p></p>
                @else
                <span class="stick-promotion">-{{ round($sale) }}%</span> @endif
                <img src="../public/upload/{{$details_product->product_image}}" alt="" />
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($related_product as $item)
                    <a href=""><img src="../public/upload/{{$item->product_image}}" style="margin-left:15px" height="80" width="70" alt="" /></a>
                    @endforeach
                </div>
            </div>
            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    @endforeach
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="../public/client/images/new.jpg" class="newarrival" alt="" />
            <h2 style="color:red;font-weight: 700;">{{$details_product->product_Name}}</h2>
            <p>Mã Hàng: {{$details_product->brandcode_id}}</p>
            {{-- UPDATE SỐ LƯỢNG --}}
            @if ($details_product->product_price_promotion==0 ||$details_product->product_price_promotion==1)
            <p></p>
            @else
            <h4 style="color: #fe980fe8;text-decoration: line-through">{{number_format($details_product->product_price_promotion)}}.VNĐ</h4> 
            @endif
            <form action="{{URL::to('/them-gio-hang')}}" method="POST">
                {{ csrf_field() }}{{--mã tokken --}}
                <span>
                <span>{{number_format($details_product->product_price)}}.VNĐ</span>
                <br>
                <label>Số Lượng:</label>
                <input type="number" name="soluong" value="1" min="1" />
                <input type="hidden" name="product_id_hidden" value="{{ $details_product->product_id }}" />
                <p><b>Chất Liệu:</b> {{$details_product->product_material }}</p>
                <p><b>Thương Hiệu:</b> {{$details_product->brandcode_name}}</p>
                <p><b>Danh Mục:</b> {{$details_product->category_name}}</p>
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i> Đặt Mua
                </button>
                </span>
            </form>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Chi Tiết</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh Gía</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane" id="details">
            <div class="col-sm-12">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        {!! $details_product->product_desc !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade active in" id="reviews">
            <div class="col-sm-12">
                @foreach ($reviewModel as $review)
                <div style="border:1px solid #F7F7F0;">
                    <div style="padding:15px 25px">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>{{ $review->Rname }}</a></li>
                        </ul>
                        <p><strong>NỘI DUNG: </strong>
                            <br> {{ $review->Rcomment }}</p>
                        <p style="text-align:right;"><i class="fa fa-calendar-o"></i>Thời gian: {{(date('d-m-Y', strtotime($review->updated_at)))}}</p>
                    </div>
                </div>
                @endforeach
                <hr>
                <h2 class="text-center" style="color:#FE980F;">ĐÁNH GIÁ SẢN PHẨM</h2>
                <style>
                    h2.text-center {
                        font-size: 20px;
                    }
                </style>
                <form action="{{ URL::to('/chi-tiet/'.$details_product->meta_slug) }}" method="post">
                    {{ csrf_field() }}
                    <span>
                        <input data-validation="length" data-validation-length="5-70" data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="text" name="name" placeholder="Họ tên"/>
                        <input data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền 5- 100 kí tự' type="email" name="email" placeholder="Email"/>
                    </span>
                    <textarea name="comment" data-validation="length" data-validation-length="5-1000" data-validation-error-msg='vui lòng điền 5- 1000 kí tự' placeholder="Nội dung"></textarea>
                    <?php 
                     $message = Session::get('alert');
                     if($message){
                         echo $message;
                         Session::put('alert',null);
                     }
                     ?>
                        <button type="submit" name="submit" class="btn btn-default pull-right">
                            Gửi đi
                        </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
<div class="recommended_items" style="margin-bottom:15px">
    <!--recommended_items-->
    <h2 class="title text-center">Sản Phẩm Liên Quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($show_details_product_recommended as $product_recommended)
                <div class="col-sm-4">
                    <div class="product-image-wrapper details">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{ URL::to('/chi-tiet/'.$product_recommended->meta_slug) }}"><img src="../public/upload/{{$product_recommended->product_image}}" alt="" />
                                <p >{{$product_recommended->product_Name}}</p></a>
                                                                <?php
                                // tinh phan tram sale sản phẩm
                                    $c = 0;
                                    $c = (100*$product_recommended->product_price)/$product_recommended->product_price_promotion;
                                    $sale = 100-$c;
                                ?>
                                @if ($product_recommended->product_price_promotion==1||$product_recommended->product_price_promotion==0)
												@else
													<span class="stick-promotion-brand">-{{ round($sale) }}%</span>
												@endif
												@if ($product_recommended->product_price_promotion==1||$product_recommended->product_price_promotion==0)
                            <p></p>
                            @else
                            <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product_recommended->product_price_promotion) ."VNĐ"}}</p>
                            @endif {{-- //phân trăm sale sản phẩm --}}
                                <h4 style="color: #FE980F;">{{number_format($product_recommended->product_price)}}.VNĐ</h4>
                                <a href="{{ URL::to('/chi-tiet/'.$product_recommended->meta_slug) }}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="item">
                @foreach ($related_product as $related_product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper details">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{ URL::to('/chi-tiet/'.$product_recommended->meta_slug) }}"><img  src="../public/upload/{{$related_product->product_image}}" width="140" height="180" alt="" />
                                    <p style="color:red;font-weight: 700;">{{$related_product->product_Name}}</p>
                                </a>
                                <?php
                                // tinh phan tram sale sản phẩm
                                    $c = 0;
                                    $c = (100*$related_product->product_price)/$related_product->product_price_promotion;
                                    $sale = 100-$c;
                                ?>
                            @if ($related_product->product_price_promotion==1||$related_product->product_price_promotion==0)
							@else
								<span class="stick-promotion-brand">-{{ round($sale) }}%</span>
							@endif
						    @if ($related_product->product_price_promotion==1||$related_product->product_price_promotion==0)
                            <p></p>
                            @else
                            <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($related_product->product_price_promotion) ."VNĐ"}}</p>
                            @endif
                                <h4 style="color: #FE980F;">{{number_format($related_product->product_price)}}.VNĐ</h4>
                                <a href="{{ URL::to('/chi-tiet/'.$product_recommended->meta_slug) }}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!--/recommended_items-->
@endsection
@section('product')
<h2>Sản phẩm khác</h2>
<div class="panel-group">
    <!--brands_products-->
    @foreach ($show_product as $product)
    <div class="product-new">
        <ul class="nav nav-pills nav-stacked">
            <li class="li">
                <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}">
                    <img class="img-fluid" src="../public/upload/{{ $product->product_image }}">
                    <h6 style="color:#ff0000">{{ $product->product_Name}}</h6>
                    @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                    <p></p>
                    @else
                    <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product->product_price_promotion) ."VNĐ"}}</p>
                    @endif 
                    {{-- //phân trăm sale sản phẩm --}}
                    <h4 style="color:#FE980F">{{number_format($product->product_price)}}.VNĐ</h4>
                </a>
            </li>
        </ul>
    </div>
    @endforeach
</div>
@endsection