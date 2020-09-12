<?php
    use Carbon\Carbon;
?>
@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Đơn Hàng Khách đặt
      </div>
      <?php
    //   $message = Session::get('message');
    //   if($message){
    //       echo $message;
    //       Session::put('message',null);
    //   }
  ?>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">                 
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <form action="{{ URL::to('/tim-kiem-admin') }}" method="POST">
            {{ csrf_field() }}
          <div class="input-group">
            <input type="text" name="search" class="input-sm form-control">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit" name="submit">Tìm</button>
            </span>
          </div>
        </form>
        </div>
      </div>
      <div class="table-responsive">
        <form action="{{ URL::to('/destroy-order') }}" method="get">
        <table class="table table-striped b-t b-light table-hover "style="border:1px solid #eae6e6">
          <thead>
            <tr >
              <th style="text-align:center"><input type="checkbox" name="select-all"  id="select-all"/></th>
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
           @foreach ($product_order as $product) 
                                                    {{--Product tự đặt --}}
            {{-- $all_Product là all_Product DÒNG 20 bên controller Product --}}
                <tr>
                  <td style="text-align:center"><input type="checkbox" value="{{ $product->orderid }}" name="orderid[]"></td>
              <td  style="text-align:center">{{$product->cusid}}</td>  {{--ID--}}
                    {{--Product dòng 43 || category_name là tên cột trong csld   --}}
              <td  style="text-align:center">{{$product->productname}}
                <a href="{{ URL::to('/thong-tin-don-hang/'.$product->orderid)}}"><p>chi tiết</p></a>
              </td>  {{--sản phẩm --}}
              <td style="text-align:center">  {{$product->cusname}}</td> {{--họ tên khách  --}}
              <td style="text-align:center"><img src="public/upload/{{$product->image}}"width=80 height=110 alt=""></td>{{--  hình--}}
              <td style="text-align:center">  {{Carbon::createFromFormat('Y-m-d H:i:s', $product->order_date)->format('d/m/yy | H:i:s')}}</td>
              <td style="text-align:center">  {{number_format($product->total)}}.VNĐ</td> {{--  Gía --}}
              @if ($product->status==1)
              <td style="text-align:center;background:#bbecc457"> 
                  <a href="{{ URL::to('/update-status-1/'.$product->orderid) }}" style="color:green;">Đã Giao Xong</a>
                  ||
                  <a href="{{ URL::to('/delete-status-1/'.$product->orderid) }}" style="color:red">Xóa</a>
              @else
              <td style="text-align:center;background:#f0bcb470;"> 
                  <a href="{{ URL::to('/update-status-0/'.$product->orderid) }}" style="color:red">Đang Xử Lý</a>
              @endif</td> {{-- trạng thái --}}
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