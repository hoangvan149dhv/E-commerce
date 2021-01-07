<?php

use Carbon\Carbon;

?>
@section('og:image')
    @isset($newsadminModel)
        <meta property="og:image" content="{{URL::to('/public/upload/'.$newsadminModel->news_image)}}"/>
    @endisset
@endsection
@extends('frontend.index')
@Section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate blog">
                <h2>{{ $newsadminModel->news_title }}</h2>
                <div class="text-right">
                    <i class="fa fa-calendar"></i>{{Carbon::createFromFormat('Y-m-d H:i:s',  $newsadminModel->updated_at)->format('d/m/yy') }}
                </div>
                <p>
                    <img src="{{asset('public/upload/'.$newsadminModel->news_image)}}" class="img-fluid" alt="">
                </p>
                <div class="ftco-animate" style="text-align:justify">
                    <p>{!! $newsadminModel->news_content !!}</p>
                </div>
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="fa fa-search"></span>
                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                        </div>
                    </form>
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3>Bài viết gần đây</h3>
                    @foreach ($news_details as $news)
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}" style="background-image: url({{asset('public/upload/'.$news->news_image)}});"></a>
                            <div class="text">
                                <h3 class="heading">
                                    <a href="{{ URL::to('/tin-tuc-chia-se/'.$news->news_id) }}">{{ $newsadminModel->news_title }}</a>
                                </h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span>{{Carbon::createFromFormat('Y-m-d H:i:s',  $newsadminModel->updated_at)->format('d/m/yy') }}</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/'.$newsadminModel->news_image)}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-2">
                            <a href="{{ URL::to('/') }}">Trang chủ <i class="fa fa-chevron-right"></i></a>
                        </span>
                        <span><a href="{{ URL::to('/tin-tuc-chia-se') }}">Góc chia sẻ <i class="fa fa-chevron-right"></i></a><i class="fa fa-chevron-right"></i></span>
                        <span>{{ $newsadminModel->news_title }} <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h2 class="mb-0 bread">{{ $newsadminModel->news_title }}</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
