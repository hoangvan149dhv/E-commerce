<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">
                    <?php
                    use App\Http\Model\ReviewModel;
                    $alertt = ReviewModel::all()->where('status',0)->count();
                    echo $alertt;
                    ?>
                </span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class=""></p>
                </li>
                <li>
                    <a href="{{URL::to('/admin/reviews')}}">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                Bạn Có {{$alertt }} Đánh giá
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
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
                    <p></p>
                </li>
                <li>
                    <a href="{{ URL::to('/admin/contact') }}"><p class="red">Bạn Có {{$alert }} <span style="color:red">
                    </span>Góp Ý</p></a>
                </li>
                <li>
                </li>
            </ul>
        </li>
        <li id="header_inbox_bar">
            <a  class="dropdown-toggle" target="_blank" href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-new-window"></span></a>
        </li>
        @yield('preview_product')
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        {{--<li id="header_notification_bar" class="dropdown">
            <form action="{{ URL::to('/admin/search-order') }}" method="POST">
                {{ csrf_field() }}
                <li>
                    <input type="text" name="search" class="form-control search" placeholder=" Search">
                </li>
            </form>
        </li>--}}
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
                <li><a href="{{URL::to('/admin/admin-config')}}"><i class="fa fa-cog"></i> Cấu Hình Website</a></li>
            <li><a href="{{URL::to('/admin/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
