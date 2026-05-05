@push('css')
    <style>
        .text-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
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

                        @foreach($packages as $item)
                            <div class="swiper-slide d-flex">
                                <div class="overflow-hidden border-radius-6px box-shadow-large w-100">
                                    <div class="image">
                                        <a href="{{ route('tour.show', $item->slug) }}">
                                            <img class="w-100"
                                                 src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://placehold.co/800x655' }}"
                                                 alt="{{ $item->title }}">
                                        </a>
                                    </div>

                                    <div class="bg-white p-35px position-relative d-flex flex-column flex-grow-1">

                                        <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-golden-yellow position-absolute right-0px top-0px">
                                            {{ $item->duration }} {{ $item->duration_type }}
                                        </div>

                                        <div class="fs-24 fw-700 text-dark-gray">
                                            <span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Start From</span>

                                            {{ $item->currency }} {{ number_format($item->price_discount,0,',','.') }}
                                            <br>
                                            @if($item->price)
                                                <span class="ms-5px position-relative text-red fs-19 fw-500">
                                                    {{ $item->currency }} {{ number_format($item->price,0,',','.') }}
                                                    <span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span>
                                                </span>
                                            @endif
                                        </div>

                                        <a href="{{ route('tour.show', $item->slug) }}"
                                           class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block flex-grow-1">
                                            {{ $item->title }}
                                        </a>


                                        <div class="d-flex align-items-center pt-15px mt-20px border-top border-color-extra-medium-gray">
                                            <span class="fw-500 fs-14 d-inline-block text-uppercase">
                                                {{ $item->reviews_count }} Reviews
                                            </span>

                                            <div class="review-star-icon ms-auto text-golden-yellow">
                                                @php
                                                    $rating = round($item->avg_rating ?? 5);
                                                @endphp

                                                @for($i=1; $i<=5; $i++)
                                                    <i class="bi bi-star-fill {{ $i <= $rating ? '' : 'opacity-25' }}"></i>
                                                @endfor
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

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
