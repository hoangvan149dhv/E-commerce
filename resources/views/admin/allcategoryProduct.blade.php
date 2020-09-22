@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Danh Mục
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
        </div>
      </div>
      <div class="table-responsive">
        <form action="{{URL::to('/destroy')}}" method="get">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;"></th>
              <th>Tên Danh Mục</th>
              <th>Hiển Thị</th>
              <th style="width:100px;"></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($allcategory_Productt as $cate_Product)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" value="{{ $cate_Product->category_id }}" name="category[]"></label></td>
              <td>{{$cate_Product->category_name}}</td>
                    {{--$cate_Product dòng 43 || category_name là tên cột trong csld   --}}
              <td><span class="text-ellipsis">
                  <?php
                      if($cate_Product->category_status==0){?>
                        <a href=" {{URL::to('/active/'.$cate_Product->category_id)}}"><span class='fa fa-eye'style='color:green;font-size:20px'>||Hiện</span></a>
                      <?php }else{ ?>
                        <a href=" {{URL::to('/unactive/'.$cate_Product->category_id)}}"><span class="fa fa-eye-slash" style='color:red;font-size:20px'>||Ẩn</span></a>
                     <?php }
                    ?>
              </span></td>
              <td>
                <a href="{{URL::to('/edit-category-product/'.$cate_Product->category_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                  <a href="{{URL::to('/delete-category-product/'.$cate_Product->category_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
            <tr><td><button class="btn btn-danger" type="submit">Xóa</button></td></tr>
          </tbody>
        </table>
      </form>
      </div>
    </div>
  </div>
@endsection
@section('cate')
     class="active"
@endsection
