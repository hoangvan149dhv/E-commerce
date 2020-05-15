@extends('admin_layout')
@section('content-layout')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Mã Sản Phẩm
                </header>

                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-brandcode-product')}}" method="post">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Sản Phẩm</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="code"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Thương Hiệu</label>
                            <input  data-validation="length" data-validation-length="5-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="name"id="exampleInputEmail1" placeholder="Tên Danh Mục">
                        </div>
                        <div class="checkbox">
                            <?php
                            $message = Session::get('messages');
                            if($message){
                                ?>
                                <div class="alert-success alert"><?php echo $message; ?></div> 
                                <?php
                                Session::put('messages',null);
                            }
                        ?>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection
@section('brand')
     class="active"
@endsection