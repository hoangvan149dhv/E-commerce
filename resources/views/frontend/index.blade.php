<!DOCTYPE html>
<html lang="en">
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

@isset($slider[0])
<!--slider-->
<div class="hero-wrap" style="background-image: url('public/upload/{{$slider[0]->img}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-8 ftco-animate d-flex align-items-end">
            <div class="text w-100 text-center">
              <h1 class="mb-4">Good <span>Drink</span> for Good <span>Moments</span>.</h1>
              <p><a href="#" class="btn btn-primary py-2 px-4">Shop Now</a> <a href="#" class="btn btn-white btn-outline-white py-2 px-4">Read more</a></p>
          </div>
        </div>
      </div>
    </div>
</div>

<section class="ftco-intro">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-4 d-flex">
                <div class="intro d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-support"></span>
                    </div>
                    <div class="text">
                        <h2>Online Support 24/7</h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="intro color-1 d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-cashback"></span>
                    </div>
                    <div class="text">
                        <h2>Money Back Guarantee</h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="intro color-2 d-lg-flex w-100 ftco-animate">
                    <div class="icon">
                        <span class="flaticon-free-delivery"></span>
                    </div>
                    <div class="text">
                        <h2>Free Shipping &amp; Return</h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
            </div>
            <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
      <div class="heading-section">
          <span class="subheading">Since 1905</span>
        <h2 class="mb-4">Desire Meets A New Taste</h2>

        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
        <p class="year">
            <strong class="number" data-number="115">0</strong>
            <span>Years of Experience In Business</span>
        </p>
      </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-1.jpg);"></div>
                    <h3>Brandy</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-2.jpg);"></div>
                    <h3>Gin</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-3.jpg);"></div>
                    <h3>Rum</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-4.jpg);"></div>
                    <h3>Tequila</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-5.jpg);"></div>
                    <h3>Vodka</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 ">
                <div class="sort w-100 text-center ftco-animate">
                    <div class="img" style="background-image: url(images/kind-6.jpg);"></div>
                    <h3>Whiskey</h3>
                </div>
            </div>

        </div>
    </div>
</section>
<!--/slider-->
@endisset
<section class="ftco-section">
    <div class="container">
        @yield('content')
    </div>
    @yield('blog')
</section>
@yield('popup')
@include('frontend.sections.footer')
@include('frontend.libraries.script')
@yield('script')
</body>
</html>
