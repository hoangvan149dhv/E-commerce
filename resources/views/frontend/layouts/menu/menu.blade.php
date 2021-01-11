<!--header-middle-->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Sunny <span>Ngo</span></a>
            <div class="order-lg-last btn-group">
            <!--history-order-->
            <a href="#" data-toggle="modal"
               data-target="#historyOrder"><span class="fa fa-pencil-square-o"></span></a>
                <div class="modal fade" id="historyOrder" tabindex="-1" role="dialog"
                     aria-labelledby="historyOrderLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="historyOrderLabel">Báo cáo lỗi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{URL::to('/hien-thi-thong-tin')}}"
                                  method="post">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Họ tên:</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Số Điện Thoại">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!--/history-order-->
            <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <span class="flaticon-shopping-bag" aria-hidden="true"></span>
                @php
                    $dataCart = Cart::content();
                    $qty = 0;
                    foreach ($dataCart as $data) {
                        $qty += $data->qty;
                    }
                    $amount_cart = $qty;
                    \Illuminate\Support\Facades\Session::put('Qty', $amount_cart);
                @endphp
                <div class="d-flex justify-content-center align-items-center">
                    <small>
                        @if($amount_cart)
                        <?php
                            echo empty($amount_cart) ? '(0)' : "(".$amount_cart.")";
                        ?>
                        @else
                            (0)
                        @endif
                    </small>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if($amount_cart)
                    <div class="cart_products">
                        @foreach ($dataCart as $cart)
                            @php
                                $product = \App\Http\library\product_detail::getProductDetail($cart->id);
                            @endphp
                            <div class="dropdown-item d-flex align-items-start" href="#">
                                <a href="{{ URL::to('/chi-tiet/'.$product[0]->meta_slug) }}">
                                    <div class="img" style="background-image: url({{asset('public/upload/'.$cart->options->images)}}"></div>
                                    <div class="text pl-3">
                                        <h4>{{$cart->name}}</h4>
                                        <p class="mb-0"><a href="#" class="price">{{number_format($cart->price)}}.VNĐ</a>
                                            <span class="quantity ml-3">Số Lượng: {{$cart->qty}}</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="dropdown-item text-center btn-link d-block w-100">Tổng: {{Cart::subtotal(0)}}.VNĐ</h3>
                    <a class="btn btn-primary dropdown-item text-center btn-link d-block w-100"
                       href="{{URL::to('/hien-thi-gio-hang')}}">
                        Đến giỏ hàng
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                @else
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        Chưa có sản phẩm
                    </div>
                @endif
            </div>
        </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
    </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{ url::to('/khuyen-mai') }}" class="nav-link"> Khuyễn mãi</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">Danh mục</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @foreach ($category_product as $cate)
                            <a class="dropdown-item"
                               href="{{ URL::to('/Danh-muc-san-pham/'.$cate->category_id)}}">{{"- ". $cate->category_name}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">Bộ sưu tập</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @foreach ($brand_code_product as $brand_code)
                            <a class="dropdown-item"
                               href="{{URL::to('/thuong-hieu/'.$brand_code->code_id)}}">{{"- ". $brand_code->brandcode_name}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item"><a href="{{ url::to('/tin-tuc-chia-se')}}" class="nav-link">Góc chia sẻ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">Thông tin về shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Về chúng tôi</a>
                        <a class="dropdown-item" href="{{ url::to('/lien-he') }}">Liên hệ</a>
                    </div>
                </li>
            </ul>
            <div class="search-container">
                <form action="{{URL::to('/tim-kiem')}}" class="d-flex" method="GET">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit" class="btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</nav>
<!--/header-bottom-->
