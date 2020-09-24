@extends('admin.admin_layout')
@section('content')  {{--QUAN TRỌNG DÒNG YEIL dòng 294--}}
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tạo giao diện Mail
                </header>

                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-template-mail')}}" method="post" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề</label>
                            <input value=""  data-validation="length" data-validation-length="1-120" data-validation-error-msg='vui lòng điền 5- 120 kí tự' type="text" class="form-control" name="label">
                       </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Template mail</label>
                            <textarea name="template" data-validation="length" data-validation-length="5-100" data-validation-error-msg='vui lòng điền  5-100 kí tự' class="form-control"  id="ckComment" cols="" rows="" placeholder="Mô Tả...."></textarea>
                        </div>
                        <div class="checkbox">
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm Sản Phẩm</button>
                        </form>
                    </div>
                </div>
                @include('admin.mails.helper_word_orderdetail_mail')
            </section>
    </div>
</div>
@endsection
@section('mail')
     class="active"
@endsection
