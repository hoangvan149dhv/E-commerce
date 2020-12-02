@extends('admin.index')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Danh Mục
      </div>
      <?php
      $message = Session::get('success');
      if($message){?>
        <div class="alert-success alert">
        <?php echo $message; ?></div>
        <?php
          Session::put('success',null);
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
        <form action="{{URL::to('/destroy-slider')}}" method="get">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;"></th>
              <th>Hình ảnh</th>
              <th>Hiển Thị</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($slider_all as $slider)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" value="{{ $slider->id }}" name="slider[]"></label></td>
              <td><img src="public/upload/{{$slider->img}}" width="80" height="120" alt=""></td>
              <td><span class="text-ellipsis">
                  <?php
                      if($slider->status==0){?>
                        <a href=" {{URL::to('/status-1/'.$slider->id)}}"><span class='fa fa-eye'style='color:green;font-size:20px'>||Hiện</span></a>
                      <?php }else{ ?>
                        <a href=" {{URL::to('/status-0/'.$slider->id)}}"><span class="fa fa-eye-slash" style='color:red;font-size:20px'>||Ẩn</span></a>
                     <?php }
                    ?>
              </span></td>
              <td>
                <a href="{{URL::to('/update-layout-slider/'.$slider->id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                  <a href="{{URL::to('/delete-layout-slider/'.$slider->id)}}" onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')"  style='color:red;font-size:20px'class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
            <tr><td><button onclick="return confirm('Bạn Muốn Xóa Sản Phẩm Này?')"  class="btn btn-danger" type="submit">Xóa</button></td></tr>
          </tbody>
        </table>
      </form>
      </div>
      <footer class="panel-footer">
        <div class="row">

        </div>
      </footer>
    </div>
  </div>
@endsection
@section('slider')
     class="active"
@endsection
