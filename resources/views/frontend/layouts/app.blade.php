
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
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ url('/web/css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/demos/spa-salon/spa-salon.css') }}" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4GLR97Q4PK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4GLR97Q4PK');
    </script>
    <style>
        body {
            color: var(--very-light-gray);
        }
    </style>
    @stack('css')
</head>
<body class="overflow-x-hidden" data-mobile-nav-style="classic">
<!-- start header -->
@include('frontend.partials.navbar')
<!-- end header -->
@yield('content')


<!-- start section -->
<section class="background-repeat border-top border-color-light-gray position-relative overlap-height z-index-1" style="background-image:url('/images/bg.png');">
    <div class="position-absolute right-minus-50px overlap-section z-index-minus-1 d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/demo-spa-salon-bg-img-02.webp') }}" alt="">
    </div>
    <div class="position-absolute left-minus-100px top-50 z-index-minus-1 d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/demo-spa-salon-bg-img-03.png') }}"  alt="">
    </div>
    <div class="container overlap-gap-section">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-6 col-md-8 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1],  "delay":0, "duration": 600, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Luxury services</span>
                <h3 class="alt-font ls-minus-1px text-dark-gray w-65 xl-w-80 sm-w-100 mx-auto">Explore our spa and body services</h3>
            </div>
        </div>
        <div class="row mb-5 xs-mb-15px">
            <div class="col-12 position-relative">
                <div class="outside-box-right-40 sm-outside-box-right-0">
                    <div class="swiper magic-cursor drag-cursor" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 3000, "disableOnInteraction": false },  "pagination": { "el": ".slider-three-slide-pagination", "clickable": true, "dynamicBullets": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                        <div class="swiper-wrapper pt-20px pb-20px">
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Beauty</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img overflow-hidden">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">01</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Therapy</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">02</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Massage</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">03</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Beauty</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img overflow-hidden">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">01</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Therapy</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">02</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                            <!-- start slider item -->
                            <div class="swiper-slide">
                                <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover">
                                    <div class="col-sm-6 position-relative bg-very-light-gray p-10 xxl-p-6 xs-p-10">
                                        <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                            <img class="w-75px lg-w-65px" src="https://placehold.co/150x150" alt="">
                                        </div>
                                        <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                            <span class="d-inline-block alt-font text-dark-gray fs-24 mb-5px">Massage</span>
                                            <p class="text-light-opacity lh-30">Bring brighter and younger looking skin.</p>
                                        </div>
                                        <div class="box-overlay bg-dark-gray"></div>
                                    </div>
                                    <div class="col-sm-6 services-box-img">
                                        <div class="h-100 cover-background position-relative xs-h-300px" style="background-image: url(https://placehold.co/580x705)">
                                            <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">03</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider item -->
                        </div>
                    </div>
                </div>
                <!-- start slider pagination -->
                <!--<div class="swiper-pagination slider-three-slide-pagination swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                <!-- end slider pagination -->
            </div>
        </div>
        <div class="row mb-5 xs-mb-8">
            <div class="col-12 text-center">
                <h5 class="alt-font text-dark-gray">Revitalize your senses and refresh? <a href="demo-spa-salon-packages.html" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom">Explore package</a></h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <ul class="pricing-table-style-12 pe-15px md-pe-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Makeup & massage</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>43</div>
                            </div>
                            <p>50 Minute relaxation massage.</p>
                        </div>
                    </li>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Relaxing head</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>45</div>
                            </div>
                            <p>One of the best ways to relax head.</p>
                        </div>
                    </li>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Geothermal spa</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>39</div>
                            </div>
                            <p>Comforting stimulating atmosphere.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="pricing-table-style-12 ps-15px md-ps-0 md-pt-20px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Body relaxation</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>35</div>
                            </div>
                            <p>Progressive muscle relaxation.</p>
                        </div>
                    </li>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Finnish sauna</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>55</div>
                            </div>
                            <p>Traditional finnish sauna experience.</p>
                        </div>
                    </li>
                    <li class="last-paragraph-no-margin">
                        <img src="https://placehold.co/120x120" class="w-120px border-radius-100" alt="">
                        <div class="ms-30px xs-ms-0 flex-grow-1">
                            <div class="d-flex align-items-center w-120 fs-18">
                                <span class="fs-22 alt-font text-dark-gray">Aromatherapy</span>
                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                <div class="ms-auto fs-26 alt-font text-dark-gray"><sub>$</sub>35</div>
                            </div>
                            <p>Using concentrated essential oils.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- start section -->
<section class="background-repeat border-top border-color-light-gray position-relative overlap-height z-index-1" style="background-image:url('/images/bg.png');">
    <div class="overlap-section text-center mb-6 z-index-minus-1 d-none d-md-block">
        <img src="{{ asset('images/logo_putih.png') }}" class="w-85px" alt="">
    </div>
    <div class="position-absolute right-minus-100px top-50 z-index-minus-1 d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/demo-spa-salon-bg-img-05.png') }}" alt="">
    </div>
    <div class="container overlap-gap-section">
        <div class="row align-items-center position-relative justify-content-center justify-content-lg-start">
            <div class="position-absolute left-0px top-0px h-100 w-130px d-none d-lg-inline-block">
                <div class="vertical-title-center align-items-center justify-content-center">
                    <div class="title fs-16 ls-2px text-uppercase">Spa therapy for <span class="text-dark-gray fw-600">rest</span> and <span class="text-dark-gray fw-600 fancy-text-style-4"><span data-fancy-text='{ "effect": "rotate", "string": ["Relaxation", "Enjoyment", "Happiness"], "speed": 50 }'></span> </span></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-11 position-relative offset-lg-1 md-mb-35px">
                <img src="https://placehold.co/480x630" class="w-100 border-radius-4px" alt="">
            </div>
            <div class="col-xl-5 col-lg-6 col-md-11 ps-8 md-ps-15px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fs-15 lg-10px mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Benefits of spa</span>
                <h3 class="alt-font ls-minus-1px text-dark-gray">100% natural and organic products.</h3>
                <p class="w-80 xl-w-90 md-w-100 mb-10px">Everybody is looking for places where to relax and get more energy. Revitalize your senses and refresh your mind.</p>
                <ul class="p-0 list-style-01 fs-20 alt-font mb-25px">
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Increased happiness</li>
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Promotes radiant skin</li>
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Promotes a better sleep</li>
                </ul>
                <div class="d-inline-block w-100">
                    <a href="demo-spa-salon-treatments.html" class="btn btn-small btn-double-border btn-border-base-color">
                        <span>
                            <span class="btn-double-text" data-text="View treatments">View treatments</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- start section -->
<section class="background-repeat p-0" style="background-image:url('/images/bg.png');">
    <div class="container-fluid p-0">
        <div class="row align-items-center g-0 justify-content-center">
            <div class="col">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
            <div class="col-5 col-lg-2 col-sm-3 text-center position-relative">
                <img src="web/images/demo-spa-salon-home-13.png" class="animation-rotation" alt="">
                <div class="absolute-middle-center lg-w-75"><img class="w-75" src="/favicon.png" alt=""></div>
            </div>
            <div class="col">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!-- start section -->
<section class="background-repeat overlap-height position-relative pt-4 md-pt-8" style="background-image:url('/images/bg.png');">
    <div class="position-absolute left-minus-100px top-50 d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/demo-spa-salon-bg-img-03.png') }}" alt="">
    </div>
    <div class="container overlap-gap-section">
        <div class="row justify-content-center mb-6 md-mb-8 xs-mb-40px">
            <div class="col-xl-10 testimonials-style-11 position-relative ps-15 pe-15 sm-ps-15px sm-pe-15px text-center">
                <div class="swiper slider-custom-text" data-slider-options='{ "loop": true, "keyboard": { "enabled": true, "onlyInViewport": true }, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav", "effect": "fade" } }'>
                    <div class="swiper-wrapper">
                        <!-- start testimonial item -->
                        <div class="swiper-slide text-center">
                            <h6 class="alt-font lh-40 text-dark-gray mb-20px">The wonderful services you offer locally are great for our community. People are tired of having to travel out of town for things.</h6>
                            <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">Jonsan donner</span>
                            <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">Relax massage</span>
                        </div>
                        <!-- end testimonial item -->
                        <!-- start testimonial item -->
                        <div class="swiper-slide text-center">
                            <h6 class="alt-font lh-40 text-dark-gray mb-20px">This place is beautiful. The outside, the inside, staff communication is all on point! The staff is very friendly, informative and patient.</h6>
                            <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">Lauren cruikshank</span>
                            <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">Relax massage</span>
                        </div>
                        <!-- end testimonial item -->
                        <!-- start testimonial item -->
                        <div class="swiper-slide text-center">
                            <h6 class="alt-font lh-40 text-dark-gray mb-20px">The ambiance as soon as you enter puts you at ease immediately. The staff is so sweet and generous and the services they offer are to die for!</h6>
                            <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">Rosemary downing</span>
                            <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">Scalp massage</span>
                        </div>
                        <!-- end testimonial item -->
                    </div>
                </div>
                <!-- start slider navigation -->
                <div class="swiper-button-previous-nav swiper-button-prev slider-custom-text-prev fs-14 text-uppercase text-dark-gray fw-500 ls-1px">prev</div>
                <div class="swiper-button-next-nav swiper-button-next  slider-custom-text-next fs-14 text-uppercase text-dark-gray fw-500 ls-1px">next</div>
                <!-- end slider pagination -->
            </div>
        </div>
        <div class="row row-cols-2 row-cols-lg-6 row-cols-sm-3 text-center justify-content-center clients-style-05" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
            <!-- start client item -->
            <div class="col md-mb-30px">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
            <!-- start client item -->
            <div class="col md-mb-30px">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
            <!-- start client item -->
            <div class="col md-mb-30px">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
            <!-- start client item -->
            <div class="col xs-mb-30px">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
            <!-- start client item -->
            <div class="col">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
            <!-- start client item -->
            <div class="col">
                <div class="client-box">
                    <a href="#"><img src="https://placehold.co/165x205" class="h-110px" alt=""></a>
                </div>
            </div>
            <!-- end client item -->
        </div>
    </div>
</section>
<!-- end section -->
<!-- start footer -->
<footer class="half-footer pb-45px border-top border-color-light-gray background-repeat" style="background-image:url('/images/bg.png');">
    <div class="container">
        <div class="overlap-section position-absolute left-0px right-0px text-center d-none d-md-inline-block" data-anime='{ "el": "childs", "translateY": [0, 0], "scale": [0.7, 1], "rotateZ": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <img src="favicon.png" alt="" class="lg-w-20 h-280px">
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin me-auto z-index-1 text-center text-sm-start xs-mb-20px">
                <span class="fs-20 fw-500 text-dark-gray d-block mb-5px">Studio location</span>
                <p class="w-100">401 Broadway, 24th Floor<br>New York, NY 10013.</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin text-center text-sm-end z-index-1">
                <span class="fs-20 fw-500 text-dark-gray d-block mb-5px">How can we help?</span>
                <a href="mailto:info@yourdomain.com">info@yourdomain.com</a><br>
                <a href="mailto:hr@yourdomain.com">hr@yourdomain.com</a>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-20px mb-10px md-mb-20px">
            <div class="col d-none d-md-flex">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 text-center elements-social social-icon-style-04">
                <ul class="large-icon dark mb-0">
                    <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                    <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i><span></span></a></li>
                    <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>
                    <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                    <li><a class="linkedin" href="http://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
                </ul>
            </div>
            <div class="col d-none d-md-flex">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 last-paragraph-no-margin text-center text-md-start sm-mb-10px">
                <p>&COPY; 2024 <a href="index.html" target="_blank" class="text-decoration-line-bottom text-dark-gray fw-500">Crafto.</a> All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end last-paragraph-no-margin">
                <p>Proudly Powered by <a href="https://www.themezaa.com/" target="_blank" class="text-decoration-line-bottom text-dark-gray fw-500">ThemeZaa</a></p>
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
<script type="text/javascript" src="{{ asset('web/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

@stack('js')
</body>
</html>
