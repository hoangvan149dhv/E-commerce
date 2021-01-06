<!DOCTYPE html>
<html lang="en">
@include('user.sections.head')
<!--/head-->
<body>
<header id="header" class="header-main">
    @include('user.layouts.menu.menu')
</header>
<!--/header-->
<section>
    <div class="container">
        <div class="row">
            <div id="contact-page" class="container">
                <div class="bg">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="title text-center">liên hệ <strong>chúng tôi</strong></h2>
                            <?php
                            foreach ($contactinfoModel as $item => $contact) {
                                $map = $contact->google_map;
                                if ($map == "") {
                                } else {
                                    echo '<div id="gmap" class="contact-map">'.$map.'</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row" style="margin-top:25px">
                        <div class="col-sm-7">
                            <div class="contact-form">
                                <h2 class="title text-center">liên hệ</h2>
                                <div class="status alert alert-success" style="display: none"></div>
                                <form id="main-contact-form" class="contact-form row" name="contact-form"
                                      action="{{ URL::to('/lien-he') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-6">
                                        <input data-validation="length" data-validation-length="5-70"
                                               data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="text"
                                               class="form-control"
                                               name="name" class="form-control" required="required"
                                               placeholder="Họ tên">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input data-validation="length" data-validation-length="5-70"
                                               data-validation-error-msg='vui lòng điền 5- 70 kí tự' type="email"
                                               class="form-control"
                                               name="email" class="form-control" required="required"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea data-validation="length" data-validation-length="5-1000"
                                                  data-validation-error-msg='vui lòng điền 5- 1000 kí tự' name="content"
                                                  id="message" required="required" class="form-control" rows="8"
                                                  placeholder="Nội dung"></textarea>
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                    @if($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" style="display:block">
                                                <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                            </span>
                                    @endif
                                    <?php
                                    $message = Session::get('success');
                                    if ($message) {
                                        echo "<h2 class='col-md-12' style='color:green'>".$message."</h2>";
                                        Session::put('success', null);
                                    }
                                    ?>
                                    <div class="form-group col-md-12">
                                        <input type="submit" name="submit" class="btn btn-primary pull-right"
                                               value="Xác nhận">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h2 class="title text-center">Thông tin liên hệ</h2>
                                @foreach ($contactinfoModel as $contact)
                                    <address>
                                        <p><strong> Địa chỉ:</strong> <br>{{ $contact->info_contact_add }}</p>
                                        <p><strong>SĐT: </strong><a
                                                href="tel:{{ $contact->info_contact_phone }}">{{ $contact->info_contact_phone }}</a>
                                        </p>
                                        <p><strong> Email:</strong> {{ $contact->info_contact_mail }} </p>
                                    </address>
                                @endforeach
                                <div class="social-networks">
                                    <h2 class="title text-center"></h2>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/#contact-page-->
        </div>
    </div>
    <a href="tel:{{ $contact->info_contact_phone }}">
        <div class="hotline">
            <span class="before-hotline">Hotline:</span>
            <span class="hotline-number">{{ $contact->info_contact_phone }}</span>
            <span class="fa fa-phone phone"></span>
        </div>
    </a>
</section>
@include('user.sections.footer')
@include('user.libraries.script')
@yield('script')
