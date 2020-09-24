@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Bài viết
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-news')}}" method="post" enctype="multipart/form-data">
                       {{ csrf_field() }}  {{-- CÂU LỆNH token BẢO MẬT --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu Đề Bài Viết</label>
                            <input  data-validation="length" data-validation-length="50-120" data-validation-error-msg='vui lòng điền tối đa 120 kí tự và tối thiểu 50' type="text" class="form-control" name="title"id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả ngắn</label>
                            <input  data-validation="length"data-validation-length="20-270" data-validation-error-msg='vui lòng điền tối đa 270 kí tự và tối thiểu 20' type="text" class="form-control" name="desc"id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh</label>
                            <input type="file"  data-validation="mime size" data-validation-allowing="jpg, png, gif"
                            data-validation-max-size="2M"class="form-control"
                            data-validation-error-msg="Vui lòng chọn file có đuôi .jpg, png, gif" class="form-control" name="image"id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea name="content"data-validation-length="max100" data-validation="length" data-validation-length="min4" data-validation-error-msg='vui lòng điền trên 4 kí tự' class="form-control"  id="ckComment" cols="" rows=""></textarea>
                        </div>
                        <div class="checkbox">
                            <?php
                            $message = Session::get('success');
                            if($message){ ?>
                                <div class="alert-success alert"><?php echo $message; ?></div>
                              <?php }  Session::put('messages',null);
                        ?>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm Bản Tin</button>
                        </form>
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection
@section('news')
     class="active"
@endsection
