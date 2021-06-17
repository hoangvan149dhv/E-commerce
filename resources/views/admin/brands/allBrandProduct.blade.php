@extends('admin.index')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi Tiết Mã Hàng (Thương Hiệu)
      </div>
      <?php
      $message = Session::get('messagees');
      if($message){
          echo $message;
          Session::put('messagees',null);
      }
      ?>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Mã Sản Phẩm</th>
              <th>Tên Thương Hiệu</th>
              <th style="width:120px;">Trạng Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($allBrandcode_Productt as $Brandcode_Product)
              <td>{{$Brandcode_Product->brandcode_id}}</td>
              <td>{{$Brandcode_Product->brandcode_name}}</td>
              <td>
                <a href="{{URL::to('/admin/edit-brand-code-product/'.$Brandcode_Product->code_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                <a href="{{URL::to('/admin/delete-brand-code-product/'.$Brandcode_Product->code_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('brand')
     class="active"
@endsection
