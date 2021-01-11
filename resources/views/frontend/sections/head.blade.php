<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('config_admin.site_name') .  '  -  ' .$meta_title ?? config('config_admin.site_name') }}</title>
    @if(config('config_admin.SEO'))
<meta name="author" content="{{URL::to('/')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="{{$meta_Robots ?? ''}}"/>
	<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
	<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="description" content="{{ $meta_desc ?? '' }}">
    <meta name="keywords" content="{{ $meta_keyword ?? '' }}"/>
    <meta name="og:image:type" property="og:image:type" content="image/jpg">
    <meta name="og:image:height" property="og:image:height" content="900">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="{{config('config_admin.site_name') .  '  -  ' .$meta_title ?? config('config_admin.site_name')}}"/>
    <meta property="og:title" content="{{config('config_admin.site_name') .  '  -  ' .$meta_title ?? config('config_admin.site_name')}}"/>
    <meta property="og:description" content="{{ $meta_desc ?? '' }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ $url_canonical ?? '' }}"/>
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image" href="{{ asset('public/upload/logo2.png') }}">
    <link rel="canonical" href="{{ $url_canonical ?? '' }}"/>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph":[
                    {
                        "@type": [
                            "ClothingStore",
                            "Organization"
                        ],
                        "@id": "{{URL::to('/')}}/#organization",
                        "name": "{{config('config_admin.site_name')}}",
                        "url": "{{URL::to('/')}}",
                        "email": "@foreach ($contactinfoModel as $contact) {{ $contact->info_contact_mail }} @endforeach",
                        "address": {
                            "@type": "PostalAddress",
                            "streetAddress": "{{ $contact->info_contact_add }}",
                            "addressLocality": "{{ $contact->info_contact_add }}",
                            "addressRegion": "Hồ Chí Minh",
                            "postalCode": "700000",
                            "addressCountry": "Viet Nam"
                        },
                        "logo": {
                            "@type": "ImageObject",
                            "url": "{{ asset('public/upload/logo2.png') }}"
                        },
                        "openingHours": [
                            "Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday 09:00-22:00"
                        ],
                        "image": {
                            "@type": "ImageObject",
                            "url": "{{ asset('public/upload/logo2.png') }}"
                        },
                        "telephone": "{{ $contact->info_contact_phone }}"
                    },
                    {
                        "@type": "WebSite",
                        "@id": "{{URL::to('/')}}/#website",
                        "url": "{{URL::to('/')}}",
                        "name": "{{config('config_admin.site_name')}}",
                        "publisher": {
                            "@id": "{{URL::to('/')}}/#organization"
                        },
                        "inLanguage": "vi",
                        "potentialAction": {
                            "@type": "SearchAction",
                            "target": "{{URL::to('/')}}/?s={search_term_string}",
                            "query-input": "required name=search_term_string"
                        }
                    }
                    @yield('schema_structure_article_data')
                    @yield('schema_structure_product_data')
                ]
            }
    </script>
    @yield('og:image')
    @endif
    @include('frontend.libraries.link')
</head>
