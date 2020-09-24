@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục Sản Phẩm
                </header>
                <?php
                    // $message = Session::get('message');
                    // if($message){
                    //     echo $message;
                    //     Session::put('message',null);
                    // }
                ?>
                <div class="panel-body">
                    @foreach ($editcategory_Product as $key=>$edit_value)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                                                                        {{-- LẤY ID ĐỂ UPDATE --}}
                           {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text"  value="{{$edit_value->category_name}}" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                    {{--$edit_value dòng 17 || category_name là tên cột trong csld   --}}
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
                </div>
                    @endforeach

            </section>
    </div>
</div>
@endsection
@section('cate')
     class="active"
@endsection
