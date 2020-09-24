@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Danh Mục Sản Phẩm
                </header>
                <?php
                    // $message = Session::get('message');
                    // if($message){
                    //     echo $message;
                    //     Session::put('message',null);
                    // }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả</label>
                            <input data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="mota"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiển Thị</label>
                            <select name="status" class="form-control input-sm m-bot15">
                                <option value = "0">Ẩn</option>
                                <option value ="1">Hiện</option>
                            </select>
                        </div>
                        <div class="checkbox">
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection
@section('cate')
     class="active"
@endsection
