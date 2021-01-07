<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title>{{$meta_title ?? 'Trang chủ' }}</title>
    @if(config('config_admin.SEO'))
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="{{$meta_Robots ?? ''}}"/>
    <meta name="description" content="{{ $meta_desc ?? '' }}">
    <meta name="keywords" content="{{ $meta_keyword ?? '' }}"/>
    <meta name="og:image:type" property="og:image:type" content="image/jpeg">
    <meta name="og:image:height" property="og:image:height" content="900">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="{{$url_canonical ?? ''}}"/>
    <meta property="og:title" content="{{ $meta_title ?? '' }}"/>
    <meta property="og:description" content="{{ $meta_desc ?? '' }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ $url_canonical ?? '' }}"/>
    <meta name="theme-color" content="#ffffff">
    <meta property="og:image:alt" content="{{ $meta_title ?? '' }}" />
    <link rel="icon" type="image" href="">
    <link rel="canonical" href="{{ $url_canonical ?? '' }}"/>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
                @yield('schema_structure_product_data')
        }
    </script>
    @yield('og:image')
    @endif
    @include('frontend.libraries.link')
</head>
