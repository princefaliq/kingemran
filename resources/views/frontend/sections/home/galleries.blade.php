
<!-- start section -->
<section class="big-section bg-solitude-blue overflow-hidden">
    <div class="container">
        <div class="row align-items-center justify-content-center mb-5 sm-mb-30px text-center text-lg-start">
            <div class="col-xl-5 col-lg-5 md-mb-20px" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <h4 class="text-dark-gray fw-700 mb-0 ls-minus-1px">Galeri Video & Foto</h4>
            </div>
            <div class="col-xl-5 col-lg-5 last-paragraph-no-margin md-mb-30px" data-anime='{ "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <p class="w-90 xl-w-100 md-w-80 sm-w-100 md-mx-auto">Dokumentasi foto dan video kegiatan yang menampilkan berbagai aktivitas sebagai bentuk informasi kepada publik luas</p>
            </div>
            <div class="col-xl-2 col-lg-2 d-flex justify-content-center justify-content-lg-end" data-anime='{ "el": "childs", "translateX": [30, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <!-- start slider navigation -->
                <div class="slider-one-slide-prev-02 icon-small text-dark-gray swiper-button-prev slider-navigation-style-04 bg-white text-dark-gray box-shadow-large"><i class="fa-solid fa-arrow-left"></i></div>
                <div class="slider-one-slide-next-02 icon-small text-dark-gray swiper-button-next slider-navigation-style-04 bg-white text-dark-gray box-shadow-large"><i class="fa-solid fa-arrow-right"></i></div>
                <!-- end slider navigation -->
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 position-relative">
                <div class="outside-box-right-40 xs-outside-box-right-0" data-anime='{ "translateX": [100, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="swiper magic-cursor" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 28, "loop": true, "autoplay": { "delay": 2000, "disableOnInteraction": false }, "pagination": { "el": ".slider-four-slide-pagination-1", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-02", "prevEl": ".slider-one-slide-prev-02" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 5 }, "992": { "slidesPerView": 4 }, "768": { "slidesPerView": 3 }, "576": { "slidesPerView": 2 } }, "effect": "slide" }'>
                        <div class="swiper-wrapper">
                            @foreach($gallerie as $item)
                            <!-- start content carousal item -->
                            <div class="swiper-slide">
                                <div class="interactive-banner-style-08">
                                    <div class="gallery-box">

                                        @if($item->type == 'image')
                                            {{-- jika upload gambar --}}
                                            <a href="{{ asset('storage/'.$item->image) }}" data-group="lightbox-gallery">
                                                <div class="feature-box-icon position-relative">
                                                    <img class="custom-image-icon mt-30px mb-20px" style="aspect-ratio: 16/9;"
                                                         src="{{ asset('storage/'.$item->image) }}"
                                                         alt="{{ $item->title }}" />

                                                    <div class="d-flex align-items-center justify-content-center position-absolute top-0 w-100 h-100 gallery-hover move-bottom-top">
                                                        <i class="feather icon-feather-search icon-very-medium text-white"></i>
                                                    </div>
                                                </div>
                                            </a>

                                        @elseif($item->type == 'youtube')
                                            {{-- jika youtube --}}
                                            @php
                                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^?&]+)/', $item->youtube_url, $match);
                                                $youtubeId = $match[1] ?? null;
                                            @endphp

                                            <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" class="popup-youtube">
                                                <div class="feature-box-icon position-relative">
                                                    <img class="custom-image-icon mt-30px mb-20px " style="aspect-ratio: 16/9;"
                                                         src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                                                         alt="{{ $item->title }}" />

                                                    <div class="d-flex align-items-center justify-content-center position-absolute top-0 w-100 h-100 gallery-hover move-bottom-top">
                                                        <i class="feather icon-feather-play icon-very-medium text-white"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif

                                        <div class="feature-box-content last-paragraph-no-margin">
                                <span class="d-block fs-19 fw-500 mb-5px text-dark-gray">
                                    {{ $item->title }}
                                </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end content carousal item -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- start slider pagination -->
                <!--<div class="swiper-pagination slider-four-slide-pagination-1 swiper-pagination-style-2 swiper-pagination-clickable swiper-pagination-bullets"></div>-->
                <!-- end slider pagination -->
            </div>
        </div>
    </div>
</section>
<!-- end section -->
