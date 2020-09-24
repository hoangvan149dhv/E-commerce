@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục Sản Phẩm
                </header>
                <div class="panel-body">
                    @foreach ($all_Brandcode_product as $key=>$edit_value)
                        {{-- all_Brandcode_product là biến đã đặt ở dòng 42 Controller BrandcodeProduct.php --}}
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brandcode-product/'.$edit_value->code_id)}}" method="post">
                                                                                        {{-- LẤY ID ĐỂ UPDATE --}}
                           {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã Sản Phẩm</label>
                                <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"  value="{{$edit_value->brandcode_id}}" class="form-control" name="code"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                    {{--$edit_value dòng 17 || brandcode_id là tên cột trong csld   --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên Thương Hiệu</label>
                                <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"  value="{{$edit_value->brandcode_name}}" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                            </div>
                            <div class="checkbox">
                                <?php
                                    $message = Session::get('alert-success');
                                    if($message){
                                 ?>

                                <div class="alert-success alert"><?php echo $message; ?></div>
                                <?php
                                Session::put('alert-success',null);
                                        }
                                    ?>
                            </div>
                            <button type="submit" name="update" class="btn btn-info">Cập Nhật</button>
                            </form>
                        </div>

                    </div>
                    @endforeach

            </section>
    </div>
</div>
@endsection
@section('brand')
     class="active"
@endsection
