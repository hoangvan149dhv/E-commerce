<div class="left-sidebar">
    <!--/category-products-->
    <h2>Bộ Sưu Tập</h2>
    <div class="panel-group category-products">
        <!--brands_products-->
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($category_product as $cate)
                    <li><a href="{{ URL::to('/Danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/category-products-->
    <div class="brands_products">
        <!--brands_products-->
        <h2>Vải áo dài sunny</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($brand_code_product as $brand_code)
                    <li><a href="{{URL::to('/thuong-hieu/'.$brand_code->code_id)}}">{{$brand_code->brandcode_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/brands_products-->
    @yield('product_other')
</div>
