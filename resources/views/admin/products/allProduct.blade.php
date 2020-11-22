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
              <th style="text-align:center">Sản Phẩm</th>
              <th style="text-align:center">Mã Hàng</th>
              <th style="text-align:center">Danh Mục</th>
              <th style="text-align:center">Chất Liệu</th>
              <th style="text-align:center">Hình Ảnh</th>
              <th style="text-align:center">Gía</th>
              <th style="text-align:center">Gía KM</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($all_Product as $product)
            <tr>
              <td style="text-align:center"><input type="checkbox" value="{{ $product->product_id }}" name="product[]"></td>
              <td style="text-align:center"><a href="{{URL::to('/edit-product/'.$product->product_id)}}">{{$product->product_Name}}</a></td>
              <td style="text-align:center">{{$product->brandcode_id}}</td>
              <td style="text-align:center">{{$product->category_name}}</td>
              <td style="text-align:center">{{$product->product_material}}</td>
              <td style="text-align:center"><a href="{{URL::to('/edit-product/'.$product->product_id)}}"><img src="public/upload/{{ $product->product_image }}" width=80 height=110></a></td>
              <td style="text-align:center">{{number_format($product->product_price)}}.VNĐ</td>
              <td style="text-align:center">{{number_format($product->product_price_promotion)}}.VNĐ</td>
              <td>
                <?php if($product->pushlish == 1):?>
                <a href="{{URL::to('/check-pushlish-product/'.$product->product_id.'/'.$product->pushlish)}}"class="active" ui-toggle-class="">
                  <i class="fa fa-check-circle text-success text-active"></i>
                </a>
                <?php else : ?>
                <a href="{{URL::to('/check-pushlish-product/'.$product->product_id.'/'.$product->pushlish)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-times-circle text-danger text-active"></i>
                </a>
                <?php endif ?>
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
              {!! $all_Product->links() !!}
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
