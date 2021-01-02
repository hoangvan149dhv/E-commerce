<!--header-middle-->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a href="{{ URL::to('/') }}"><img src="{{asset('public/upload/logo2.png')}}" alt=""/></a>
        <div class="order-lg-last btn-group">
        <a class="dropdown-toggle-split" href="{{URL::to('/thong-tin-khach-hang')}}"><i class="fa fa-pencil-square-o"></i></a>
        <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="flaticon-shopping-bag"></span>
        <div class="d-flex justify-content-center align-items-center">
            <small>
                <?php
                    $dataCart = Cart::content();
                    $amount_cart = $dataCart->count();
                    echo empty($amount_cart) ? '' : "(" . $amount_cart . ")";
                ?>
            </small>
        </div>
        </a>
        @foreach ($dataCart as $cart)
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-item d-flex align-items-start" href="#">
                <div class="img" style="background-image: url(public/upload/{{$cart->options->images}});"></div>
                <div class="text pl-3">
                    <h4>{{$cart->name}}</h4>
                    <p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">SL: {{$cart->qty}}</span></p>
                </div>
            </div>
            <a class="dropdown-item text-center btn-link d-block w-100"  href="{{URL::to('/hien-thi-gio-hang')}}">
                Đến giỏ hàng
                <span class="ion-ios-arrow-round-forward"></span>
            </a>
            </div>
        </div>
        @endforeach
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ url::to('/khuyen-mai') }}" class="nav-link"> Khuyễn mãi</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danh mục</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                @foreach ($category_product as $cate)
                    <a class="dropdown-item" href="{{ URL::to('/Danh-muc-san-pham/'.$cate->category_id)}}">{{"- ". $cate->category_name}}</a>
                @endforeach
            </div>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bộ sưu tập</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                @foreach ($brand_code_product as $brand_code)
                <a class="dropdown-item" href="{{URL::to('/thuong-hieu/'.$brand_code->code_id)}}">{{"- ". $brand_code->brandcode_name}}</a>
                @endforeach
            </div>
            </li>
            <li class="nav-item"><a href="{{ url::to('/tin-tuc-chia-se')}}" class="nav-link">Góc chia sẻ</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thông tin về shop</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="#">Về chúng tôi</a>
                <a class="dropdown-item" href="{{ url::to('/lien-he') }}">Liên hệ</a>
            </div>
            </li>
        </ul>
        </div>
    </div>
</nav>
<!--/header-bottom-->