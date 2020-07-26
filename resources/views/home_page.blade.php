<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- SEO --}}
    <meta name="description" content="{{ $meta_desc }}"> {{--MÔ TẢ GOOGLE bên homeController.php --}}
    <meta name="keywords" content="{{ $meta_keyword }}" />{{--TỪ KHÓA GOOGLE bên homeController.php --}}
    <meta name="author" content="">
    <title>{{ $meta_title }}</title>{{-- bên homeController.php --}}
    
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ $url_canonical }}" />
    <link rel="icon" type="image" href=""> {{-- //SEO --}} {{-- Property --- DÙNG ĐỂ SHARE TRANG( NHƯ FACEBOOK, ...) --}}
    <meta property="og:image" content="{{ asset('public/upload/qc2.png') }}" />
    <meta property="og:site_name" content="http://vanduong.com.web3.redhost.vn/" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url_canonical }}" /> {{-- Property --}}
    <link href="{{asset('public/client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/font-awesome.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('public/client/css/prettyPhoto.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('public/client/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/client/js/sweetalert.js')}}" rel="stylesheet">{{-- sweet alert --}}
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header-middle">
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
                        <div class="shop-menu pull-right" >
                            <ul class="nav navbar-nav">
                                {{-- <li><a href=""><i class="fa fa-envelope"></i> hoangvan1491999_gmail.com</a></li> --}}
                                <li><a href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i> Lịch sử mua hàng</a></li>
                                <li><a href="{{URL::to('/hien-thi-gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng									
                                    {{-- <li><a href="{{URL::to('/hien-thi-gio-hang-ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng									 --}}
                                    <?php
									$content_cart = Cart::content()->count();  //ĐẾM SỐ LƯỢNG TRONG GIỎ HÀNG
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
                                <li><a href="{{ url::to('/lien-he') }}">Liên Hệ</a>    </li>                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{URL::to('/tim-kiem')}}" method="POST" style="margin-bottom:0px">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="search" placeholder="Tìm kiếm" name="search" />
                                    <span class="input-group-btn">
								<button  name="submit"class="fa fa-search btn btn-sm btn_search_product"></button>
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

    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators" style="z-index:1">
                            <?php
                                use App\sliderModel;
                                $alert = sliderModel::all()->where('status',1)->count();
                            ?>
                            @for ($i = 0; $i < $alert; $i++)
                                <li data-target="#slider-carousel" data-slide-to="{{$i}}"></li>
                            @endfor
                            {{-- <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li> --}}
                        </ol>
                        <div class="carousel-inner">
                            {{-- <div class="item active">
                                @yield('slider_first')
                            </div> --}}
                                @yield('slider')
                        </div>
                    </div>
                    {{-- @yield('slide-right-left') --}}
                    <?php
                     if(($alert>1)){
                        echo '<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>';
                     }else{

                     }
                    ?>
                </div>

            </div>
        </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content') {{--GỌI 'content bên trang home.blade.php dòng 2' --}}
                </div>
            </div>
        </div>
    </section>
                {{-- MENU BAR --}}
                <div class="icon-bar-menu">
                    <a class="active" href="{{ URL('/trang-chu') }}"><i class="fa fa-home"></i></a> 
                    <a href="tel:0334964103""><i class="fa fa-phone"></i></a> 
                    <a href="{{URL::to('/hien-thi-gio-hang')}}"><i class="fa fa-shopping-cart"><?php
                        $content_cart = Cart::content()->count();  //ĐẾM SỐ LƯỢNG TRONG GIỎ HÀNG
                           if(empty($content_cart)){	
                               echo "";
                           }else{
                               echo "(".$content_cart.")";
                           }
                        ?></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a  href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i></a> 
                </div>

    <a href="tel:0334964103">
        <div class="hotline">
            <span class="before-hotline">Hotline:</span>
            <span class="hotline-number">0334.964.103</span>
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
                            <img src="public/upload/bo-cong-thuong.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
    {{-- pup up --}}

    <?php //phpinfo(); ?>;
    @yield('pupup')
    <style>
        /* #background button{
			position:relative;
			font-size: 20px;
			bottom:26px;
			background-color:#c1c1c1;
			border: none;
			color: #FFFFFF
		}
		#background button:hover{
			color: #fe980f;
			background: whitesmoke;
		} */
        /* ul.sub-menu.menu-slide {
    display: block;
} */
    </style>
    <script src="{{asset('public/client/js/jquery.js')}}"></script>
    <script src="{{asset('public/client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/client/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/client/js/price-range.js')}}"></script>
    <script src="{{asset('public/client/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/client/js/main.js')}}"></script>
    {{-- DÙNG VALIDATION FORM ĐỂ CHECK KÍ TỰ --}}
    <script src="{{asset('public/client/js/form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({
        });

        // MENU
        $(document).ready(function() {
            $(window).scroll(function name(params) {
                if (window.scrollY > 300) {
                    // $('#header').addClass('wapper-col-ul');
                    $('.icon-bar-menu').addClass('menu-bar');
                    // $(".header-middle").css('display','none');
                    $(".header-middle").slideUp(100);
                }
                if (window.scrollY < 200) {
                    // $('#header, wapper-col-ul').removeClass('wapper-col-ul');
                    $('.icon-bar-menu, menu-bar').removeClass('menu-bar')
                    // $(".header-middle").css('display','block');
                    $(".header-middle").slideDown(100);
                }
            })
            $('#background').fadeIn(1000);
            $('#background').click(function name(params) {
                $('#background').fadeOut(700, function name(params) {
                    $(this).css('display', 'none');
                })
            })
            $('#background button').click(function name(params) {
                $('#background').fadeOut(700, function name(params) {
                    $(this).css('display', 'none');
                })
            });
            $('.carousel-indicators li:first-child, .carousel-inner>.item:first-child').addClass('active');
            // $('').addClass('active');
            // $('.dropdown').click(function name(params) {
            //     $('ul.sub-menu').toggleClass('menu-slide');
            // })
            // $('.dropdown').click(function name(params) {
            //     $('ul.sub-menu').slideToggle(700);
            // })
            // $('.dropdowna').click(function name(params) {
            //     $('ul.sub-menu-cate').slideToggle(700);
            // })
        })
    </script>
    @yield('script') {{-- TẠO AJAX --}}
    <script src="{{asset('public/client/js/sweetalert.js')}}"></script>
    {{-- //TẠO AJAX --}}
</body>

</html>