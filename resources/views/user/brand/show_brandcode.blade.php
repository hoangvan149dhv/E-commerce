@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach ($brand_name as $product)
    <h2 class="title text-center">{{$product->brandcode_name}}</h2>
    @endforeach
    @foreach ($brand_by_id as $product)
    <div class="col-sm-4 col-brand">
        <div class="product-image-wrapper brand">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form action="" style="margin-bottom: 0px;">
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_Name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <input type="hidden" class="url" url="{{url('/add-cart-ajax')}}" />
                        <input type="hidden" class="url_addtocart_success" url="{{url('/hien-thi-gio-hang')}}" />
                        <a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}">
                            <img class="img-brand" src="../public/upload/{{$product->product_image}}" />
                        <h5  id="title">{{$product->product_Name}}</h5></a>
                        <?php
                        // caculate percent
                            $c    = 0;
                            $c    = (100 * $product->product_price)/$product->product_price_promotion;
                            $sale = 100 - $c;
                        ?>
                        @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                        @else
                            <span class="stick-promotion-brand">-{{ round($sale) }}%</span>
                        @endif
                        <div class="product_price">
                        @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                        <p></p>
                        @else
                        <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product->product_price_promotion) ."VNĐ"}}</p>
                        @endif
                        <p>{{number_format($product->product_price)}}.VNĐ</p>
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
</div><!--features_items-->
<div class="page" style="text-align:center">
    {{-- Paginate--}}
    {!! $brand_by_id->links() !!}
</div>
@endsection
