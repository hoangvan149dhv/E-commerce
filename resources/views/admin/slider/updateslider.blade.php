@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Cập nhật Slider quảng cáo
                </header>
                <div class="panel-body">
                    {{-- @foreach ($slider_edit as $slider) --}}
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/admin/update-slider/'.$slider_edit->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh</label>
                                <input type="file"   data-validation="mime size" data-validation-allowing="jpg, png, gif"
                                data-validation-max-size="2M"class="form-control"
                                data-validation-error-msg="Vui lòng chọn file có đuôi .jpg, png, gif" class="form-control" name="image"id="exampleInputEmail1">
                                <input type="hidden" value="{{ $slider_edit->img }}" name="image">
                                <img src="{{asset('public/upload/'.$slider_edit->img )}}" width="80" height="110">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hiển Thị</label>
                                <select name="status" class="form-control input-sm m-bot15">
                                    @if ($slider_edit->status==0)
                                        <option selected value = "0">Ẩn</option>
                                        <option value ="1">Hiện</option>
                                    @elseif($slider_edit->status==1)
                                        <option selected value ="1">Hiện</option>
                                        <option value = "0">Ẩn</option>
                                    @endif
                                </select>
                            </div>
                            <div class="checkbox">
                                <?php
                                $message = Session::get('success');
                                if($message){
                                ?>
                                    <div class="alert-success alert"><?php echo $message; ?></div>
                                <?php
                                    Session::put('success',null);
                                }
                                $error = Session::get('error');
                                if($error){
                                ?>
                                    <div class="alert-danger alert"><?php echo $error; ?></div>
                                <?php
                                    Session::put('error',null);
                                }
                                ?>
                            </div>
                            <button type="submit" name="submit" class="btn btn-info">Thêm</button>
                        </form>
                    </div>
                    {{-- @endforeach --}}
                </div>

            </section>
    </div>
</div>
@endsection
@section('slider')
     class="active"
@endsection
