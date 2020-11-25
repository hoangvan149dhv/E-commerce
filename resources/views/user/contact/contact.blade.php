<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keyword }}"/>
    <meta name="author" content="">
    <title>{{ $meta_title }}</title>

    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ $url_canonical }}" />
    <link rel="icon" type="image" href="">
    <meta property="og:image" content="{{ asset('public/upload/qc2.png') }}" />
    <meta property="og:site_name" content="http://vanduong.com.web3.redhost.vn/" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url_canonical }}"/>
    <link href="{{asset('public/client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/responsive.css')}}" rel="stylesheet">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header-middle" style="background:#fafafa;">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/') }}"><img src="{{asset('public/upload/logo2.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i> Lịch sử mua hàng</a></li>
                                <li><a href="{{URL::to('/hien-thi-gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <?php
									$content_cart = Cart::content()->count();
									   if(empty($content_cart)){
										   echo "";
									   }else{
										   echo "	(".$content_cart.")";
									   }
								   ?></a></li>
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
                            <button type="button" class="navbar-toggle" style="float:left" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">navigation(menu)</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ url('/trang-chu') }}">Trang Chủ</a></li>
                                <li class="dropdowna"><a style="cursor: pointer;"><i class="fa-icon fa fa-chevron-down"></i> Bộ sưu tập</a>
                                    <ul role="menu" class="sub-menu-cate">
                                        @foreach ($category_product as $cate)
                                        <li><a href="{{ URL::to('/Danh-muc-san-pham/'.$cate->category_id)}}">{{"- ". $cate->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a style="cursor: pointer;"><i class="fa-icon fa fa-chevron-down"></i> Vải áo dài sunny</a>
                                    <ul  class="sub-menu">
                                        @foreach ($brand_code_product as $brand_code)
                                        <li><a href="{{URL::to('/thuong-hieu/'.$brand_code->code_id)}}">{{"- ". $brand_code->brandcode_name}}</a></li>
                                    @endforeach
                                    </ul>
                                </li>

                                <li><a href="{{ url::to('/khuyen-mai') }}"> Khuyễn mãi</a></li>
                                <li><a href="{{URL::to('/tin-tuc-chia-se')}}">Tin tức</a></li>
                                <li><a href="{{ url::to('/lien-he') }}">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{URL::to('/tim-kiem')}}" method="GET" style="margin-bottom:0px">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="search" style="border-top-left-radius: 20px;border-bottom-left-radius: 20px;" placeholder="Tìm kiếm" name="search" />
                                    <span class="input-group-btn">
								<button name="submit"class="fa fa-search btn btn-sm btn_search_product"></button>
							</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

        <section>
            <div class="container">
                <div class="row">
                    <div id="contact-page" class="container">
                        <div class="bg">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="title text-center">liên hệ <strong>chúng tôi</strong></h2> {{--GOOGLE MAP --}}
                                    <?php
                                        foreach ($contactinfoModel as $item => $contact) {
                                            $map = $contact->google_map;
                                            if($map == ""){
                                            }
                                            else{
                                                echo '<div id="gmap" class="contact-map">'. $map . '</div>';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row" style="margin-top:25px">
                                <div class="col-sm-7">
                                    <div class="contact-form">
                                        <h2 class="title text-center">liên hệ</h2>
                                        <div class="status alert alert-success" style="display: none"></div>
                                        <form id="main-contact-form" class="contact-form row" name="contact-form" action="{{ URL::to('/lien-he') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group col-md-6">
                                                <input data-validation="length" data-validation-length="5-70" data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="text" name="name" class="form-control" required="required" placeholder="Họ tên">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input data-validation="length" data-validation-length="5-70" data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="email" name="email" class="form-control" required="required" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <textarea data-validation="length" data-validation-length="5-1000" data-validation-error-msg='vui lòng điền 5- 1000 kí tự' name="content" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"></textarea>
                                            </div>
                                            <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                            @if($errors->has('g-recaptcha-response'))
                                            <span class="invalid-feedback" style="display:block">
                                                <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                            </span>
                                            @endif
                                            <?php
                                                $message = Session::get('success');
                                                if($message){
                                                echo "<h2 class='col-md-12' style='color:green'>".$message."</h2>";
                                                Session::put('success',null);
                                                }
                                            ?>
                                            <div class="form-group col-md-12">
                                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Xác nhận">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="contact-info">
                                        <h2 class="title text-center">Thông tin liên hệ</h2>
                                        @foreach ($contactinfoModel as $contact)
                                        <address>
                                            <p><strong> Địa chỉ:</strong> <br>{{ $contact->info_contact_add }}</p>
                                            <p><strong>SĐT: </strong><a href="tel:{{ $contact->info_contact_phone }}">{{ $contact->info_contact_phone }}</a></p>
                                            <p><strong> Email:</strong> {{ $contact->info_contact_mail }} </p>
                                         </address>
                                        @endforeach
                                        <div class="social-networks">
                                            <h2 class="title text-center"></h2>
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/#contact-page-->
                </div>
            </div>
            {{-- MENU BAR --}}
            <div class="icon-bar-menu">
                <a class="active" href="{{ URL('/trang-chu') }}"><i class="fa fa-home"></i></a>
                <a href="tel:{{ $contact->info_contact_phone }}"><i class="fa fa-phone"></i></a>
                <a href="{{URL::to('/hien-thi-gio-hang')}}"><i class="fa fa-shopping-cart">
                        <?php
                            $content_cart = Cart::content()->count();
                               if(!empty($content_cart)){
                                   echo "(".$content_cart.")";
                               }
                        ?></i>
                </a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i></a>
            </div>
            <a href="tel:{{ $contact->info_contact_phone }}">
                <div class="hotline">
                    <span class="before-hotline">Hotline:</span>
                    <span class="hotline-number">{{ $contact->info_contact_phone }}</span>
                    <span class="fa fa-phone phone"></span>
                </div>
            </a>
            <footer id="footer">
                <!--Footer-->
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="companyinfo" style="margin-top:0">
                                    <h2><span>Sunny</span>-Ngo</h2>
                                    <p>Tuyển sỉ lẻ tất cả các mặt hàng vải áo dài, nhận in đồng phục, đồng phục in tại xưởng</p>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <div class="companyinfo" style="margin-top:0">
                                        <h3 style="COLOR:#B4B1AB">LIÊN HỆ</h3>
                                        <p>Tuyển sỉ lẻ tất cả các mặt hàng vải áo dài, nhận in đồng phục, đồng phục in tại xưởng.</p>
                                        <p>Giao hàng nhanh trong vòng 3-7 ngày, miễn đổi trả hàng, phục vụ quý khách là niềm vui của chúng tôi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-3">
                                <div class="address">
                                    <img src="{{asset('public/upload/bo-cong-thuong.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--/Footer-->
            <script src="{{asset('public/client/js/jquery.js')}}"></script>
            <script src="{{asset('public/client/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('public/client/js/jquery.scrollUp.min.js')}}"></script>
            <script src="{{asset('public/client/js/price-range.js')}}"></script>
            <script src="{{asset('public/client/js/jquery.prettyPhoto.js')}}"></script>
            <script src="{{asset('public/client/js/form-validator.min.js')}}"></script>
            <script src="{{asset('public/client/js/sweetalert.js')}}"></script>
            <script src="{{asset('public/client/js/main.js')}}"></script>
@yield('script')
