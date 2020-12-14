<!DOCTYPE html>
<html lang="en">
@include('admin.sections.head')
<body>
<section id="container">
<header class="header fixed-top clearfix">
<div class="brand">
    <a href="index.html" class="logo">
        Điều khiển
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                 <i class="fa fa-bell-o"></i>
                 <span class="badge bg-success">
                    <?php
                        use App\Http\Model\ReviewModel;
                        $alertt = ReviewModel::all()->where('status',0)->count();
                        echo $alertt;
                    ?>
                </span>
                <ul class="dropdown-menu extended inbox">
                    <li>
                        <a href="{{ URL::to('reviews') }}">
                            <p class="red">Bạn Có {{$alertt }}
                                <span style="color:red">
                                </span>Đánh giá
                            </p>
                        </a>
                    </li>
                </ul>
            </a>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->

        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">
                <?php
                    use App\Http\Model\contactModel;
                    $alert = contactModel::all()->where('status',0)->count();
                    echo $alert;
                ?>
                </span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <a href="{{ URL::to('contact') }}"><p class="red">Bạn Có {{$alert }} <span style="color:red">
                    </span>Góp Ý</p></a>
                </li>
                <li>
                </li>
            </ul>
        </li>
        <li id="header_inbox_bar">
            <a  class="dropdown-toggle" target="_blank" href="{{ URL::to('/') }}"><i class="fa fa-globe"></i></a>
        </li>
        @yield('preview_product')
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <form action="{{ URL::to('/search-order') }}" method="POST">
            {{ csrf_field() }}
            <li>
                <input type="text" name="search" class="form-control search" placeholder=" Search">
            </li>
            </form>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/upload/561d1b934c1cb442ed0d25.jpg')}}">
                <span class="username">
                        {!! $name =Session::get('admin_name'); !!}
                        @isset($name)@endif
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thông Tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài Đặt</a></li>
            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a @yield('dashboard') href="{{URL::to('/admin-quanly')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Tổng quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a  @yield('order') href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Đơn Hàng (<?php

                            $order_status_notcomplete = OrderModel::all()->where('status', 0)->count();
                            echo $order_status_notcomplete;
                            ?>)
                        </span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/admin-quanly-donhang/tong-don-hang')}}">Tổng đơn hàng</a></li>
                        <li><a href="{{URL::to('/admin-quanly-donhang/0')}}">Đơn hàng chưa hoàn thành</a></li>
                        <li><a href="{{URL::to('/admin-quanly-donhang/1')}}">Đơn hàng đã giao xong</a></li>
                        </ul>
                </li>

                <li class="sub-menu">
                    <a @yield('cate') href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/addCategoryProduct')}}">Thêm Danh Mục Sản Phẩm</a></li>
                    <li><a href="{{URL::to('/allCategoryProduct')}}">Liệt Kê Danh Mục Sản Phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @yield('brand') href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Mã Hàng (Thương Hiệu)</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/add-Brand-code-Product')}}">Thêm Mã Thương Hiệu</a></li>
                    <li><a href="{{URL::to('/all-Brand-code-Product')}}">Liệt Kê Mã Thương Hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @yield('product') href="javascript:;">
                        <i class="fa  fa-barcode"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/add-Product')}}">Thêm Sản Phẩm</a></li>
                    <li><a href="{{URL::to('/all-Product')}}">Liệt Kê Sản Phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @yield('news') href="javascript:;">
                        <i class="fa fa-pencil-square"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/add-news')}}">Thêm Bài Viết</a></li>
                    <li><a href="{{URL::to('/all-news')}}">Liệt Kê Bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a @yield('slider') href="javascript:;">
                        <i class="fa  fa-align-justify"></i>
                        <span>Slider quảng cáo</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                    <li><a href="{{URL::to('/all-slider')}}">Liệt Kê Slider</a></li>
                    </ul>
                </li>
                 <li><a href="{{URL::to('/them-thong-tin')}}"><i class="fa fa-user"></i>thông tin liên hệ</a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bicycle"></i>
                        <span>Phí Giao Hàng</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{URL::to('/add-delivery')}}">Thêm phí giao hàng</a></li>
                    </ul>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <form class="abc" action="{{ URL::to('our_backup_database') }}" method="get">
                            <button onclick="checkConditiondumpDatabase()" style="background: #337ab700;border-color:#337ab700" class="btn btn-primary"> Dump database</button>
                        </form>
                    </a>
                </li>
                <li class="sub-menu">
                    <a @yield('mail') href="javascript:;">
                        <i class="fa fa-folder-open"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/mail-config')}}">Cấu hình Email</a></li>
                        <li><a href="{{URL::to('/template-mail-config')}}">Tạo giao diện Email</a></li>
                        <li><a href="{{URL::to('/all-template-mail')}}">Danh sách Email</a></li>
                        <li><a href="{{URL::to('/template-mail')}}">Giao diện mail đang sử dụng</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
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
