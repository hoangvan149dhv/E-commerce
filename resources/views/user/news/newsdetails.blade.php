<?php

use Carbon\Carbon;

?>
@section('og:image')
    @isset($newsadminModel)
        <meta property="og:image"
              content="http://vanduong.com.web3.redhost.vn/public/upload/{{ $newsadminModel->news_image}}"/>
    @endisset
@endsection
@extends('user.index')
@Section('content')
    <div class="col-sm-12" style="border-right:1px solid #e8e8e2;border-left:1px solid #e8e8e2">
        <div class="blog-post-area">
            <h2 class="title text-center">Tin tức-chia sẻ</h2>
            <div class="single-blog-post">
                <h2>{{ $newsadminModel->news_title }}</h2>
                <div class="post-meta">
                    <ul>
                        <li>
                            <i class="fa fa-calendar"></i>{{Carbon::createFromFormat('Y-m-d H:i:s',  $newsadminModel->updated_at)->format('d/m/yy') }}
                        </li>
                    </ul>
                </div>
                <div clas="content col-sm-12">
                    <div class="row" style="padding-bottom:20px">
                        <div class="col-sm-12">
                            <img src="{{asset('public/upload/'.$newsadminModel->news_image)}}" alt="">
                        </div>
                        <div class="col-sm-12" style="text-align:justify">
                            <p>{!! $newsadminModel->news_content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border"
                 style="height: 260px;border-bottom: 2px dashed #999;margin-bottom:25px;margin-top:20px;"></div>
            <div class="media-body">
                <h2 class="media-heading">Xem thêm:</h2>
                @foreach ($news_details as $news)
                    <a class="news-extra" href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}"><p><i
                                class="fa fa-chevron-right"> </i> {{ $news->news_title }}</p></a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
