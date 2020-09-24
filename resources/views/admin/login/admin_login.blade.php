<head>
<title>Đăng Nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{{asset('public/admin/css/bootstrap.min.css')}}" >
<link href="{{asset('public/admin/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/admin/css/style-responsive.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{asset('public/admin/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/admin/css/font-awesome.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public/admin/css/morris.css')}}" type="text/css"/>
<script src="{{asset('public/admin/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/admin/js/raphael-min.js')}}"></script>
<script src="{{asset('public/admin/js/morris.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
    <h2>Đăng Nhập</h2>
    <form action="{{URL::to('/admin-quanly')}}" method="post">
        {{--BẢO MẬT HƠN, token --}}{{ csrf_field() }}
        <input type="text" class="ggg" name="Email" placeholder="Tên Đăng Nhập" required="">
        <input type="password" class="ggg" name="Password" placeholder="Mật Khẩu..." required="">
        <h6><a href="{{ URL::to('/quen-mat-khau') }}">Quên Mật Khẩu?</a></h6>
            <div class="clearfix"></div>
            <input type="submit" value="Đặng NHập" name="login">
    </form>
</div>
</div>
<script src="{{asset('public/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/admin/js/scripts.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/client/ckeditor/ckeditor.js')}}"></script>
</body>
</html>
