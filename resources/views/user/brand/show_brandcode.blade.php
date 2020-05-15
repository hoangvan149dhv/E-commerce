@extends('layout')   {{-- "triệu gọi trang layout như include"  LƯU Ý:TRONG LARAVEL ĐẶT FILE PHẢI CÓ .BLADE.PHP --}}
        {{-- GỌI folder routes/web.php dòng 15 --}}
@Section('content')  {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
					<div class="features_items"><!--features_items-->
						{{-- show category --}}
						@foreach ($brand_name as $product)
						<h2 class="title text-center">{{$product->brandcode_name}}</h2>
						{{-- show product where (id) category_product --}}
						@endforeach
						@foreach ($brand_by_id as $product)
						<div class="col-sm-4 col-brand">
							<div class="product-image-wrapper brand">
								<div class="single-products">
										<div class="productinfo text-center">
											<form action="" style="margin-bottom: 0px;">
												@csrf {{-- XEM BÀI 63 --}}
												<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_Name}}" class="cart_product_name_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
											<a href="{{ URL::to('/chi-tiet/'.$product->meta_slug) }}">
												<img class="img-brand" src="../public/upload/{{$product->product_image}}" />
											<h5  id="title">{{$product->product_Name}}</h5></a>
								<?php
                                // tinh phan tram sale sản phẩm
                                    $c = 0;
                                    $c = (100*$product->product_price)/$product->product_price_promotion;
                                    $sale = 100-$c;
                                ?>
                                @if ($product->product_price_promotion==1||$product->product_price_promotion==0)
												@else
													<span class="stick-promotion-brand">-{{ round($sale) }}%</span>
												@endif
												@if ($product->product_price_promotion==1||$product->product_price_promotion==0)
                            <p></p>
                            @else
                            <p style="text-decoration: line-through;color:#ff4b0099">{{number_format($product->product_price_promotion) ."VNĐ"}}</p>
                            @endif {{-- //phân trăm sale sản phẩm --}}
											<p>{{number_format($product->product_price)}}.VNĐ</p>
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
						{{-- CÂU LỆNH PHÂN TRANG --}}
						{!! $brand_by_id->links() !!}
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
                // success:function(data){
                //     alert(data);
                // }
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