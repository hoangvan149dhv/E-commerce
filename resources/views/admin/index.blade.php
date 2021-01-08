<!DOCTYPE html>
<html lang="en">
@include('admin.sections.head')
<body>
<section id="container">
<header class="header fixed-top clearfix">
<div class="brand">
    <a href="{{URL::to('/admin-quanly')}}" class="logo">
        Sunny Ngo
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
@include('admin.sections.topmenu')
</header>
<!--header end-->
<!--sidebar start-->
@include('admin.sections.sidebar')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
            @yield('content')
		<div class="agileits-w3layouts-stats">
            <div class="clearfix"> </div>
		</div>
</section>
@include('admin.sections.footer')
</section>
<!--main content end-->
</section>
@include('admin.libraries.script')
@yield('script')
</body>
</html>
