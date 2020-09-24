<?php
    // use Carbon\Carbon;
?>
@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Bài Viết
      </div>
      <?php
  ?>

          <div class="container">
            <div class="row w3-res-tb">
            <div class="col-sm-12 m-b-xs">
                <h2 class="display-5" style="text-align:center">{{ $newsadminModel->news_title }}</h2>
            </div>
            <div class="col-sm-12 desc">
                -   {{$newsadminModel->news_desc}}
            </div>
            <div class="col-sm-12 content">
                {!! $newsadminModel->news_content !!}
            </div>
          </div>

      </div>

      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{-- {!! $newsadminModel->links() !!} --}}
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
