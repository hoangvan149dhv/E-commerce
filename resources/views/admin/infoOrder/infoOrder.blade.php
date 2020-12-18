<?php

use Carbon\Carbon;

?>
@extends('admin.index')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:15px">
                Thông Tin Khách hàng
            </div>
            <div class="table-responsive" style="margin-bottom:55px">
                <table class="table table-striped b-t b-light table-hover" style="border:1px solid #eae6e6">
                    <thead style="border:1px solid #eae6e6">
                    <tr>
                        <th style="text-align:center;width:15%">Họ tên</th>
                        <th style="text-align:center;width:15%">SĐT</th>
                        <th style="text-align:center;width:20%">Địa chỉ</th>
                        <th style="text-align:center;width:30%">Ghi chú</th>
                        <th style="text-align:center">Tổng</th>
                        <th style="text-align:center">Phí giao hàng</th>
                        <th style="text-align:center;width:20%">Ngày đặt</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($infocustomerorder as $info)
                        <tr>
                            <td style="text-align:center">  {{$info->customer->cusname}}</td>
                            <td style="text-align:center">  {{$info->customer->cusPhone}}</td>
                            <td style="text-align:center">  {{$info->customer->cusadd}}</td>
                            <td style="text-align:center">  {{$info->customer->cusNote}}</td>
                            <td style="text-align:center">  {{number_format($info->total)}}.VNĐ</td>
                            <td style="text-align:center">  {{number_format($info->fee_ship)}}.VNĐ</td>
                            <td style="text-align:center">  {{Carbon::createFromFormat('Y-m-d H:i:s', $info->order_date)->format('d/m/yy | H:i:s')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            {{-- ORDER INFO --}}
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:15px">
                    Thông Tin Đơn hàng
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light table-hover" style="border:1px solid #eae6e6">
                        <thead style="border:1px solid #eae6e6">
                        <tr>
                            <th style="text-align:center">Sản Phẩm</th>
                            <th style="text-align:center">Hình Ảnh</th>
                            <th style="text-align:center">Chất liệu</th>
                            <th style="text-align:center">Số Lượng</th>
                            <th style="text-align:center">Đơn giá</th>
                            <th style="text-align:center">Tình Trạng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($getProductItems as $product)
                            @php
                                $productItem = \App\Http\library\product_detail::getProductDetail($product);
                                $productItem->qty = $product;
                            @endphp
                            <tr>
                                <td style="text-align:center"><a
                                        href="{{URL::to('/edit-product/'.$productItem[0]->product_id)}}">{{$productItem[0]->product_Name}}</a>
                                </td>
                                <td style="text-align:center"><a
                                        href="{{URL::to('/edit-product/'.$productItem[0]->product_id)}}"><img
                                            src="{{asset('public/upload/'.$productItem[0]->product_image )}}" width=80
                                            height=110></a></td>
                                <td style="text-align:center">  {{$productItem[0]->product_material}}</td>
                                <td style="text-align:center">  {{$productItem->qty}}</td>
                                <td style="text-align:center">  {{number_format($productItem[0]->product_price)}}.VNĐ</td>
                                @if ($info->status == 1 )
                                    <td style="text-align:center;background:#bbecc457">
                                        <a href="{{ URL::to('/update-status/'.$info->orderid).'/0' }}" style="color:green;">Đã Giao Xong</a>
                                    </td>
                                @else
                                    <td style="text-align:center;background:#f0bcb470;">
                                        <a href="{{ URL::to('/update-status/'.$info->orderid.'/1') }}" style="color:red">Đang Xử Lý</a>
                                    </td>
                                @endif
                                <td style="text-align:center">
                                    <a href="{{URL::to('/print-pdf/'.$info->orderid.'/Hiện')}}" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                    </div>
                </footer>
            </div>
        </div>
@endsection
