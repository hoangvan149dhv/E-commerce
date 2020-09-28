<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{asset('public/admin/css/bootstrap.min.css')}}" >
    <link href="{{asset('public/admin/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/admin/css/style-responsive.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/admin/css/font.css')}}" type="text/css"/>
    <link href="{{asset('public/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/admin/css/morris.css')}}" type="text/css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('public/admin/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/admin/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/admin/js/morris.js')}}"></script>
</head>
<body>
    @yield('content')
<script src="{{asset('public/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/admin/js/scripts.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/client/ckeditor/ckeditor.js')}}"></script>
</body>
</html>
