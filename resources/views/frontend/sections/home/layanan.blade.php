@push('css')
    <style>
        .services-box-content p {
            display: -webkit-box;
            -webkit-line-clamp: 2; /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .services-box-style-02 {
            height: 350px!important;
        }
        .services-box-content {
            min-height: 70px!important;
        }
    </style>
@endpush
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
                <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Layanan Spa & Beauty</span>
                <h3 class="alt-font ls-minus-1px text-dark-gray w-65 xl-w-80 sm-w-100 mx-auto">Nikmati spa dan beauty care</h3>
            </div>
        </div>
        <div class="row mb-5 xs-mb-15px">
            <div class="col-12 position-relative">
                <div class="outside-box-right-40 sm-outside-box-right-0">
                    <div class="swiper magic-cursor drag-cursor" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 3000, "disableOnInteraction": false },  "pagination": { "el": ".slider-three-slide-pagination", "clickable": true, "dynamicBullets": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 }, "320": { "slidesPerView": 1 } }, "effect": "slide" }'>
                        <div class="swiper-wrapper pt-20px pb-20px">
                            @foreach($services as $index => $service)
                                <!-- start slider item -->
                                <div class="swiper-slide h-100">
                                    <div class="row g-0 services-box-style-02 border-radius-6px overflow-hidden hover-box dark-hover d-flex h-100">
                                        <div class="col-sm-6 d-flex flex-column justify-content-between h-100 position-relative bg-light p-10 xxl-p-6 xs-p-10">
                                            <div class="services-box-icon mb-65px position-relative z-index-9 lg-mb-30px">
                                                <img class="w-75px lg-w-65px" src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}">
                                            </div>
                                            <div class="services-box-content last-paragraph-no-margin position-relative z-index-9">
                                                <span class="d-inline-block alt-font text-dark fs-24 mb-5px">{{ $service->title }}</span>
                                                <p class="text-dark lh-30">{{ $service->subtitle }}</p>
                                            </div>
                                            <div class="box-overlay bg-base-color"></div>
                                        </div>
                                        <div class="col-sm-6 services-box-img overflow-hidden">
                                            <div class="h-100 w-100 cover-background position-relative xs-h-300px" style="background-image: url({{ asset('storage/' . $service->image) }})">
                                                <span class="position-absolute left-minus-30px bottom-50px fs-100 lg-fs-80 xs-fs-90 fw-600 text-very-light-gray xl-bottom-25px md-left-minus-20px">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end slider item -->
                            @endforeach
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
                <h5 class="alt-font text-dark-gray">Segarkan tubuh dan pikiran Anda? <a href="{{ url('/paket') }}" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom">Lihat paket perawatan</a></h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <ul class="pricing-table-style-12 pe-15px md-pe-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>

                    @foreach($chunks[0] ?? [] as $item)
                        <li class="last-paragraph-no-margin">
                            <img
                                src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://placehold.co/120x120' }}"
                                class="w-120px border-radius-100"
                                alt=""
                            >
                            <div class="ms-30px xs-ms-0 flex-grow-1">
                                <div class="d-flex align-items-center w-120 fs-18">
                                    <span class="fs-22 alt-font text-dark-gray">
                                        {{ $item->nama_paket }}
                                    </span>

                                    <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>

                                    <div class="ms-auto fs-26 alt-font text-dark-gray">
                                        <sub>Rp</sub>{{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                </div>

                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="pricing-table-style-12 ps-15px md-ps-0 md-pt-20px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>

                    @foreach($chunks[1] ?? [] as $item)
                        <li class="last-paragraph-no-margin">
                            <img
                                src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://placehold.co/120x120' }}"
                                class="w-120px border-radius-100"
                                alt=""
                            >
                            <div class="ms-30px xs-ms-0 flex-grow-1">
                                <div class="d-flex align-items-center w-120 fs-18">
                                    <span class="fs-22 alt-font text-dark-gray">
                                        {{ $item->nama_paket }}
                                    </span>

                                    <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>

                                    <div class="ms-auto fs-26 alt-font text-dark-gray">
                                        <sub>Rp</sub>{{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                </div>

                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
