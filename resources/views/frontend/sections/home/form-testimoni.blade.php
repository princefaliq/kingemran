<!-- start parallax style-1 -->
<section class="position-relative overlap-height" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/kakbah_bg.png') }});">
    <div class="opacity-extra-medium bg-gradient-gulf-blue-sepia-brown"></div>
    <div class="container overlap-gap-section">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-8 col-lg-10 position-relative text-center parallax-scrolling-style-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-white text-uppercase mb-5px d-inline-block ls-1px">Menuju Tanah Suci dengan tenang</span>
                <h1 class="text-white mx-auto alt-font fw-500 mb-40px ls-minus-2px">Kami hadir menemani setiap langkah ibadah Anda.</h1>
                <a href="#explore" class="section-link d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-base-color"><i class="bi bi-arrow-down-short text-white icon-medium d-flex"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- end parallax style-1 -->
<!-- start section -->
<section id="explore" class="cover-background overflow-visible" style="background-image: url({{ asset('images/demo-travel-agency-home-bg-03.jpg') }});">
    <div class="container overlap-section">
        <div class="row row-cols-1 row-cols-xl-5 row-cols-md-5 row-cols-sm-3 bg-white border-radius-6px mx-0 ps-8 pe-8 lg-ps-3 lg-pe-3 pt-4 pb-4 sm-pt-8 sm-pb-8 xs-pt-15 xs-pb-40px align-items-center mb-7 xs-mb-50px justify-content-center" data-anime='{ "el": "childs", "translateX": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col text-center border-end border-color-extra-medium-gray sm-mb-40px xs-border-end-0">
                <img src="{{ asset('images/masjidil_haram.png') }}" class="mb-10px w-70px d-block mx-auto" style="max-height: 140px" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Masjidil Haram</span>
            </div>
            <div class="col text-center border-end border-color-extra-medium-gray sm-mb-40px xs-border-end-0">
                <img src="{{ asset('images/masjid_nabawi.png') }}" class="mb-10px w-70px d-block mx-auto" style="max-height: 140px" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Masjid Nabawi</span>
            </div>
            <div class="col text-center border-end border-color-extra-medium-gray xs-border-end-0 xs-mb-40px">
                <img src="{{ asset('images/perjalanan_ibadah.png') }}" class="mb-10px w-70px d-block mx-auto" style="max-height: 140px" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Perjalanan Ibadah</span>
            </div>
            <div class="col text-center border-end sm-border-end-0 border-color-extra-medium-gray sm-mb-40px">
                <img src="{{ asset('images/kota_makkah.png') }}" class="mb-10px w-70px d-block mx-auto" style="max-height: 140px" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Kota Makkah</span>
            </div>
            <div class="col text-center">
                <img src="{{ asset('images/kota_madinah.png') }}" class="mb-10px w-70px d-block mx-auto" style="max-height: 140px" alt="" />
                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px">Kota Madinah</span>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <div class="col-lg-3 md-mb-20px text-center text-lg-start">
                <span class="fw-500 text-base-color text-uppercase">Pengalaman</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Jamaah Kami</h2>
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
                        @forelse($testimonials as $item)
                        <!-- start text slider item -->
                        <div class="swiper-slide review-style-11">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                    <img src="{{ $item->image_url ?? 'https://placehold.co/350x335'}}" style="max-height: 350px" alt="">
                                </div>
                                <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                    <p class="fs-20 lh-28 text-dark-gray mb-20px">{{ $item->content }}</p>
                                    <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                        <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                            <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end text slider item -->
                        @empty
                            <div class="swiper-slide text-center">
                                <h6 class="alt-font lh-40 text-dark-gray mb-20px">
                                    Belum ada testimoni yang ditampilkan.
                                </h6>
                                <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">
                                    King Emran
                                </span>
                                <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">
                                    Testimoni Pengunjung
                                </span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

