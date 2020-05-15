@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Sản Phẩm
                </header>
                <div class="panel-body">
                    @foreach ($all_product as $product)
                        {{-- all_Brandcode_product là biến đã đặt ở dòng 42 Controller BrandcodeProduct.php --}}
                    <div class="position-center">
                        <?php
                        $message = Session::get('alert-successproduct');
                            if($message){ ?>
                            <div class="alert-success alert"><?php echo $message; ?></div> 
                          <?php }
                            Session::put('alert-success-product',null);
                    ?>
                        <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                                                                        {{-- LẤY ID ĐỂ UPDATE --}}
                           {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                         <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input   data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1" value="{{$product->product_Name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gía khuyến mãi</label>
                            <input data-validation="number" data-validation-error-msg='vui lòng điền kí tự số' type="number" min="1" name="promotion_price"id="exampleInputEmail1" class="form-control" value="{{$product->product_price_promotion}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gía Sản Phẩm</label>
                            <input   data-validation="number" data-validation-error-msg='vui lòng điền trên 6 kí tự số' type="text" class="form-control" name="price"id="exampleInputEmail1" value="{{$product->product_price}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh</label>
                            <input type="file" data-validation="mime size" data-validation-allowing="jpg, png, gif" 
                            data-validation-max-size="2M"class="form-control"
                            data-validation-error-msg="Vui lòng chọn file có đuôi .jpg, png, gif" name="image"id="exampleInputEmail1">
                            <img src="../public/upload/{{ $product->product_image }}" width="80" height="110">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                            <textarea name="mota" class="form-control" id="ckComment" >{{$product->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chất Liệu</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="material"id="exampleInputEmail1" value="{{$product->product_material}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta_keyword(goole)</label>
                            <textarea name="meta_keyword"  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' class="form-control" cols="" rows="" placeholder="Từ khóa trên google....">{{$product->meta_keyword}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta_desc(google)</label>
                            <textarea name="meta_desc"  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' class="form-control"  cols="" rows="" placeholder="Mô Tả trên google....">{{$product->meta_desc}}</textarea>
                        </div>    
                    @endforeach
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh Mục Sản Phẩm</label>
                            <select name="category" class="form-control input-sm m-bot15">
                                <option selected value="{{$product->category_id}}">{{$product->category_name}}</option>
                                @foreach ($category_product as $category_product)
                            <option value ="{{$category_product->category_id}}">{{$category_product->category_name}}</option>
                                                                    {{-- category_id là sql ||$cate_product là ở bên troller khai báo 
                                                                                                     category_name là sql --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Sản Phẩm(Thương Hiệu)</label>
                            <select name="brandcode" class="form-control input-sm m-bot15">
                                <option selected value="{{$product->code_id}}">{{$product->brandcode_id}}</option>
                                @foreach ($brandcode_product as $brand_product)
                                 <option  value = "{{$brand_product->code_id}}">{{$brand_product->brandcode_id}}</option>
                                    {{-- code_id là sql                 brandcode_name là sql --}}
                                @endforeach
                            </select>
                        </div>
                            <button type="submit" name="update" class="btn btn-info">Cập Nhật</button>
                        </form>
                    </div>
                </div>
                    
            </section>
    </div>
</div>
@endsection
@section('product')
     class="active"
@endsection