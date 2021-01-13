<!DOCTYPE html>
<html lang="vi">
@include('frontend.sections.head')
<!--/head-->
<body>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0 phone pl-md-2">
                        <a href="tel:@foreach ($contactinfoModel as $contact) {{ $contact->info_contact_phone }} @endforeach" class="mr-2">
                            <span class="fa fa-phone mr-1"></span> {{ $contact->info_contact_phone }}</a>
                        <a href="mailto:{{ $contact->info_contact_mail }}"><i class="fa fa-envelope mr-1" aria-hidden="true"></i>{{ $contact->info_contact_mail }}</a>
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end">
                    <div class="social-media mr-4">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.menu.menu')
    @yield('breadcumbs')
<!--/header-->

@if(\View::exists('frontend.home.home'))
<!--slider-->
@yield('slider')
<!--/slider-->
@endif
<section class="ftco-section">
        @yield('content')
    @yield('blog')
</section>
@yield('popup')
@include('frontend.sections.footer')
@include('frontend.libraries.script')
@yield('script')
</body>
</html>
