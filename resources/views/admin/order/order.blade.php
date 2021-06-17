<?php
    use Carbon\Carbon;
?>
@extends('admin.index')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Đơn Hàng Khách đặt
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4">
        </div>
{{--        <div class="col-sm-3">--}}
{{--          <form action="{{ URL::to('/admin/search-order') }}" method="POST">--}}
{{--            {{ csrf_field() }}--}}
{{--          <div class="input-group">--}}
{{--            <input type="text" name="search" class="input-sm form-control">--}}
{{--            <span class="input-group-btn">--}}
{{--              <button class="btn btn-sm btn-default" type="submit" name="submit">Tìm</button>--}}
{{--            </span>--}}
{{--          </div>--}}
{{--        </form>--}}
{{--        </div>--}}
      </div>
      <div class="table-responsive">
        <form action="{{ URL::to('/admin/destroy-order') }}" method="get">
        <table class="table table-striped b-t b-light table-hover "style="border:1px solid #eae6e6">
          <thead>
            <tr >
              <th style="text-align:center"><input type="checkbox" name="select-all"  id="select-all"/></th>
              <th style="text-align:center">ID khách hàng</th>
              <th style="text-align:center">Họ tên </th>
              <th style="text-align:center">Hình Ảnh</th>
              <th style="text-align:center">Ngày</th>
              <th style="text-align:center">Tình Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($product_order as $order)
            <tr>
              <td style="text-align:center"><input type="checkbox" value="{{ $order->orderid }}" name="orderid[]"></td>
              <td style="text-align:center"><a href="{{ URL::to('/admin/thong-tin-don-hang/'.$order->orderid) }}">{{$order->cusid}}</a></td>
              <td style="text-align:center"><a href="{{ URL::to('/admin/thong-tin-don-hang/'.$order->orderid) }}">{{$order->customer->cusname}}</a></td>
              <td style="text-align:center">{{Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('d/m/yy | H:i:s')}}</td>
              <td style="text-align:center">{{number_format($order->total)}}.VNĐ</td>
              @if ($order->status == 1 )
              <td style="text-align:center;background:#bbecc457">
                  <a href="{{ URL::to('/admin/update-status/'.$order->orderid).'/0' }}" style="color:green;">Đã Giao Xong</a>
              @else
              <td style="text-align:center;background:#f0bcb470;">
                  <a href="{{ URL::to('/admin/update-status/'.$order->orderid.'/1') }}" style="color:red">Đang Xử Lý</a>
              </td>
              @endif
            </tr>
            @endforeach
            <tr><td><button onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')" class="btn btn-danger" type="submit">Xóa</button></td></tr>
          </tbody>
        </table>
        </form>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $product_order->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
@section('script')
<script>
  $('#select-all').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  } else {
      $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});
</script>

@endsection
@section('order')
     class="active"
@endsection
