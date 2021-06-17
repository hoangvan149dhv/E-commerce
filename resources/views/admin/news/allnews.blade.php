<?php
    use Carbon\Carbon;
?>
@extends('admin.index')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Bài Viết
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
            </tr>
          </thead>
          <tbody>
           @foreach ($newsadminModel as $news)
            <tr>
              <td  style="text-align:center">{{$news->news_id}}</td>
              <td  style="text-align:center"><a href="{{ URL::to('/admin/chi-tiet-bai-viet/'.$news->news_id)}}">{{$news->news_title}}</a> </td>
              <td style="text-align:center">  {{$news->news_desc}}</td> {{--trích dẫn  --}}
              <td style="text-align:center"><img src="{{asset('public/upload/'.$news->news_image)}}"width=80 height=110 alt=""></td>
              <td>
                  <a href="{{URL::to('/admin/edit-news/'.$news->news_id)}}"style='color:green;font-size:20px' class="active" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>||
                    <a href="{{URL::to('/admin/delete-news/'.$news->news_id)}}" style='color:red;font-size:20px'class="active" ui-toggle-class="">
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
