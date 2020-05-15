<?php
    use Carbon\Carbon;
?>
@extends('layout')   {{-- "triệu gọi trang layout như include"  LƯU Ý:TRONG LARAVEL ĐẶT FILE PHẢI CÓ .BLADE.PHP --}}
        {{-- GỌI folder routes/web.php dòng 15 --}}
@Section('content')  {{--Đặt 'content bên trang welcome.blade.php dòng 355' --}}
<div class="col-sm-11">
    <div class="blog-post-area">
        <h2 class="title text-center" style="margin-bottom:15px;">Tin tức-chia sẻ</h2>{{-- Tiêu đề --}}
        @foreach ($newsadminModel as $news)
        <div class="single-blog-post">
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-calendar"></i>{{Carbon::createFromFormat('Y-m-d H:i:s',  $news->updated_at)->format('d/m/yy') }}</li>
                </ul>
            </div>
            <div clas="content col-sm-12" >
                <div class="row" style="padding-bottom:20px">
                    <div class="col-sm-3 news">
                        <a href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}">
                            <img src="public/upload/{{  $news->news_image }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <a href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}"><h3>{{ $news->news_title }}</h3></a>{{-- Mô tả Ngắn --}}
                        <p>{{ $news->news_desc }}</p>
                        <p><a  class="btn btn-primary" href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}">Xem Thêm</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border" style="border-bottom:height: 260px;
        border-bottom: 2px dashed #999;" >
        </div>
        @endforeach
        <div class="pagination-area text-center">
            <ul class="pagination " >
                <li>{!! $newsadminModel->links() !!}</li>
            </ul>
        </div>
    </div>
</div>  
@endsection 