@extends('frontend.layouts.app')
@section('title', $package->title )

@push('css')

@endpush

@section('content')
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url({{ asset('images/kakbah.png') }})">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Paket perjalanan</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">{{ $package->title }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="position-relative">
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset( 'web/images/demo-travel-agency-about-bg-02.png' ) }})"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 md-mb-50px sm-mb-35px">
                    <div class="row align-items-center mb-25px">
                        <div class="col-sm-6">
                            <h3 class="alt-font text-dark-gray fw-600 mb-10px ls-minus-1px">{{ $package->short_description }}</h3>
                            <ul class="p-0 m-0 list-style-02 d-block d-sm-flex">
                                <li class="text-dark-gray fw-500"><i class="bi bi-geo-alt icon-small me-5px"></i>{{ $package->location }}</li>
                                <li class="ms-20px xs-ms-0">
                                    <div class="review-star-icon fs-18 me-5px">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                    <a href="#reviews" class="text-dark-gray text-dark-gray-hover fw-500 d-inline-block section-link">{{ $package->testimonials->count() }} Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 text-sm-end xs-mt-10px">
                            <h4 class="text-dark-gray fw-600 mb-0">{{ $package->currency }} {{ number_format($package->price,0,',','.') }}</h4>
                            <span class="d-block lh-22">Per person</span>
                        </div>
                    </div>
                    <div class="row mb-50px xs-mb-40px">
                        <div class="col-12">
                            <ul class="p-0 list-style-02 d-flex flex-wrap border-top border-bottom border-color-extra-medium-gray pt-20px pb-20px mb-25px">
                                <li class="me-30px mb-1">
                                    <i class="bi bi-calendar-check text-base-color icon-extra-medium me-10px"></i>
                                    <span class="text-dark-gray fw-500">{{ $package->duration }} {{ ucfirst($package->duration_type) }}</span>
                                </li>

                                <li class="me-30px mb-1">
                                    <i class="bi bi-person-plus text-base-color icon-extra-medium me-10px"></i>
                                    <span class="text-dark-gray fw-500">{{ $package->quota }} Seat</span>
                                </li>

                                <li class="me-30px mb-1">
                                    <i class="bi bi-airplane text-base-color icon-extra-medium me-10px"></i>
                                    <span class="text-dark-gray fw-500">{{ $package->airline }}</span>
                                </li>

                                <li class="me-30px">
                                    <i class="bi bi-building text-base-color icon-extra-medium me-10px"></i>
                                    <span class="text-dark-gray fw-500">{{ $package->hotel }}</span>
                                </li>

                                <li>
                                    <i class="bi bi-geo-alt-fill text-base-color icon-extra-medium me-10px"></i>
                                    <span class="text-dark-gray fw-500">{{ $package->departure_city }}</span>
                                </li>
                            </ul>
                            <p><p>{!! nl2br(e($package->description)) !!}</p></p>
                            <img src="{{ asset($package->image_url) }}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600">Included / exclude</h5>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 mb-50px xs-mb-40px">

                        <div class="col">
                            <ul class="p-0 m-0 list-style-02 text-dark-gray sm-mb-20px">
                                @foreach($package->items->where('type','include') as $item)
                                    <li class="border-bottom border-color-extra-medium-gray pb-10px mb-10px">
                                        <i class="bi bi-check-circle-fill fs-22 text-green me-10px"></i>
                                        {{ $item->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col">
                            <ul class="p-0 m-0 list-style-02 text-dark-gray">
                                @foreach($package->items->where('type','exclude') as $item)
                                    <li class="border-bottom border-color-extra-medium-gray pb-10px mb-10px">
                                        <i class="bi bi-x-circle-fill fs-22 text-red me-10px"></i>
                                        {{ $item->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600">Photo gallery</h5>
                        </div>
                    </div>
                    <div class="row mb-50px xs-mb-40px">
                        <div class="col">
                            <ul class="image-gallery-style-01 gallery-wrapper grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-medium">
                                <li class="grid-sizer"></li>

                                @foreach($package->galleries as $gallery)
                                    <li class="grid-item transition-inner-all">
                                        <div class="gallery-box">

                                            @if($gallery->type == 'image')
                                                <a href="{{ asset($gallery->image_url) }}" data-group="lightbox-gallery">
                                                    <div class="position-relative gallery-image bg-dark-gray overflow-hidden">
                                                        <img src="{{ asset($gallery->image_url) }}" alt="">

                                                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 left-0 w-100 h-100 gallery-hover move-bottom-top">
                                                            <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-white">
                                                                <i class="feather icon-feather-search text-dark-gray icon-small"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            @elseif($gallery->type == 'youtube')

                                                @php
                                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^?&]+)/', $gallery->youtube_url, $match);
                                                    $youtubeId = $match[1] ?? null;
                                                @endphp

                                                @if($youtubeId)
                                                    <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" class="popup-youtube">
                                                        <div class="position-relative gallery-image bg-dark-gray overflow-hidden">
                                                            <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" style="max-height: 140px" alt="">

                                                            <div class="d-flex align-items-center justify-content-center position-absolute top-0 left-0 w-100 h-100 gallery-hover move-bottom-top">
                                                                <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-white">
                                                                    <i class="feather icon-feather-play text-dark-gray icon-small"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endif

                                            @endif

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600 sm-mb-15px">Itinerary</h5>
                        </div>
                        <div class="col-12">
                            <div class="accordion accordion-style-02" id="accordion-style-02" data-active-icon="icon-feather-chevron-down" data-inactive-icon="icon-feather-chevron-right">
                                @foreach($package->itineraries as $key => $itinerary)
                                    <div class="accordion-item {{ $key == 0 ? 'active-accordion' : '' }}">
                                        <div class="accordion-header border-bottom border-color-extra-medium-gray">
                                            <a href="" data-bs-toggle="collapse" data-bs-target="#itinerary{{ $itinerary->id }}">
                                                <div class="accordion-title d-flex align-items-center position-relative text-dark-gray mb-0">
                                                    <div class="col-auto bg-base-color lh-28 fw-600 text-golden-yellow text-uppercase border-radius-30px ps-15px pe-15px fs-12 me-15px d-inline-block align-middle">
                                                        Day {{ str_pad($itinerary->day,2,'0',STR_PAD_LEFT) }}
                                                    </div>
                                                    <i class="feather {{ $key == 0 ? 'icon-feather-chevron-down' : 'icon-feather-chevron-right' }}"></i>
                                                    <span class="fw-600 lh-normal">{{ $itinerary->title }}</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div id="itinerary{{ $itinerary->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}">
                                            <div class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                                <p>{{ $itinerary->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- end accordion item -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start sidebar -->
                <aside class="col-xl-3 col-lg-4 offset-xl-1 lg-ps-50px md-ps-15px">
                    <div class="position-sticky top-70px">
                        <div class="bg-very-light-gray contact-form-style-03 position-relative overflow-hidden p-40px lg-p-30px mb-30px">
                            <h5 class="alt-font text-dark-gray fw-600 mb-10px text-center">Book this tour</h5>

                                <div class="position-relative form-group mb-5px">
                                    <span class="form-icon"><i class="bi bi-emoji-smile icon-small"></i></span>
                                    <input class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required" name="name" type="text" placeholder="Your name*" id="nama"/>
                                </div>
                                <div class="position-relative form-group mb-5px">
                                    <span class="form-icon"><i class="bi bi-envelope icon-small"></i></span>
                                    <input class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required" type="email" name="email" placeholder="Your email*" id="email"/>
                                </div>
                                <div class="position-relative form-group form-textarea mb-0">
                                    <textarea class="ps-0 border-radius-0px border-bottom border-color-transparent-dark-very-light bg-transparent form-control" name="comment" placeholder="Your message" rows="2" id="pesan"></textarea>
                                    <span class="form-icon"><i class="bi bi-chat-square-dots icon-small"></i></span>
                                    <input type="hidden" name="redirect" value="">
                                    <button class="btn btn-medium btn-dark-gray btn-round-edge btn-box-shadow mt-25px w-100 submit" type="button" onclick="kirimWA()" aria-label="submit">Kirim via WhatsApp</button>
                                    <div class="form-results mt-20px d-none"></div>
                                </div>

                            <img src="{{ asset('/images/ornamen.png') }}" style="max-width: 66px" class="position-absolute top-0px right-0px" alt="" />
                        </div>
                        <a href="/"><img class="w-100" src="{{ asset('images/king_emran.png') }}" style="max-height: 363px" alt="" /></a>
                    </div>
                </aside>
                <!-- end sidebar -->
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <!-- start section -->
    <section id="reviews" class="position-relative bg-very-light-gray overlap-height cover-background" style="background-image: url({{ asset('images/demo-travel-agency-home-bg-03.jpg') }});">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-4" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-lg-3 md-mb-20px text-center text-lg-start">
                    <span class="fw-500 text-base-color text-uppercase">Pengalaman</span>
                    <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Jamaah kami.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <!-- start slider navigation -->
                        <div class="slider-one-slide-prev-1 bg-white box-shadow-double-large swiper-button-prev slider-navigation-style-04"><i class="bi bi-arrow-left-short icon-very-medium"></i></div>
                        <div class="slider-one-slide-next-1 bg-white box-shadow-double-large swiper-button-next slider-navigation-style-04"><i class="bi bi-arrow-right-short icon-very-medium"></i></div>
                        <!-- end slider navigation -->
                    </div>
                </div>
                <div class="col-xl-8 col-lg-9">
                    <div class="swiper position-relative magic-cursor" data-slider-options='{ "autoHeight": true, "loop": true, "allowTouchMove": true, "autoplay": { "delay": 30000000, "disableOnInteraction": false }, "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }, "effect": "slide" }'>
                        <div class="swiper-wrapper">
                            @foreach($package->testimonials as $testi)
                                <div class="swiper-slide review-style-11">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                            <img src="{{ asset('web/images/user-default.png') }}" alt="">
                                        </div>

                                        <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                            <p class="fs-20 lh-28 text-dark-gray mb-20px">
                                                {{ $testi->content }}
                                            </p>

                                            <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>

                                            <div class="position-absolute left-0 top-0 h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                                <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                                    <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">
                                                        {{ $testi->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        function kirimWA() {
            let nama = document.getElementById('nama').value;
            let email = document.getElementById('email').value;
            let pesan = document.getElementById('pesan').value;

            let text = `Assalamu'alaikum, saya ingin bertanya:\n\n`
                + `Nama: ${nama}\n`
                + `Email: ${email}\n`
                + `${pesan}`;

            let url = "https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['kontak_telepon'] ?? '') }}?text=" + encodeURIComponent(text);

            window.open(url, '_blank');
        }
    </script>
@endpush
