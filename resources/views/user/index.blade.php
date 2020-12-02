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
            <div class="row" style="margin-top:15px">
                <div class="col-sm-9 col-ipad-details">
                    @yield('content')
                </div>
                <div class="col-sm-3 col-ipad-slide" style="text-align: center;">
                    @include('user.layouts.navigation.navigation')
                </div>
            </div>
        </div>
    </section>
    <a href="tel:@foreach ($contactinfoModel as $contact) {{ $contact->info_contact_phone }} @endforeach">
        <div class="hotline">
            <span class="before-hotline">Hotline:</span>
            <span class="hotline-number"> {{ $contact->info_contact_phone }}</span>
            <span class="fa fa-phone phone"></span>
        </div>
    </a>
@yield('popup')
@include('user.sections.footer')
@include('user.libraries.script')
@yield('script')
</body>
</html>
