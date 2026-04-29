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
                        @forelse($testimonials as $item)
                            <div class="swiper-slide text-center">
                                <h6 class="alt-font lh-40 text-dark-gray mb-20px">
                                    {{ $item->content }}
                                </h6>
                                <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">
                                    {{ $item->name }}
                                </span>
                                                    <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">
                                    {{ $item->spaProgram->nama_paket ?? '-' }}
                                </span>
                            </div>
                        @empty
                            <div class="swiper-slide text-center">
                                <h6 class="alt-font lh-40 text-dark-gray mb-20px">
                                    Belum ada testimoni yang ditampilkan.
                                </h6>
                                <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">
                                    Chantik Spa & Salon
                                </span>
                                <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">
                                    Testimoni Pengunjung
                                </span>
                            </div>
                        @endforelse
                    </div>

                </div>
                <!-- start slider navigation -->
                <div class="swiper-button-previous-nav swiper-button-prev slider-custom-text-prev fs-14 text-uppercase text-dark-gray fw-500 ls-1px">prev</div>
                <div class="swiper-button-next-nav swiper-button-next  slider-custom-text-next fs-14 text-uppercase text-dark-gray fw-500 ls-1px">next</div>
                <!-- end slider pagination -->
            </div>
            <div class="row justify-content-center mb-5 mt-4">
                <div class="col-auto text-center">
                    <a href="{{ route('testimonials.create') }}" class="btn btn-medium btn-dark-gray btn-round-edge">
                        Kirim Testimoni
                    </a>
                </div>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-lg-6 row-cols-sm-3 text-center justify-content-center clients-style-05"
             data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>

            @forelse($partners as $partner)
                <div class="col md-mb-30px">
                    <div class="client-box">
                        @if($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('storage/' . $partner->logo) }}" title="{{ $partner->name }}" class="h-110px" alt="{{ $partner->name }}">
                            </a>
                        @else
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="h-110px" alt="{{ $partner->name }}">
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Belum ada partner yang ditampilkan.
                </div>
            @endforelse

        </div>

    </div>
</section>
<!-- end section -->
