<?php
    // use Carbon\Carbon;
?>
@extends('admin.admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông Tin Bài Viết
      </div>
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
    </div>
</div>
@endsection
@section('news')
     class="active"
@endsection
