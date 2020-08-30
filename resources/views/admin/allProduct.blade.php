@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Sản Phẩm
      </div>
      <?php
      // $message = Session::get('message');
      // if($message){
      //     echo $message;
      //     Session::put('message',null);
      // }
       ?>
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
              <button class="btn btn-sm btn-default" type="submit" name="submit">Tìm</button>
            </span>
          </div>
        </form>
        </div>
      </div>
      <div class="table-responsive ">
        <form action="{{URL::to('/destroy-product')}}" method="get">
        <table class="table table-striped table-responsive b-t b-light table-hover">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" name="select-all"  id="select-all"/></th>
              <th style="text-align:center">Mã Hàng</th>
              <th style="text-align:center">Sản Phẩm</th>
              <th style="text-align:center">Danh Mục</th>
              <th style="text-align:center">Chất Liệu</th>
              <th style="text-align:center">Hình Ảnh</th>
              <th style="text-align:center">Gía</th>
              <th style="text-align:center">Gía KM</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($all_Productt as $product) 
                                                    {{--Product tự đặt --}}
            {{-- $all_Product là all_Product DÒNG 20 bên controller Product --}}
            <tr>
                    {{--Product dòng 43 || category_name là tên cột trong csld   --}}
              <td style="text-align:center"><input type="checkbox" value="{{ $product->product_id }}" name="product[]"></></td>
              <input type="hidden" name="slug[]" value="{{ $product->meta_slug }}">
              <td style="text-align:center">{{$product->brandcode_id}}</td>  {{--Mã Hàng --}}
              <td style="text-align:center">{{$product->product_Name}}</td> {{--Sản Phẩm  --}}
              <td style="text-align:center">{{$product->category_name}}</td>{{--  danh mục--}}
              <td style="text-align:center">{{$product->product_material}}</td>{{--  Chất Liệu--}}
              <td style="text-align:center"><img src="public/upload/{{ $product->product_image }}" width=80 height=110></td> {{--hình  --}}
              <td style="text-align:center">{{number_format($product->product_price)}}.VNĐ</td> {{-- Gía --}}
              <td style="text-align:center">{{number_format($product->product_price_promotion)}}.VNĐ</td> {{-- Gía --}}
              {{-- SỬA / XÓA --}}
              <td> 
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                  <a href="{{URL::to('/delete-product/'.$product->product_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
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
              {!! $all_Productt->links() !!}
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
@section('product')
     class="active"
@endsection