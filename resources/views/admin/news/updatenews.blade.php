@extends('admin.admin_layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    {!! $message = Session::get('updatesuccess'); !!}
                    @if($message)
                        <div class="alert-success alert"> {{$message}} </div>
                    @endif
                    {!! Session::put('updatesuccess',null); !!}
                <form role="form" action="{{URL::to('/update-news/'.$newsadminModel->news_id)}}" method="post" enctype="multipart/form-data">
                   {{ csrf_field() }}  {{-- Token --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu Đề Bài Viết</label>
                        <input value="{{ $newsadminModel->news_title }}"  data-validation="length" data-validation-length="50-120" data-validation-error-msg='vui lòng điền tối đa 120 kí tự' type="text" class="form-control" name="title"id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả ngắn</label>
                        <input value="{{ $newsadminModel->news_desc }}" data-validation="length"data-validation-length="50-270" data-validation-error-msg='vui lòng điền tối đa 270 kí tự' type="text" class="form-control" name="desc"id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình Ảnh</label>
                        <input type="file" data-validation="mime size" data-validation-allowing="jpg, png, gif"
                        data-validation-max-size="2M"class="form-control"
                        data-validation-error-msg="Vui lòng chọn file có đuôi .jpg, png, gif" class="form-control" name="image"id="exampleInputEmail1">
                        <img src="../public/upload/{{ $newsadminModel->news_image }}" width="80" height="110">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung</label>
                        <textarea name="content" data-validation="length" data-validation-length="min4" data-validation-error-msg='vui lòng điền trên 4 kí tự' class="form-control"  id="ckComment" cols="" rows="">{{ $newsadminModel->news_content }}</textarea>
                    </div>
                    <div class="checkbox">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info">Sửa Bản Tin</button>
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
