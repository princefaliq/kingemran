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
    $foto_spa_1 = !empty($settings['foto_spa_1'] ?? null)
        ? asset('storage/' . $settings['foto_spa_1'])
        : asset('images/woman-relaxing-beauty-salon.jpg');

    $foto_spa_2 = !empty($settings['foto_spa_2'] ?? null)
        ? asset('storage/' . $settings['foto_spa_2'])
        : asset('images/demo-spa-salon-home-03.jpg');

    $motto = $settings['motto'] ?? 'Perawatan terbaik untuk kenyamanan dan kecantikan Anda';
    $about = $settings['about'] ?? 'Kami menghadirkan layanan spa dan beauty dengan suasana nyaman, pelayanan ramah, dan perawatan yang dirancang untuk membantu Anda merasa lebih segar dan percaya diri.';
    $phone = $settings['kontak_telepon'] ?? '';
    $email = $settings['kontak_email'] ?? '';
@endphp

@section('content')
    <div class="about-page">
    <section class="page-title-parallax-background bg-dark-gray ipad-top-space-margin"
             style="background-image: url('{{ asset('web/images/demo-spa-salon-contact-title-bg.jpg') }}')">
        <div class="opacity-very-light bg-gradient-nero-grey-brown"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="text-white alt-font mb-0 fw-400 ls-minus-1px">Tentang Kami</h1>
                    <div class="breadcrumb breadcrumb-style-01 text-white justify-content-center mt-10px">
                        <ul>
                            <li><a href="{{ route('beranda') }}" class="text-white">Home</a></li>
                            <li>Tentang Kami</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg-section background-repeat position-relative pt-5 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 md-mb-50px">
                    <span class="fs-15 mb-15px text-base-color fw-500 d-block text-uppercase ls-2px">About Spa & Beauty</span>
                    <h3 class="alt-font ls-minus-1px text-base-color mb-25px">{{ $motto }}</h3>
                    <div class="about-content mb-35px">
                        {!! $about !!}
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        @if($phone)
                            <a href="{{ $whatsappUrl($phone) }}" target="_blank" rel="noopener" class="btn btn-small btn-double-border btn-border-base-color left-icon">
                                <span>
                                    <span><i class="bi bi-telephone-outbound"></i></span>
                                    <span class="btn-double-text" data-text="{{ $phone }}">{{ $phone }}</span>
                                </span>
                            </a>
                        @endif
                        @if($email)
                            <a href="mailto:{{ $email }}" class="fw-500 text-light">
                                <i class="bi bi-envelope text-base-color me-5px"></i>{{ $email }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-xl-6 col-lg-5 position-relative offset-lg-1 offset-md-2 sm-mt-20px">
                    <div class="w-80 overflow-hidden position-relative md-w-90 border-radius-6px float-end">
                        <img class="w-100" src="{{ $foto_spa_1 }}" alt="Tentang spa">
                    </div>
                    <div class="position-absolute left-minus-70px bottom-minus-30px w-60 overflow-hidden md-left-minus-100px sm-left-15px">
                        <img class="w-100 border-radius-6px" src="{{ $foto_spa_2 }}" alt="Suasana spa">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg-section background-repeat pt-5 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Komitmen Kami</span>
                    <h3 class="alt-font ls-minus-1px section-heading mb-0">Pengalaman perawatan yang nyaman dan terpercaya</h3>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center">
                <div class="col mb-30px">
                    <div class="about-feature-box bg-white border-radius-6px p-35px text-center h-100">
                        <i class="bi bi-stars icon-extra-medium text-base-color mb-20px d-block"></i>
                        <span class="alt-font text-dark-gray fs-20 fw-500 d-block mb-10px">Pelayanan Profesional</span>
                        <p class="mb-0">Setiap layanan dilakukan dengan standar yang rapi, ramah, dan berorientasi pada kenyamanan pelanggan.</p>
                    </div>
                </div>
                <div class="col mb-30px">
                    <div class="about-feature-box bg-white border-radius-6px p-35px text-center h-100">
                        <i class="bi bi-heart-pulse icon-extra-medium text-base-color mb-20px d-block"></i>
                        <span class="alt-font text-dark-gray fs-20 fw-500 d-block mb-10px">Perawatan Berkualitas</span>
                        <p class="mb-0">Kami mengutamakan kualitas perawatan agar hasilnya terasa menenangkan dan menyegarkan.</p>
                    </div>
                </div>
                <div class="col mb-30px">
                    <div class="about-feature-box bg-white border-radius-6px p-35px text-center h-100">
                        <i class="bi bi-flower1 icon-extra-medium text-base-color mb-20px d-block"></i>
                        <span class="alt-font text-dark-gray fs-20 fw-500 d-block mb-10px">Suasana Nyaman</span>
                        <p class="mb-0">Ruang perawatan ditata untuk memberi pengalaman yang tenang, bersih, dan menyenangkan.</p>
                    </div>
                </div>
                <div class="col mb-30px">
                    <div class="about-feature-box bg-white border-radius-6px p-35px text-center h-100">
                        <i class="bi bi-person-check icon-extra-medium text-base-color mb-20px d-block"></i>
                        <span class="alt-font text-dark-gray fs-20 fw-500 d-block mb-10px">Tim Berpengalaman</span>
                        <p class="mb-0">Tim kami siap membantu pelanggan memilih layanan yang sesuai dengan kebutuhan perawatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg-section background-repeat pt-5 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Meet the Team</span>
                    <h3 class="alt-font ls-minus-1px section-heading mb-0">Professional Team</h3>
                </div>
            </div>

            @if($employees->isNotEmpty())
                <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center">
                    @foreach($employees as $employee)
                        <div class="col text-center team-style-05 about-team-item mb-0">
                            <div class="position-relative mb-25px border-radius-6px last-paragraph-no-margin overflow-hidden">
                                <img src="{{ $employee->photo_url ?: asset('web/images/demo-spa-salon.jpg') }}" class="w-100 about-team-photo border-radius-6px" alt="{{ $employee->name }}">
                                @if($employee->phone)
                                    <div class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px team-content bg-gradient-dark-transparent">
                                        <div class="social-icon fs-18">
                                            <a href="{{ $whatsappUrl($employee->phone) }}" target="_blank" rel="noopener" class="text-white">
                                                <i class="bi bi-telephone-outbound"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="alt-font text-dark-gray lh-24 fs-20">{{ $employee->name }}</div>
                            @if($employee->position)
                                <p class="mb-0">{{ $employee->position }}</p>
                            @endif
                        </div>
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

    <section class="about-bg-section background-repeat pt-2 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <span class="fs-15 mb-10px text-base-color fw-500 d-block text-uppercase ls-2px">Kunjungi Kami</span>
                    <h3 class="alt-font ls-minus-1px section-heading mb-0">Siap menikmati perawatan terbaik kami?</h3>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
