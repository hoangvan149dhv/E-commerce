<?php
use Carbon\Carbon;
?>
@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cấu Hình
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-config')}}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}  {{-- Token --}}
                            <div class="form-group">
                                <label for="webshopName">Tên website (webshop name)</label>
                                <input data-validation="length" data-validation-length="15-50"
                                       data-validation-error-msg='vui lòng điền tối đa 50 kí tự và tối thiểu 15'
                                       value="{{config('config_admin.site_name')}}"  type="text" class="form-control" name="webshop_shop" id="webshopName">
                            </div>
                            <div class="form-group">
                                <label for="metaTitle">Meta Tiêu đề bài viết (title)</label>
                                <input data-validation="length" data-validation-length="20-70"
                                       data-validation-error-msg='vui lòng điền tối đa 70 kí tự và tối thiểu 20'
                                       type="text"
                                       value="{{config('config_admin.meta_title')}}" class="form-control" name="meta_title" id="metaTitle">
                            </div>
                            <div class="form-group">
                                <label for="metaDesc">Meta Mô tả ngắn (desc)</label>
                                <input data-validation="length" data-validation-length="50-200"
                                       data-validation-error-msg='vui lòng điền tối đa 160 kí tự và tối thiểu 50'
                                       type="text"
                                       value="{{config('config_admin.meta_desc')}}" class="form-control" name="meta_desc" id="metaDesc">
                            </div>
                            <div class="form-group">
                                <label for="metaKeywords">Meta Từ khóa (keywords)</label>
                                <input data-validation="length" data-validation-length="20-90"
                                       data-validation-error-msg='vui lòng điền tối đa 50 kí tự và tối thiểu 20'
                                       type="text"
                                       value="{{config('config_admin.meta_keywords')}}" class="form-control" name="meta_keywords" id="metaDesc">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" @if (config('config_admin.SEO') == 1)  checked="checked"
                                           @endif name="check_SEO"> Bật SEO
                                </label>
                                <?php
                                $message = Session::get('config-success');
                                if($message){ ?>
                                <div class="alert-success alert"><?php echo $message; ?></div>
                                <?php }  Session::put('messages', null);
                                ?>
                            </div>
                            <button type="submit" name="submit" class="btn btn-info">Lưu</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
