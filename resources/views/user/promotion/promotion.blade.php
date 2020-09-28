@extends('home_page') @Section('content')
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
@section('script')
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            //ID CỦA  BUTTON
            var id = $(this).data('id_product');
            var cart_id = $('.cart_product_id_' + id).val();
            var cart_name = $('.cart_product_name_' + id).val();
            var cart_image = $('.cart_product_image_' + id).val();
            var cart_price = $('.cart_product_price_' + id).val();
            var cart_qty = $('.cart_product_qty_' + id).val();
            var token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data: {
                    cart_id: cart_id,
                    cart_name:cart_name,
                    cart_image:cart_image,
                    cart_price:cart_price,
                    cart_qty:cart_qty,
                    _token:token
                },
                success:function(){setTimeout(() => {
                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể tiếp tục mua hàng hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-primary",
                            confirmButtonText: "Đi đến giỏ hàng",
                            type:"success",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/hien-thi-gio-hang')}}";
                        });
                        }, 100);
                    }

                });
            });
        });
    </script>
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
