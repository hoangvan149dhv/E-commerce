<?php
    use Carbon\Carbon;
?>
@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Bài Viết
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
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light table-hover "style="border:1px solid #eae6e6">
          <thead>
            <tr >
              <th style="text-align:center">ID</th>
              <th style="text-align:center">Tiêu đề</th>
              <th style="text-align:center">Trích Dẫn</th>
              <th style="text-align:center">Hình Ảnh</th>
              <th style="text-align:center"></th>
              {{-- <th style="text-align:center">Nội dung</th> --}}
            </tr>
          </thead>
          <tbody>
           @foreach ($newsadminModel as $news) 
                                                    {{--Product tự đặt --}}
            {{-- $all_Product là all_Product DÒNG 20 bên controller Product --}}
                <tr>
                  <td  style="text-align:center">{{$news->news_id}}</td>  {{--ID--}}
                    {{--Product dòng 43 || category_name là tên cột trong csld   --}}
              <td  style="text-align:center"><a href="{{ URL::to('/chi-tiet-bai-viet/'.$news->news_id)}}">{{$news->news_title}}</a> </td>  {{--tiêu đề --}}
               <td style="text-align:center">  {{$news->news_desc}}</td> {{--trích dẫn  --}}
              <td style="text-align:center"><img src="public/upload/{{$news->news_image}}"width=80 height=110 alt=""></td>{{--  hình--}}
                              {{-- SỬA / XÓA --}}
              <td> 
                <a href="{{URL::to('/edit-news/'.$news->news_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>||
                    <a href="{{URL::to('/delete-news/'.$news->news_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
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
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $newsadminModel->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
@section('news')
     class="active"
@endsection