@extends('admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Sản Phẩm
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <?php
                        $message = Session::get('alert-success-product');
                            if($message){ ?>
                            <div class="alert-success alert"><?php echo $message; ?></div> 
                          <?php }
                            Session::put('alert-success-product',null);
                    ?>
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Sản Phẩm">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="promotion" value="1"/> <label>Gía Khuyến mãi</label>
                            <label for="exampleInputEmail1">Gía khuyến mãi</label>
                            <input data-validation="length" data-validation-length="4-10" style="display:none" id="promotions" data-validation-error-msg='vui lòng điền kí tự số và ít nhất 4-10 kí tự' type="number" min="1" class="form-control" name="promotion_price"id="exampleInputEmail1" value="1" placeholder="VD: 200.000.VNĐ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gía Sản Phẩm</label>
                            <input   id="promotions" data-validation="length" data-validation-length="4-10" data-validation-error-msg='vui lòng điền 4-10 kí tự' type="number" class="form-control" name="price"id="exampleInputEmail1" placeholder="VD: 200.000.VNĐ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh</label>
                            <input type="file"  data-validation="mime size" data-validation-allowing="jpg, png, gif" 
                            data-validation-max-size="2M"class="form-control"
                            data-validation-error-msg="Vui lòng chọn file có đuôi .jpg, png, gif" class="form-control" name="image"id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                            <textarea name="mota" data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền  5-100 kí tự' class="form-control"  id="ckComment" cols="" rows="" placeholder="Mô Tả...."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chất Liệu</label>
                            <input data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền  5-100 kí tự' type="text"class="form-control" id="exampleInputEmail1"name="material">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta_keyword(goole)</label>
                            <textarea name="meta_keyword" data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền  5-100 kí tự' class="form-control" cols="" rows="" placeholder="Từ khóa trên google...."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta_desc(google)</label>
                            <textarea name="meta_desc" data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền trên 5-100 kí tự' class="form-control"  cols="" rows="" placeholder="Mô Tả trên google...."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh Mục Sản Phẩm</label>
                            <select name="category" class="form-control input-sm m-bot15">
                                <option value="0"><--Chọn Danh Mục Sản Phẩm--></option>
                                @foreach ($category_product as $key=>$category_product)
                            <option value ="{{$category_product->category_id}}">{{$category_product->category_name}}</option>
                                                                    {{-- category_id là sql ||$cate_product là ở bên troller khai báo 
                                                                                                     category_name là sql --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Sản Phẩm(Thương Hiệu)</label>
                            <select name="brandcode" class="form-control input-sm m-bot15">
                                <option value="0"><-- Chọn Mã Sản Phẩm (Thương Hiệu) --></option>
                                @foreach ($brand_code_product as $ket=>$brand_code_product)
                            <option value = "{{$brand_code_product->code_id}}">{{$brand_code_product->brandcode_name}}</option>
                                                            {{-- code_id là sql                 brandcode_name là sql --}}
                                @endforeach
                            </select>
                        </div>  
                        <div class="checkbox"> 
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm Sản Phẩm</button>
                        </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function name(params) {
            $('#promotion').click(function () {
                if($(this).is(":checked")){
                $("#promotions").css('display','block');
            }
            else if($(this).is(":not(:checked)")){ // HOẶC GHI else thôi là đc
                $("#promotions").css('display','none');
            }
            });
        });
    </script>
@endsection
@section('product')
     class="active"
@endsection