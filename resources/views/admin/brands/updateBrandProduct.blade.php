@extends('admin.index')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
            </header>
            <div class="panel-body">
                @foreach ($all_Brandcode_product as $key=>$edit_value)
                <div class="position-center">
                    <?php
                    $message_success = Session::get('alert-success');
                    if(!empty($message_success)) : ?>
                    <div class="alert-success alert"><?php echo $message_success;?></div>
                    <?php endif ?>
                    <?php
                    Session::put('alert-success', null);
                    ?>
                    <form role="form" action="{{URL::to('/admin/update-brandcode-product/'.$edit_value->code_id)}}" method="post">
                       {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Sản Phẩm</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"
                                    value="{{$edit_value->brandcode_id}}" class="form-control" name="code"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Thương Hiệu</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"
                                    value="{{$edit_value->brandcode_name}}" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="checkbox">
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
