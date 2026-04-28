
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
@include('frontend.partials.footer')
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
