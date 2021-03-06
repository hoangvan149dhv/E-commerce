<?php use Carbon\Carbon;?>
@extends('frontend.index')
@Section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $dataCart = Cart::content();@endphp
    
<section class="ftco-section">
    <div class="container">
        @if($dataCart->count())
            <div class="row">
                <div class="table-wrap">
                    <table class="table cart">
                        <thead class="thead-primary">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>SL</th>
                            <th>Tổng</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataCart as $data)
                            <tr class="alert" role="alert">
                                <td>
                                    <div class="img"
                                         style="background-image: url('public/upload/{{$data->options['images']}}');"></div>
                                </td>
                                <td>
                                    <div class="name">
                                        {{$data->name}}
                                    </div>
                                </td>
                                <td>{{number_format($data->price)}}</td>
                                <td class="quantity">
                                    <form action="{{ URL::to('update_cart_quantity') }}" method="POST" class="d-flex">
                                        {{ csrf_field() }}
                                        @csrf
                                        <div class="cart_quantity_button input-group" style="text-align: center;">
                                            <input type="hidden" value="{{$data->rowId}}" name="rowId_cart">
                                            <input class="quantity form-control input-number" type="number" name="qty"
                                                   value="{{$data->qty}}" width="50px"
                                                   min="1">
                                        </div>
                                        <input type="submit" name="submit" value="Sửa" class="btn-primary">
                                    </form>
                                </td>
                                <td><?php
                                    $subtotal = $data->price * $data->qty;
                                    echo number_format($subtotal);
                                    ?>.VNĐ
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')"
                                       class="cart_quantity_delete"
                                       data-id="$data->rowId"
                                       href="{{ URL::to('/delete/'.$data->rowId) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>{{ Cart::subtotal(0) }}.VNĐ</span>
                    </p>
                    <p class="d-flex">
                        <span>Phí giao hàng</span>
                        <span>0</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Tổng</span>
                        <span>{{ Cart::subtotal(0) }}.VNĐ</span>
                    </p>
                </div>
                <p class="text-center"><a href="{{URL::to('/thanh-toan')}}" class="btn btn-primary py-3 px-4">Thanh toán</a>
                </p>
            </div>
        </div>
        @else
            <div class="row justify-content-start">
                    <p class="text-center text-danger">Chưa có sản phẩm
                    </p>
                </div>
            </div>
        @endif
    </div>
    <!--/#cart_items-->
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Giỏ hàng <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
