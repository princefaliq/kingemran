@extends('frontend.layouts.app')
@section('title', 'Tentang Kami')

@push('css')
    <style>
        .about-page .page-title-parallax-background h1,
        .about-page .page-title-parallax-background a,
        .about-page .page-title-parallax-background li {
            color: #ffffff !important;
        }

        .about-bg-section {
            color: #ffffff;
        }

        .about-bg-section p,
        .about-bg-section li {
            color: rgba(255, 255, 255, 0.86);
        }

        .about-bg-section h3,
        .about-bg-section .section-heading {
            color: var(--base-color) !important;
        }

        .about-content p,
        .about-content li {
            color: rgba(255, 255, 255, 0.86);
            font-size: 17px;
            line-height: 1.85;
        }

        .about-feature-box p {
            color: #4f4740 !important;
        }

        .about-feature-box span {
            color: #232323 !important;
        }

        .about-team-item .alt-font {
            color: #ffffff !important;
        }

        .about-team-item p {
            color: rgba(255, 255, 255, 0.78) !important;
        }

        .about-feature-box {
            min-height: 100%;
            border: 1px solid rgba(212, 175, 55, 0.25);
            transition: all .25s ease;
        }

        .about-feature-box:hover {
            transform: translateY(-4px);
            border-color: rgba(212, 175, 55, 0.65);
            box-shadow: 0 18px 45px rgba(35, 28, 22, 0.08);
        }

        .about-team-photo {
            aspect-ratio: 4 / 5;
            object-fit: cover;
            background-color: #f6f0e8;
        }

    </style>
@endpush

@php

    $about_image_1 = !empty($settings['about_image_1'])
        ?  asset('storage/' .$settings['about_image_1'])
        : asset('web/images/demo-lawyer.jpg');
    $about_image_2 = !empty($settings['about_image_2'])
        ?  asset('storage/' .$settings['about_image_2'])
        : asset('web/images/demo-lawyer.jpg');

    $motto = $settings['motto'] ?? 'Perawatan terbaik untuk kenyamanan dan kecantikan Anda';
    $about = $settings['about'] ?? 'Kami menghadirkan layanan spa dan beauty dengan suasana nyaman, pelayanan ramah, dan perawatan yang dirancang untuk membantu Anda merasa lebih segar dan percaya diri.';
    $phone = $settings['kontak_telepon'] ?? '';
    $email = $settings['kontak_email'] ?? '';
@endphp

@section('content')
    <div class="about-page">
        <section class="page-title-button-style cover-background position-relative ipad-top-space-margin md-pt-20px" style="background-image: url({{ asset('images/kakbah_bg.png') }})">
            <div class="opacity-light bg-bay-of-many-blue"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center extra-small-screen mt-4">
                    <div class="col-lg-12 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Halaman</h2>
                        <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Tentang Kami</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- start section -->
        <section class="background-position-center-bottom background-no-repeat background-size-contain position-relative" style="background-image:url({{ asset('web/images/demo-travel-agency-home-bg-02.png') }});">
            <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset('web/images/demo-travel-agency-about-bg-02.png') }})"></div>
            <div class="container">
                <div class="row align-items-center mb-5 md-mb-50px overflow-hidden">
                    <div class="col-xl-6 col-lg-6 md-mb-30px position-relative">
                        <div class="atropos" data-atropos>
                            <div class="atropos-scale">
                                <div class="atropos-rotate">
                                    <div class="atropos-inner">
                                        <img data-atropos-offset="5" src="{{ $about_image_1 }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img class="position-absolute right-minus-20px md-right-70px bottom-100px xs-w-190px z-index-9 w-240px" src="{{ $about_image_2 }}" alt="" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                    </div>
                    <div class="col-xl-5 offset-xl-1 col-lg-6 text-center text-lg-start">
                        <h1 class="alt-font fw-600 text-dark-gray ls-minus-2px" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":0, "staggervalue": 100, "easing": "easeOutQuad" }'>{{ $motto }}</h1>
                        <p class="w-85 md-w-100" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":100, "staggervalue": 100, "easing": "easeOutQuad" }'>
                            {!! $about !!}</p>
                        <div class="d-inline-block mt-10px" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                            <a href="{{ url('paket') }}" class="btn btn-large btn-dark-gray btn-round-edge btn-hover-animation btn-box-shadow me-25px xs-me-15px">
                                <span>
                                    <span class="btn-text">Tujuan</span>
                                    <span class="btn-icon"><i class="feather icon-feather-map-pin"></i></span>
                                </span>
                            </a>
                            <a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" class="btn btn-large btn-transparent-white btn-round-edge btn-hover-animation btn-box-shadow me-25px xs-me-15px">
                                <span>
                                    <span class="btn-text text-dark">WhatsApp</span>
                                    <span class="btn-icon"><i class="fa-brands fa-whatsapp text-dark"></i></span>
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
                {{--<div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center align-items-center mb-5 sm-mb-40px" data-anime='{ "el": "childs", "translateY": [50, 0],"perspective": [1200,1200], "scale": [0.9,1], "rotateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col md-mb-30px">
                        <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                            <div class="pt-10 pb-10">
                                <img src="{{ asset('web/images/demo-hotel-and-resort-client-01.svg') }}" class="h-60px" alt="" />
                            </div>
                            <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                                <p class="text-dark-gray fw-500">2019 - Best of the best</p>
                            </div>
                        </div>
                    </div>
                    <div class="col md-mb-30px">
                        <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                            <div class="pt-10 pb-10">
                                <img src="images/demo-hotel-and-resort-client-02.svg" class="h-60px" alt="" />
                            </div>
                            <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                                <p class="text-dark-gray fw-500">2020 - Travel of excellence</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                            <div class="pt-10 pb-10">
                                <img src="images/demo-hotel-and-resort-client-03.svg" class="h-60px" alt="" />
                            </div>
                            <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                                <p class="text-dark-gray fw-500">2021 - Responsible tourism</p>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="row justify-content-center mb-6 md-mb-8 xs-mb-60px" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-auto text-center last-paragraph-no-margin">
                        <div class="d-inline-block align-middle me-5px">
                            <img src="{{ asset('images/demo-travel-agency-about-icon-01.png') }}" class="w-35px" alt="">
                        </div>
                        <div class="d-inline-block text-dark-gray alt-font fs-30 align-middle ls-minus-1px">Pengalaman perjalanan yang <span class="text-decoration-line-bottom fw-600 text-dark-gray">nyaman dan terpercaya.</span></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-very-light-gray background-position-center-bottom background-size-contain background-no-repeat pt-2" style="background-image:url({{ asset('web/images/demo-travel-agency-home-bg-05.png') }});">
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="fw-500 text-base-color text-uppercase d-inline-block">Brilliant reasons</span>
                        <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Why choose us?</h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center mb-5 sm-mb-8" data-anime='{"el": "childs", "translateY": [0, 0], "perspective": [1000,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <!-- start interactive banner item -->
                    <div class="col interactive-banner-style-03 transition-inner-all md-mb-30px">
                        <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                            <figure class="m-0">
                                <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                                <img src="{{ asset('/images/demo-travel-agency-about-02.jpg') }}" alt="" />
                                <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                    <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Pilihan Kenyamanan Hotel</span>
                                    <a href="#" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-bookmark-heart align-middle icon-extra-medium me-10px"></i>Pelayanan Terbaik</a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <!-- end interactive banner item -->
                    <!-- start interactive banner item -->
                    <div class="col interactive-banner-style-03 transition-inner-all md-mb-30px">
                        <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                            <figure class="m-0">
                                <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                                <img src="{{ asset('images/demo-travel-agency-about-04.png') }}" alt="" />
                                <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                    <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Pembimbing & Tour Leader Berpengalaman</span>
                                    <a href="#" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-award align-middle icon-extra-medium me-10px"></i>Pembimbing Terbaik</a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <!-- end interactive banner item -->
                    <!-- start interactive banner item -->
                    <div class="col interactive-banner-style-03 transition-inner-all">
                        <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                            <figure class="m-0">
                                <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                                <img src="{{ asset('images/demo-travel-agency-about-03.jpg') }}" alt="" />
                                <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                    <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Jaminan Perlindungan Maksimal untuk Jamaah</span>
                                    <a href="#" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-shield-check align-middle icon-extra-medium me-10px"></i>Aman Tanpa Khawatir</a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <!-- end interactive banner item -->
                </div>
                <div class="row mb-12 md-pb-13 md-mt-8 xs-pb-20" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 50, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <div class="col-12 text-center">
                        <h4 class="alt-font text-dark-gray mb-0 ls-minus-1px fancy-text-style-4">World's hottest destinations for <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "up", "speed": 10, "string": ["mountain lovers.", "nature lovers.", "independent tours."], "duration": 2500 }'></span></h4>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-0">
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="fw-500 text-base-color text-uppercase d-inline-block">Para Petugas</span>
                        <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Tim Ahli Kami</h2>
                    </div>
                </div>
                @if($employees->isNotEmpty())
                    <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2" data-anime='{ "el": "childs", "perspective": [1000,1200], "scale": [1.05, 1], "rotateY": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        @foreach($employees as $employee)
                            <!-- start team member item -->
                            <div class="col text-center team-style-01 mb-3 md-mb-30px">
                                <figure class="mb-0 hover-box box-hover position-relative">
                                    <img src="{{ $employee->photo_url ?: asset('web/images/demo-spa-salon.jpg') }}" alt="{{ $employee->name }}" class="border-radius-6px" />
                                    <figcaption class="w-100 p-35px bg-white">
                                        <div class="position-relative z-index-1 overflow-hidden">
                                            <span class="d-block fw-600 fs-18 text-dark-gray lh-24">{{ $employee->name }}</span>
                                            <p class="m-0">{{ $employee->position }}</p>
                                            <div class="social-icon hover-text mt-20px">
                                                <a href="{{ $whatsappUrl($employee->phone) }}" target="_blank" class="fw-600 text-dark-gray"><i class="fa-brands fa-whatsapp text-success"></i></a>

                                            </div>
                                        </div>
                                        <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                                    </figcaption>
                                </figure>
                            </div>
                            <!-- end team member item -->
                        @endforeach
                    </div>
                @else
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="bg-white border-radius-6px p-40px">
                                <span class="alt-font text-dark-gray fs-20 d-block mb-5px">Data tim belum tersedia</span>
                                <p class="mb-0">Tambahkan data employee aktif dari admin panel untuk menampilkan Professional Team.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

@endsection
