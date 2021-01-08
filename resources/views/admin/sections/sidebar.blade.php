<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <!-- Dashboard -->
                <li>
                    <a @yield('dashboard') href="{{URL::to('/admin-quanly')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <!-- Dashboard -->
                <!-- Order -->
                <li class="sub-menu">
                    <a  @yield('order') href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Đơn Hàng (<?php
                            use App\Http\Model\OrderModel;
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
                <!-- /Order -->

                <!-- Categories -->
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
                <!-- /Categories -->

                <!-- Brands -->
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
                <!-- /Brands -->

                <!-- Products -->
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
                <!-- /Products -->

                <!-- BLog -->
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
                <!-- /BLog -->
                <!-- Slider -->
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
                <!-- /Slider -->
                <!-- Contact -->
                <li>
                    <a href="{{URL::to('/them-thong-tin')}}"><i class="fa fa-user"></i>thông tin liên hệ</a>
                </li>
                <!-- /Contact -->

                <!-- Delivery -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bicycle"></i>
                        <span>Phí Giao Hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-delivery')}}">Thêm phí giao hàng</a></li>
                    </ul>
                </li>
                <!-- /Delivery -->

                <!-- Dump database -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <form class="abc" action="{{ URL::to('our_backup_database') }}" method="get">
                            <button onclick="checkConditiondumpDatabase()" style="background: #337ab700;border-color:#337ab700" class="btn btn-primary"> Dump database</button>
                        </form>
                    </a>
                </li>
                <!-- /Dump database -->
                <!-- Clear cache -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <form class="abc" action="{{ URL::to('/clear-cache') }}" method="get">
                            <button onclick="alert('Clear cache thành công')" style="background: #337ab700;border-color:#337ab700" class="btn btn-primary"> Xóa bộ nhớ đệm</button>
                        </form>
                    </a>
                </li>
                <!-- /Clear cache -->
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
