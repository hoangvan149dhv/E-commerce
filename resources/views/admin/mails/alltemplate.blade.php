@extends('admin.admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách mail đã tạo
      </div>
      <div class="table-responsive">
        <form action="{{URL::to('/destroy-template')}}" method="get">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tiêu đề</th>
              <th>Hình ảnh</th>
              <th>Hiển Thị</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($itemlisttemplateMail as $template)
            <tr>
              <td><a href="{{ URL::to('/chi-tiet-template/'.$template->id)}}"><p>{{ $template->label }}</p></a></td>
              <td><span class="text-ellipsis">
                  <?php
                      if($template->status=="Ẩn"){?>
                        <a href=" {{URL::to('/status-template/'.$template->id)}}"><span class='fa fa-eye'style='color:red;font-size:20px'>||Ẩn</span></a>
                  <?php }else{ ?>
                        <a href=" {{URL::to('/status-template/'.$template->id)}}"><span class="fa fa-eye-slash" style='color:green;font-size:20px'>||Hiện</span></a>
                  <?php }?>
              </span></td>
              <td>
                <a href="{{URL::to('/chi-tiet-template/'.$template->id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>||
                  <a href="{{URL::to('/delete-layout-template/'.$template->id)}}" onclick="return confirm('Bạn Muốn Xóa template này?')"  style='color:red;font-size:20px'class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       </form>
      </div>
    </div>
  </div>
@endsection
@section('mail')
     class="active"
@endsection
