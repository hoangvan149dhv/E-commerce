@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
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
          {{-- <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                 --}}
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          {{-- <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div> --}}
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              {{-- <th style="width:20px;">
              </th> --}}
              <th>Mã Sản Phẩm</th>
              <th>Tên Thương Hiệu</th>
              <th style="width:120px;">Trạng Thái</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($allBrandcode_Productt as $Brandcode_Product)  {{-- BÀI 13 --}}
                                                    {{-- $cate_Product tự đặt --}}
            {{-- $allcategory_Product là allcategory_Product DÒNG 20 bên controller CategoryProduct --}}
                
            
            <tr>
              {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post"><i></i></label></td> --}}
              <td>{{$Brandcode_Product->brandcode_id}}</td>
              <td>{{$Brandcode_Product->brandcode_name}}</td>
              <td>
                <a href="{{URL::to('/edit-brand-code-product/'.$Brandcode_Product->code_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                <a href="{{URL::to('/delete-brand-code-product/'.$Brandcode_Product->code_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
@section('brand')
     class="active"
@endsection