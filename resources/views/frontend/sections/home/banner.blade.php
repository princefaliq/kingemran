
<!-- start section -->
{{--<section class="section-dark p-0 bg-dark-gray">
    <div class="swiper lg-no-parallax magic-cursor  full-screen md-h-600px sm-h-500px ipad-top-space-margin swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "parallax": true, "speed": 1000, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <!-- start slider item -->
            <div class="swiper-slide overflow-hidden">
                <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url({{ url($banner->image_url) }});">
                    <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                    <div class="container h-100" data-swiper-parallax="-500">
                        <div class="row align-items-center h-100">
                            <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                --}}{{--<div>
                                    <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Best solutions for your business</span>
                                </div>--}}{{--
                                @if(!empty($banner->text))
                                    <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">
                                        {!! nl2br(e($banner->text)) !!}</h1>
                                @endif

                                --}}{{--<a href="index.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Get started now<span class="bg-white text-base-color"><i class="fas fa-arrow-right"></i></span></a>--}}{{--
                            </div>
                        </div>
                        <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                    </div>
                </div>
            </div>
            <!-- end slider item -->
            @endforeach
        </div>
        <!-- start slider pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        <!-- end slider pagination -->
        <!-- start slider navigation -->
        <!--<div class="slider-one-slide-prev-1 icon-extra-large text-white swiper-button-prev slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutLeft"></i></div>
            <div class="slider-one-slide-next-1 icon-extra-large text-white swiper-button-next slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutRight"></i></div>-->
        <!-- end slider navigation -->
    </div>
</section>--}}
<!-- end section -->
<!-- start banner slider -->
<section class="p-0 bg-base-color">
    <div class="swiper full-screen ipad-top-space-margin md-h-600px sm-h-500px swiper-number-pagination-style-01 magic-cursor drag-cursor base-color" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-number", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 5000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "fade" }' data-number-pagination="1" data-anime-text='{ "translateY": [50,0], "opacity": [0,1], "easing": "easeOutQuad", "duration": 500, "delay": { "staggervalue": 20 } }'>
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide">
                <div class="position-absolute left-0px top-0px w-100 h-100 cover-background" style="background-image:url({{ asset($banner->image_url) }});" data-anime='{ "translateY": [0, 0], "opacity": [1,1], "scale": [1,1.1], "duration": 7000, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'></div>
                <div class="opacity-light bg-gradient-nero-grey-brown"></div>
                <div class="container h-100">
                    <div class="row align-items-center h-100 justify-content-center">
                        <div class="col-xl-8 col-lg-9 position-relative text-white text-center">
                            <span class="fs-15 d-block mb-15px ls-4px text-uppercase" data-anime='{ "opacity": [0, 1], "easing": "easeOutCubic", "duration": 500, "delay": 200 }'>Omah Chantik Spa & Salon</span>
                            <div class="alt-font fs-80 sm-fs-60 xs-fs-50 mb-40px w-80 lg-w-100 md-w-90 sm-w-100 mx-auto sm-mb-35px anime-text ls-minus-2px" data-fancy-text='{ "opacity": [0, 1], "translateY": [50, 0], "string": ["{!! nl2br(e($banner->text)) !!}"], "duration": 500, "delay": 200, "speed": 10, "easing": "easeOutQuad" }'></div>
                            {{--<a href="/" class="btn btn-medium fw-500 btn-double-border btn-border-color-transparent-white" data-anime='{ "opacity": [0, 1], "easing": "easeOutCubic", "delay": 800, "duration": 800 }'>
                                <span>
                                    <span class="btn-double-text" data-text="Book appointment">Book appointment</span>
                                </span>
                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <!-- start slider pagination -->
        <div class="swiper-pagination container right-0px text-center swiper-pagination-clickable swiper-number fs-14 xs-w-100"></div>
        <!-- end slider pagination -->
        <!-- start slider navigation -->
        <div class="slider-one-slide-prev-1 icon-very-small text-white swiper-button-prev slider-navigation-style-06 bg-black-transparent-light h-55px w-55px d-none d-sm-flex border-radius-100"><i class="fa-solid fa-chevron-left"></i></div>
        <div class="slider-one-slide-next-1 icon-very-small text-white swiper-button-next slider-navigation-style-06 bg-black-transparent-light h-55px w-55px d-none d-sm-flex border-radius-100"><i class="fa-solid fa-chevron-right"></i></div>
        <!-- end slider navigation -->
    </div>
</section>
<!-- end banner slider -->
