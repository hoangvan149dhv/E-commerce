<?php use Carbon\Carbon;?>
@extends('frontend.index')
@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper px-md-4">
                    @foreach ($contactinfoModel as $contact)
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Địa chỉ:</span> {{$contact->info_contact_add}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Số điện thoại:</span> <a href="tel:{{ $contact->info_contact_phone }}">{{ $contact->info_contact_phone }}</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                       <span class="fa fa-envelope"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Email:</span> <a href="mailto:info@yoursite.com">
                                                {{ $contact->info_contact_mail }}
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row no-gutters">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Liên hệ với chúng tôi</h3>
                                <form method="POST" id="contactForm" name="contactForm" class="contact-form contactForm" action="{{ URL::to('/lien-he') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="name">Họ tên</label>
                                                <input data-validation="length" data-validation-length="5-70"
                                                       data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="text"
                                                       class="form-control"
                                                       name="name" class="form-control" required="required"
                                                       placeholder="Nguyễn Văn A">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Email</label>
                                                <input data-validation="length" data-validation-length="5-70"
                                                       data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="email"
                                                       class="form-control"
                                                       name="email" class="form-control" required="required"
                                                       placeholder="abc@xyz.com">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="#">Nội dung</label>
                                                <textarea data-validation="length" data-validation-length="5-1000"
                                                          data-validation-error-msg='vui lòng điền 5- 1000 kí tự' name="content"
                                                          id="message" required="required" class="form-control" rows="8"
                                                          placeholder="Góp Ý"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Send Message" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 order-md-first d-flex align-items-stretch">{!! $contact->google_map ?? "" !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('breadcumbs')
    <section class="hero-wrap hero-wrap-2"
             style="background-image: url({{asset('public/upload/85142834_773653949709503_6666853325834551296_o49.jpg' )}});"
             data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Liên hệ <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Liên hệ</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        //
    </script>
@endsection
