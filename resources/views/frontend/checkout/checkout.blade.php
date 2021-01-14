<?php use Carbon\Carbon;?>
@extends('frontend.index')
@Section('content')
    @php $dataCart = Cart::content();@endphp
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
            <div class="row">
                <form action="{{ URL::to('/thanh-toan-don-hang') }}" method="POST" name="shopper_info" id="shopper-info"
                      class="billing-form d-md-flex">
                    @csrf
                    <div class="col col-lg-7 col-md-6 mt-5 ftco-animate">
                        <h3 class="mb-4 billing-heading">Thông tin khách hàng</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Họ tên</label>
                                    <input data-validation="length" data-validation-length="1-100"
                                           data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text"
                                           name="name" placeholder="Họ Và Tên Người Nhận" class="form-control">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Số Điện Thoại</label>
                                    <input class="form-control"
                                           data-validation="length" data-validation-length="10-11"
                                           data-validation-error-msg='vui lòng điền đúng số điện thoại bắt đầu 09xx,...'
                                           type="number"
                                           name="phone" placeholder="0909xxxxxx">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input class="form-control" data-validation="length" data-validation-length="5-100"
                                           data-validation-error-msg='vui lòng điền đúng đúng email, Khi order sẽ được gửi mail, tối đa 150 kí tự'
                                           type="email"
                                           name="email" placeholder="Nhập đúng email, Khi order sẽ được gửi mail">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Chọn tỉnh thành phố</label>
                                    <div class="selectsf-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="city" id="city"
                                                class="form-control input-sm m-bot15 choose select-address city">
                                            <option value="">Chọn tỉnh thành phố</option>
                                            @foreach ($city as $key=>$city)
                                                <option value="{{$city->matp}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="val_feeship" name="val_feeship"
                                               value="20000">
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="province select-address">Quận huyện</label>
                                    <select name="province" id="province"
                                            class="form-control input-sm m-bot15 choose select-address province">
                                        <option value="">Quận huyện</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="wards">Phường xã</label>
                                    <select name="wards" id="wards"
                                            class="form-control input-sm m-bot15 select-address wards">
                                        <option value="">Phường xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Địa chỉ</label>
                                    <input data-validation="length" data-validation-length="1-100"
                                           data-validation-error-msg='vui lòng điền đầy đủ thông tin' type="text"
                                            placeholder="VD: Nguyễn Huệ" class="form-control add">
                                </div>
                            </div>
                            <input type="hidden" name="add" id="val_address">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">Ghi chú</label>
                                    <textarea data-validation="length" data-validation-length="0-1000"
                                              data-validation-error-msg='vui lòng điền thông tin'
                                              name="note" class="form-control"
                                              id="" rows="6"
                                              placeholder="Ghi Chú (vd: chung cư, công ty,...)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Tổng giỏ hàng</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span class="fee_cart_product">{{ Cart::subtotal(0) }}</span><span>VNĐ</span>
                            </p>
                            <p class="d-flex">
                                <span class="fee_ship">Phí giao hàng</span>
                                <span class="fee_ship_cart"></span><span class="fee_delivery"></span>
                            </p>
                            <hr>
                            <p class="d-flex">
                                <span>Tổng</span>
                                <span class="total_price">{{ Cart::subtotal(0) }}</span><span>VNĐ</span>
                            </p>
                        </div>
                        <p class="text-center">
                            <button
                                    class="btn btn-primary py-3 px-4" id="check-out">Thanh toán
                            </button>

                        </p>
                    </div>
                </form>
            </div>
        @else
            <div class="row justify-content-start">
                <p class="text-center text-danger">Chưa có sản phẩm
                </p>
            </div>
    </div>
    @endif
    <!--/#cart_items-->
    <div id="img-load"><img src="public/upload/reloading.gif" class="load-page"></div>
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Thanh toán <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Thanh toán</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <!-- JS -->
    <script src="{{asset('public/frontend/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
    <script>
        var select_delivery = "{{url('/select-delivery') }}";
        var select_delivery_feeship = "{{url('/select-delivery-feeship') }}";
        $(document).ready(function () {
            $('.select-address').select2({
                placeholder: 'vui lòng điền thông tin',
                language: "vi",
                "language": {
                    "noResults": function(){
                        return "Chưa có dữ liệu";
                    }
                }
            });
        });

    </script>

@endsection
@section('link')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/select2/dist/css/select2.min.css')}}">
    <style>
        .select2-selection__rendered {
            line-height: 55px !important;
        }

        .select2-container .select2-selection--single {
            height: 55px !important;
        }

        .select2-selection__arrow {
            height: 55px !important;
        }
        #img-load {
            text-align: center;
            position: fixed;
            z-index: 9999999999;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: 100%;
            border: 0;
            padding: calc( 50vh - 50px)  0;
            top: 0;
            left: 0;
            display: none;
            overflow: hidden
        }
    </style>
@endsection
