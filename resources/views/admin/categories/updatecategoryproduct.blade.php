@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
            </header>
            <div class="panel-body">
                @foreach ($editcategory_Product as $key=>$edit_value)
                    <div class="position-center">
                        <?php
                        $message_success = Session::get('message');
                        if(!empty($message_success)) : ?>
                        <div class="alert-success alert"><?php echo $message_success;?></div>
                        <?php endif ?>
                        <?php
                        Session::put('message', null);
                        ?>
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                           {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"  value="{{$edit_value->category_name}}" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả</label>
                                <input data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="mota"id="exampleInputEmail1" value="{{$edit_value->category_desc}}" placeholder="Tên Danh Mục">
                            </div>
                            <div class="checkbox">
                            </div>
                            <button type="submit" name="update" class="btn btn-info">Cập Nhật</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
@section('cate')
     class="active"
@endsection
