<!--header-->
<div class="header-middle" style="background:#fafafa;">
    <!--header-middle-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo pull-left">
                    <a href="{{ URL::to('/') }}"><img src="{{asset('public/upload/logo2.png')}}" alt=""/></a>
                </div>
                <div class="btn-group pull-right"></div>
            </div>
            <div class="col-sm-8">
                <div class="shop-menu pull-right">
                    <ul class="nav navbar-nav">
                        <li><a href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i> Lịch sử
                                mua hàng</a></li>
                        <li><a href="{{URL::to('/hien-thi-gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                <?php
                                $amount_cart = Cart::content()->count();
                                echo empty($amount_cart) ? '' : "(" . $amount_cart . ")";
                                ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/header-middle-->
<div class="header-bottom">
    <!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" style="float:left" data-toggle="collapse"
                            data-target=".navbar-collapse">
                        <span class="sr-only">navigation(menu)</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                        <li class="dropdowna"><a style="cursor: pointer;"><i class="fa-icon fa fa-chevron-down"></i> Bộ
                                sưu tập</a>
                            <ul role="menu" class="sub-menu-cate">
                                @foreach ($category_product as $cate)
                                    <li>
                                        <a href="{{ URL::to('/Danh-muc-san-pham/'.$cate->category_id)}}">{{"- ". $cate->category_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown"><a style="cursor: pointer;"><i class="fa-icon fa fa-chevron-down"></i> Vải
                                áo dài sunny</a>
                            <ul class="sub-menu">
                                @foreach ($brand_code_product as $brand_code)
                                    <li>
                                        <a href="{{URL::to('/thuong-hieu/'.$brand_code->code_id)}}">{{"- ". $brand_code->brandcode_name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ url::to('/khuyen-mai') }}"> Khuyễn mãi</a></li>
                        <li><a href="{{ url::to('/tin-tuc-chia-se')}}">Tin tức</a></li>
                        <li><a href="{{ url::to('/lien-he') }}">Liên Hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <form action="{{URL::to('/tim-kiem')}}" method="GET" style="margin-bottom:0px">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="search" placeholder="Tìm kiếm" name="search"/>
                            <span class="input-group-btn">
								<button name="submit" class="fa fa-search btn btn-sm btn_search_product"></button>
							</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="icon-bar-menu">
        <a class="active" href="{{ URL('/') }}"><i class="fa fa-home"></i></a>
        <a href="tel:@foreach ($contactinfoModel as $contact) {{ $contact->info_contact_phone }} @endforeach">
            <i class="fa fa-phone"></i></a>
        <a href="{{URL::to('/hien-thi-gio-hang')}}">
            <i class="fa fa-shopping-cart">
                <?php
                    echo empty($amount_cart) ? '' : "(" . $amount_cart . ")";
                ?>
            </i>
        </a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i></a>
    </div>
</div>
<!--/header-bottom-->
