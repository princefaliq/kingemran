@php
    $foto_spa_1 = !empty($settings['foto_spa_1'])
        ?  asset('storage/' .$settings['foto_spa_1'])
        : asset('web/images/demo-lawyer.jpg');
    $foto_spa_2 = !empty($settings['foto_spa_2'])
        ?  asset('storage/' .$settings['foto_spa_2'])
        : asset('web/images/demo-lawyer.jpg');
@endphp
<!-- start section -->
<section class="background-repeat" style="background-image:url('/images/bg.png');">
    <div class="container">
        <div class="row align-items-center mb-10 md-mb-17 xs-mb-25">
            <div class="col-xl-5 col-lg-6 md-mb-70px sm-mb-45px">
                <span class="fs-15 mb-15px text-base-color fw-500 d-block text-uppercase ls-2px" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 100, "easing": "easeOutQuad" }'>About Spa & Beauty</span>
                <h3 class="alt-font ls-minus-1px text-base-color w-80 xl-w-90 md-w-100" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay": 0, "duration": 600, "staggervalue": 100, "easing": "easeOutQuad" }'>{{ $settings['motto'] }}</h3>
                <p class="w-80 md-w-100 mb-40px" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay": 200, "duration": 600, "staggervalue": 100, "easing": "easeOutQuad" }'>{!! $settings['about'] !!}</p>
                <div class="d-inline-block w-100" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1],  "delay":300, "duration": 600, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <a href="{{ url('tentang-kami') }}" class="btn btn-small btn-double-border btn-border-color-white me-25px xs-me-15px">
                        <span>
                            <span class="btn-double-text text-light" data-text="Explorer More">Explorer More</span>
                            <span><i class="fa-solid fa-arrow-right text-light"></i></span>
                        </span>
                    </a>
                    <div class="fw-500 d-inline-block align-middle text-light fs-18 xs-mt-20px xs-mb-20px"><i class="bi bi-telephone-outbound icon-small me-10px"></i><a class="text-light" href="tel:{{ $settings['kontak_telepon'] }}">{{ $settings['kontak_telepon'] }}</a></div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 position-relative offset-lg-1 offset-md-2">
{{--                <span class="position-absolute fs-75 left-20px top-80px text-gold-light fw-600 z-index-1 ls-minus-4px lg-top-40px"  data-anime='{ "opacity": [0,1], "duration": 600, "delay": 1000, "staggervalue": 100, "easing": "easeOutQuad" }'><span class="fs-15 d-table lh-16 text-uppercase text-medium-gray fw-500 ls-1px">Started in</span>1995</span>--}}
                <div class="w-80 overflow-hidden position-relative md-w-90 border-radius-6px float-end" data-anime='{ "effect": "slide", "color": "#F1D27A", "direction":"rl", "easing": "easeOutQuad", "duration": 600, "delay":500}'>
                    <img class="w-100" src="{{ $foto_spa_1 }}" alt="" >
                </div>
                <div class="position-absolute left-minus-70px bottom-minus-30px w-60 overflow-hidden md-left-minus-100px sm-left-15px" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)" data-anime='{ "effect": "slide", "color": "#D4AF37", "direction":"lr", "easing": "easeOutQuad", "duration": 600, "delay":500}'>
                    <img class="w-100 border-radius-6px" src="{{ $foto_spa_2 }}" alt="">
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 text-center text-sm-start">

            <div class="col sm-mb-30px">
                <h2 class="fw-600 text-base-color m-0">{{ number_format($totalVisitors) }}</h2>
                <p class="text-light">Total Visitor</p>
            </div>

            <div class="col sm-mb-30px">
                <h2 class="fw-600 text-base-color m-0">{{ number_format($todayVisitors) }}</h2>
                <p class="text-light">Visitor Hari Ini</p>
            </div>

            <div class="col sm-mb-30px">
                <h2 class="fw-600 text-base-color m-0">{{ number_format($monthVisitors) }}</h2>
                <p class="text-light">Visitor Bulan Ini</p>
            </div>

            <div class="col">
                <h2 class="fw-600 text-base-color m-0">{{ number_format($yearVisitors) }}</h2>
                <p class="text-light">Visitor Tahun Ini</p>
            </div>

        </div>

    </div>
</section>
<!-- end section -->
