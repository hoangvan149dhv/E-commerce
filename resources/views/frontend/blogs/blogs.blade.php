<?php use Carbon\Carbon;?>
@extends('frontend.index')
@section('schema_structure_article_data')
    ,{
        "@type": "Article",
        "headline": "{{'Góc chia sẻ - ' .config('config_admin.site_name') ?? config('config_admin.site_name') }}",
        "author": {
            "@type": "Person",
            "name": "{{config('config_admin.site_name')}}"
        },
        "description": "{{ $meta_desc ?? '' }}",
        "@id": "{{URL::to('/')}}/#schema",
        "isPartOf": {
            "@id": "{{URL::to('/')}}/#webpage"
        },
        "publisher": {
            "@id": "{{URL::to('/')}}/#organization"
        },
        "inLanguage": "vi",
        "mainEntityOfPage": {
            "@id": "{{URL::to('/')}}/#webpage"
        }
    }
@endsection
@section('content')
    <div class="col-sm-11">
        <div class="blog-post-area">
            <h2 class="title text-center" style="margin-bottom:15px;">Tin tức - chia sẻ</h2>
            <section class="ftco-section">
                <div class="container">
                    <div class="row d-flex">
                        @foreach ($newsadminModel as $news)
                        <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                            <div class="blog-entry d-md-flex">
                                <a href="{{ URL::to('/tin-tuc-chia-se/'.$news->meta_slug) }}" class="block-20 img" style="background-image: url({{asset('public/upload/'.$news->news_image ) ?? ''}})">
                                </a>
                                <div class="text p-4 bg-light">
                                    <div class="meta">
                                        <p><span class="fa fa-calendar"></span> {{Carbon::createFromFormat('Y-m-d H:i:s',  $news->updated_at)->format('d/m/yy') }}</p>
                                    </div>
                                    <h3 class="heading mb-3"><a href="{{ URL::to('/tin-tuc-chia-se/'.$news->meta_slug) }}">{{ $news->news_title }}</a></h3>
                                    <p>{{ $news->news_desc }}</p>
                                    <a href="{{ URL::to('/tin-tuc-chia-se/'.$news->meta_slug) }}" class="btn-custom">Xem thêm <span class="fa fa-long-arrow-right"></span></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li>{!! $newsadminModel->links() !!}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Liên hệ <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Góc chia sẻ</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        //
    </script>
@endsection
