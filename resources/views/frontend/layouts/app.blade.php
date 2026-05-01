
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>@yield('title', 'Home') - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Afi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="Website resmi {{ config('app.name') }}">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon.png">
    @hasSection('berita')
        @yield('berita')
    @else
        <meta property="og:title" content="@yield('title') - {{ config('app.name') }}"/>
        <meta property="og:type" content="Website"/>
        <meta property="og:url" content="{{ url('/') }}"/>
        <meta property="og:image" content="{{ url('/') }}/favicon.png"/>
        <meta property="og:description" content="Website resmi {{ config('app.name') }}"/>
        <meta property="og:image:type" content="image/jpeg"/>
        <meta property="og:image:width" content="400"/>
        <meta property="og:image:height" content="400"/>
    @endif
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- slider revolution CSS files -->
    {{--<link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/navigation.css') }}">--}}
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ url('/web/css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/demos/travel-agency/travel-agency.css') }}" />
    {{--<script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>--}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4GLR97Q4PK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4GLR97Q4PK');
    </script>
    <style>
        .top-decoration {
            position: relative;
            z-index: 10;
        }
    </style>
    @stack('css')

</head>
<body data-mobile-nav-style="classic">
<!-- start header -->
@include('frontend.partials.navbar')
<!-- end header -->
<!-- start section -->
@yield('content')
<!-- end section -->
<!-- start section -->

<!-- end section -->

<section class="bg-very-light-gray background-position-center-bottom background-size-contain background-no-repeat pt-2 pb-6" style="background-image:url('web/images/demo-travel-agency-home-bg-05.png');">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-base-color text-uppercase d-inline-block">Most popular tours</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Popular packages</h2>
            </div>
        </div>
        <div class="row row-cols-1 justify-content-center mb-10 md-mb-5 xs-mb-10">
            <!-- start content carousal item -->
            <div class="col position-relative" data-anime='{ "opacity": [0,1], "duration": 800, "delay": 50, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="swiper slider-four-slide magic-cursor swiper-number-navigation-style" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "pagination": { "el": ".swiper-pagination", "clickable": true }, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-four-slide-next", "prevEl": ".slider-four-slide-prev" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1400": { "slidesPerView": 4 }, "1200": { "slidesPerView": 3 }, "992": { "slidesPerView": 3 }, "576": { "slidesPerView": 2 } }, "effect": "slide" }' data-swiper-number-navigation="true" data-swiper-show-progress="true">
                    <div class="swiper-wrapper pb-5 md-pb-6">
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">10 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1299<span class="ms-5px position-relative text-red fs-19 fw-500">$1500<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Majestic india life and great wildlife.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">18 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">08 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1099<span class="ms-5px position-relative text-red fs-19 fw-500">$1200<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Maldives resorts with return flights.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">12 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">05 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1349<span class="ms-5px position-relative text-red fs-19 fw-500">$1700<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Dubai parks resorts special packages.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">10 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">10 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1699<span class="ms-5px position-relative text-red fs-19 fw-500">$1800<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">The everyday urban jungle of city.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">16 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">10 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1299<span class="ms-5px position-relative text-red fs-19 fw-500">$1500<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Majestic india life and great wildlife.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">18 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">08 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1099<span class="ms-5px position-relative text-red fs-19 fw-500">$1200<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Maldives resorts with return flights.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">12 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">05 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1349<span class="ms-5px position-relative text-red fs-19 fw-500">$1700<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">Dubai parks resorts special packages.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">10 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                        <!-- start content carousal item -->
                        <div class="swiper-slide">
                            <div class="overflow-hidden border-radius-6px box-shadow-large">
                                <div class="image">
                                    <a href="demo-travel-agency-tour-details-page.html">
                                        <img class="w-100" src="https://placehold.co/800x655" alt="">
                                    </a>
                                </div>
                                <div class="bg-white p-35px position-relative">
                                    <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">10 days</div>
                                    <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Just</span>$1699<span class="ms-5px position-relative text-red fs-19 fw-500">$1800<span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span></span></div>
                                    <a href="demo-travel-agency-tour-details-page.html" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">The everyday urban jungle of city.</a>
                                    <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                        <span class="fw-500 fs-14 d-inline-block text-uppercase">16 Reviews</span>
                                        <div class="review-star-icon ms-auto">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content carousal item -->
                    </div>
                    <!-- start slider pagination -->
                    <div class="swiper-navigation-wrapper d-flex align-items-center justify-content-center">
                        <div class="swiper-button-previous-nav swiper-button-prev slider-four-slide-prev"><i class="feather icon-feather-arrow-left icon-small text-dark-gray"></i><div class="number-prev fs-14 fw-500"></div></div>
                        <div class="swiper-pagination-progress w-200px xs-w-150px bg-medium-gray-transparent"><span class="swiper-progress"></span></div>
                        <div class="swiper-button-next-nav swiper-button-next slider-four-slide-next"><div class="number-next fs-14 fw-500"></div><i class="feather icon-feather-arrow-right icon-small text-dark-gray"></i></div>
                    </div>
                    <!-- end slider pagination -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start section -->
<section class="pt-0">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-base-color text-uppercase d-inline-block">Authentic experiences</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Prime destination</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 justify-content-center mb-5 md-mb-3 xs-mb-40px" data-anime='{ "el": "childs", "scale":[0.9,1], "opacity": [0,1], "duration": 500, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">India</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Poland</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Mexico</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Egypt</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin lg-mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Africa</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin lg-mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Kenya</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin lg-mb-30px">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Maldives</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
            <!-- start interactive banners item -->
            <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin">
                <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                    <img src="https://placehold.co/600x600" alt="" />
                    <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                    <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                        <div class="position-relative z-index-1">
                            <a href="demo-travel-agency-tours.html" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                            <a href="demo-travel-agency-tours.html" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">Dubai</a>
                        </div>
                        <div class="box-overlay bg-dark-gray"></div>
                    </figcaption>
                </figure>
            </div>
            <!-- end interactive banners item -->
        </div>
        <div class="row text-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <div class="col-12">
                <h4 class="alt-font text-dark-gray mb-0 ls-minus-1px fancy-text-style-4">World's hottest destinations for <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "up", "speed": 10, "string": ["mountain lovers.", "nature lovers.", "independent tours."], "duration": 2500 }'></span></h4>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- start parallax style-1 -->
<section class="position-relative overlap-height" data-parallax-background-ratio="0.5" style="background-image: url('https://placehold.co/1920x1100');">
    <div class="opacity-extra-medium bg-gradient-gulf-blue-sepia-brown"></div>
    <div class="container overlap-gap-section">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-8 col-lg-10 position-relative text-center parallax-scrolling-style-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-white text-uppercase mb-5px d-inline-block ls-1px">Finding the perfect trips</span>
                <h1 class="text-white mx-auto alt-font fw-500 mb-40px ls-minus-2px">Get ready to explore and discover your world.</h1>
                <a href="#explore" class="section-link d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-base-color"><i class="bi bi-arrow-down-short text-white icon-medium d-flex"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- end parallax style-1 -->
<!-- start section -->
<section id="explore" class="cover-background overflow-visible" style="background-image: url('https://placehold.co/1920x780');">
    <div class="container overlap-section">
        <div class="row row-cols-1 row-cols-xl-5 row-cols-md-5 row-cols-sm-3 bg-white border-radius-6px mx-0 ps-8 pe-8 lg-ps-3 lg-pe-3 pt-4 pb-4 sm-pt-8 sm-pb-8 xs-pt-15 xs-pb-40px align-items-center mb-7 xs-mb-50px justify-content-center" data-anime='{ "el": "childs", "translateX": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col text-center border-end border-color-extra-medium-gray sm-mb-40px xs-border-end-0">
                <img src="https://placehold.co/140x125" class="mb-10px w-70px d-block mx-auto" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Adventure</span>
            </div>
            <div class="col text-center border-end border-color-extra-medium-gray sm-mb-40px xs-border-end-0">
                <img src="https://placehold.co/140x125" class="mb-10px w-70px d-block mx-auto" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Friendly</span>
            </div>
            <div class="col text-center border-end sm-border-end-0 border-color-extra-medium-gray sm-mb-40px">
                <img src="https://placehold.co/140x125" class="mb-10px w-70px d-block mx-auto" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Popular</span>
            </div>
            <div class="col text-center border-end border-color-extra-medium-gray xs-border-end-0 xs-mb-40px">
                <img src="https://placehold.co/140x125" class="mb-10px w-70px d-block mx-auto" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Beaches</span>
            </div>
            <div class="col text-center">
                <img src="https://placehold.co/140x125" class="mb-10px w-70px d-block mx-auto" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Honeymoon</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <div class="col-lg-3 md-mb-20px text-center text-lg-start">
                <span class="fw-500 text-base-color text-uppercase">Testimonials</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Our happy traveller.</h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <!-- start slider navigation -->
                    <div class="slider-one-slide-prev-1 bg-white box-shadow-double-large swiper-button-prev slider-navigation-style-04"><i class="bi bi-arrow-left-short icon-very-medium"></i></div>
                    <div class="slider-one-slide-next-1 bg-white box-shadow-double-large swiper-button-next slider-navigation-style-04"><i class="bi bi-arrow-right-short icon-very-medium"></i></div>
                    <!-- end slider navigation -->
                </div>
            </div>
            <div class="col-xl-8 col-lg-9">
                <div class="swiper position-relative magic-cursor" data-slider-options='{ "autoHeight": true, "loop": true, "allowTouchMove": true, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }, "effect": "slide" }'>
                    <div class="swiper-wrapper">
                        <!-- start text slider item -->
                        <div class="swiper-slide review-style-11">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                    <img src="https://placehold.co/350x335" alt="">
                                </div>
                                <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                    <p class="fs-20 lh-28 text-dark-gray mb-20px">Our Africa travel specialist planned the most <span class="text-decoration-line-bottom fw-600">amazing trip</span> to kenya for us. We had an <span class="text-decoration-line-bottom fw-600">incredible time</span> and were able to capture so many awesome pictures.</p>
                                    <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                        <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                            <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Alexander moore</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end text slider item -->
                        <!-- start text slider item -->
                        <div class="swiper-slide review-style-11">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                    <img src="https://placehold.co/350x335" alt="">
                                </div>
                                <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                    <p class="fs-20 lh-28 text-dark-gray mb-20px">Excellent travel company. We have already <span class="text-decoration-line-bottom fw-600">recommended</span> it to our family and friends. We are looking forward to our <span class="text-decoration-line-bottom fw-600">next trip.</span> Everything was very well organized.</p>
                                    <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                        <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                            <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Matthew taylor</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end text slider item -->
                        <!-- start text slider item -->
                        <div class="swiper-slide review-style-11">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                    <img src="https://placehold.co/350x335" alt="">
                                </div>
                                <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                    <p class="fs-20 lh-28 text-dark-gray mb-20px">This itinerary was a perfect <span class="text-decoration-line-bottom fw-500">combination</span> of city sights, history and culture together with the peace of the <span class="text-decoration-line-bottom fw-500">amazon rainforest</span> and the adventure.</p>
                                    <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                        <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                            <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Herman miller</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end text slider item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- end section -->
<section class="bg-very-light-gray background-position-center-top background-no-repeat overlap-height" style="background-image:url('web/images/demo-travel-agency-home-bg-04.png');">
    <div class="container overlap-gap-section">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-base-color text-uppercase d-inline-block">Inspiring story</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Travel blogs</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="blog-modern blog-wrapper grid-loading grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <li class="grid-sizer"></li>
                    <!-- start blog item -->
                    <li class="grid-item md-mb-20px">
                        <div class="box-hover text-center">
                            <figure class="mb-0 position-relative">
                                <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                    <a href="demo-travel-agency-blog-single-modern.html"><img src="https://placehold.co/800x1015" alt="" /></a>
                                </div>
                                <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                    <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                        <a href="demo-travel-agency-blog-single-modern.html" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">It takes a real designer to design for real women</a>
                                        <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                    </div>
                                    <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial"><span class="d-inline-block">By <a href="demo-travel-agency-blog.html">Rosald smith</a></span><span class="separator d-inline-block">|</span><a href="#">26 Nov 2023</a></div>
                                </figcaption>
                            </figure>
                        </div>
                    </li>
                    <!-- end blog item -->
                    <!-- start blog item -->
                    <li class="grid-item md-mb-20px">
                        <div class="box-hover text-center">
                            <figure class="mb-0 position-relative">
                                <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                    <a href="demo-travel-agency-blog-single-modern.html"><img src="https://placehold.co/800x1015" alt="" /></a>
                                </div>
                                <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                    <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                        <a href="demo-travel-agency-blog-single-modern.html" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">Experience breathtaking views and perspectives</a>
                                        <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                    </div>
                                    <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial"><span class="d-inline-block">By <a href="demo-travel-agency-blog.html">Andy glamere</a></span><span class="separator d-inline-block">|</span><a href="#">22 Nov 2023</a></div>
                                </figcaption>
                            </figure>
                        </div>
                    </li>
                    <!-- end blog item -->
                    <!-- start blog item -->
                    <li class="grid-item">
                        <div class="box-hover text-center">
                            <figure class="mb-0 position-relative">
                                <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                    <a href="demo-travel-agency-blog-single-modern.html"><img src="https://placehold.co/800x1015" alt="" /></a>
                                </div>
                                <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                    <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                        <a href="demo-travel-agency-blog-single-modern.html" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">Teamwork is essential for small teams to challenges</a>
                                        <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                    </div>
                                    <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial"><span class="d-inline-block">By <a href="demo-travel-agency-blog.html">Den viliamson</a></span><span class="separator d-inline-block">|</span><a href="#">18 Nov 2023</a></div>
                                </figcaption>
                            </figure>
                        </div>
                    </li>
                    <!-- end blog item -->
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- start section -->
<!-- start footer -->
<footer class="bg-light-gray pb-40px">
    <div class="container">
        <div class="row mb-2 md-mb-4 overlap-section" data-anime='{ "el": "childs", "translateY": [-15, 0], "scale": [0.5, 1], "opacity": [0,1], "duration": 800, "delay": 300, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12 text-center">
                <img class="rounded-circle" src="web/images/demo-travel-agency-home-16.png" alt="" />
            </div>
        </div>
        <!-- start subscribe item -->
        <div class="row justify-content-center mb-6 md-mb-8 xs-mb-40px">
            <div class="col-xl-6 col-lg-8 col-md-10 text-center last-paragraph-no-margin">
                <h2 class="text-dark-gray alt-font fw-600 mb-40px mx-auto w-90 ls-minus-2px">Get the amazing travel offers into your inbox!</h2>
                <div class="d-inline-block w-100 newsletter-style-03 position-relative mb-30px">
                    <form action="email-templates/subscribe-newsletter.php" method="post" class="position-relative w-100">
                        <input class="input-large bg-white border-color-transparent w-100 border-radius-100px box-shadow-extra-large form-control required" type="email" name="email" placeholder="Enter your email address" />
                        <input type="hidden" name="redirect" value="">
                        <button class="btn btn-large text-dark-gray ls-0px left-icon submit fw-600" aria-label="submit"><i class="icon feather icon-feather-mail icon-small text-base-color"></i><span>Subscribe</span></button>
                        <div class="form-results border-radius-100px pt-10px pb-10px ps-15px pe-15px fs-16 mt-10px w-100 z-index-1 text-center position-absolute d-none"></div>
                    </form>
                </div>
                <p class="fs-16 lh-normal">We are committed to protecting your <a href="#" class="text-decoration-line-bottom text-dark-gray text-dark-gray-hover">privacy policy.</a></p>
            </div>
        </div>
        <!-- end subscribe item -->
        <!-- start instagram -->
        <div class="row align-items-center justify-content-center mb-40px g-0 row-cols-3 row-cols-md-6 row-cols-sm-3 instagram-follow-api position-relative">
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="col instafeed-grid">
                <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
            </div>
            <div class="absolute-middle-center z-index-1 w-auto">
                <a href="https://www.instagram.com" target="_blank" class="btn btn-medium btn-switch-text btn-white btn-round-edge fw-600 ls-0px left-icon btn-box-shadow instagram-button">
                            <span>
                                <span><i class="fa-brands fa-instagram text-base-color fs-20"></i></span>
                                <span class="btn-double-text" data-text="crafto instagram">crafto instagram</span>
                            </span>
                </a>
            </div>
        </div>
        <!-- end instagram -->
        <div class="row align-items-center">
            <div class="col-xl-3 col-sm-6 text-center text-sm-start last-paragraph-no-margin fs-15 text-dark-gray order-3 order-md-1">
                <p>&COPY; Copyright 2024 <a href="index.html" target="_blank" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom fw-600">Crafto</a></p>
            </div>
            <div class="col-xl-6 text-center lg-mt-10px sm-mt-0 sm-mb-15px order-1 order-xl-2 order-md-3">
                <ul class="footer-navbar">
                    <li class="nav-item"><a href="demo-travel-agency-about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="demo-travel-agency-destinations.html" class="nav-link">Destinations</a></li>
                    <li class="nav-item"><a href="demo-travel-agency-tours.html" class="nav-link">Tours</a></li>
                    <li class="nav-item"><a href="demo-travel-agency-reviews.html" class="nav-link">Reviews</a></li>
                    <li class="nav-item"><a href="demo-travel-agency-blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="demo-travel-agency-contact.html" class="nav-link">Contact</a></li>
                </ul>
            </div>
            <div class="col-xl-3 col-sm-6 position-relative text-center text-sm-end elements-social social-text-style-08 order-2 order-xl-3 xs-mb-10px">
                <ul class="small-icon dark">
                    <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i></a></li>
                    <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
    <a href="#" class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </a>
</div>
<!-- end scroll progress -->
<!-- javascript libraries -->
<!-- javascript libraries -->
<script type="text/javascript" src="{{ asset('web/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/vendors.min.js') }}"></script>

<!-- slider revolution core javaScript files -->
{{--<script type="text/javascript" src="{{ asset('web/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>--}}

<!-- slider revolution extension scripts. ONLY NEEDED FOR LOCAL TESTING -->
{{--<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>--}}
<!-- Slider Revolution add on files -->
{{--<script type='text/javascript' src="{{ asset('web/revolution/revolution-addons/particles/js/revolution.addon.particles.min.js?ver=1.0.3') }}"></script>--}}
<!-- Slider's main "init" script -->


<script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

@stack('js')
</body>
</html>
