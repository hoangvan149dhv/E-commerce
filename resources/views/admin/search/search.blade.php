<?php
    use Carbon\Carbon;
?>
@extends('admin.admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Sản Phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <form action="{{ URL::to('/tim-kiem-san-pham') }}" method="POST">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" name="search" class="input-sm form-control">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Tìm</button>
            </span>
          </div>
         </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr >
              <th style="text-align:center">ID khách hàng</th>
              <th style="text-align:center">Sản Phẩm</th>
              <th style="text-align:center">Họ tên </th>
              <th style="text-align:center">Hình Ảnh</th>
              <th style="text-align:center">Ngày</th>
              <th style="text-align:center">Tổng</th>
              <th style="text-align:center">Tình Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($search as $product)
            <tr>
              <td style="text-align:center">{{$product->cusid}}</td>
              <td style="text-align:center">
                  <a href="{{ URL::to('/thong-tin-don-hang/'.$product->orderid)}}">{{$product->productname}}</a>
              </td>
              <td style="text-align:center">  {{$product->cusname}}</td>
              <td style="text-align:center">
                  <img src="public/upload/{{$product->image}}"width=80 height=110 alt="">
              </td>
              <td style="text-align:center">  {{Carbon::createFromFormat('Y-m-d H:i:s', $product->order_date)->format('d/m/yy | H:i:s')}}</td>
              <td style="text-align:center">  {{number_format($product->price)}}.VNĐ</td>
              @if ($product->status==1)
              <td style="text-align:center;background:#bbecc457">
                  <a href="{{ URL::to('/update-status-1/'.$product->orderid) }}" style="color:green;">Đã Giao Xong</a>
                  ||
                  <a href="{{ URL::to('/delete-status-1/'.$product->orderid) }}" style="color:red">Xóa</a>
              @else
              <td style="text-align:center;background:#f0bcb470;">
                  <a href="{{ URL::to('/update-status-0/'.$product->orderid) }}" style="color:red">Đang Xử Lý</a>
              @endif</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
          </div>
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $search->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
@section('order')
     class="active"
@endsection
