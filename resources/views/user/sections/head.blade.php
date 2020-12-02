<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title>{{$meta_title ?? 'Trang chủ' }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="{{$meta_Robots ?? ''}}"/>
    <meta property="og:image" content="{{ asset('public/upload/qc2.png') }}"/>
    <meta property="og:site_name" content="{{$url_canonical ?? ''}}"/>
    <meta name="description" content="{{ $meta_desc ?? '' }}">
    <meta name="keywords" content="{{ $meta_keyword ?? '' }}"/>
    <meta property="og:title" content="{{ $meta_title ?? '' }}"/>
    <meta property="og:description" content="{{ $meta_desc ?? '' }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ $url_canonical ?? '' }}"/>
    <link rel="icon" type="image" href="">
    <link rel="canonical" href="{{ $url_canonical ?? '' }}"/>
    @include('user.libraries.link')
</head>
