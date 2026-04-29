@extends('frontend.layouts.app')
@section('title', 'Layanan')

@push('css')
    <style>
        .service-page-section {
            color: #ffffff;
        }

        .service-page-section p,
        .service-page-section li {
            color: rgba(255, 255, 255, 0.78);
        }

        .service-feature-box p,
        .service-pricing-list p {
            color: #4f4740 !important;
        }

        .service-price-image {
            aspect-ratio: 1 / 1;
            object-fit: cover;
            background-color: #f6f0e8;
        }

        .service-price {
            white-space: nowrap;
        }

        @media (max-width: 767px) {
            .service-price-row {
                align-items: flex-start !important;
                flex-direction: column;
            }

            .service-price-row .divider-style-03 {
                display: none;
            }

            .service-price {
                margin-left: 0 !important;
                margin-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-title-parallax-background bg-dark-gray ipad-top-space-margin"
             style="background-image: url('{{ asset('web/images/demo-spa-salon-contact-title-bg.jpg') }}')">
        <div class="opacity-very-light bg-gradient-nero-grey-brown"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="text-white alt-font mb-0 fw-400 ls-minus-1px">Layanan</h1>
                    <div class="breadcrumb breadcrumb-style-01 text-white justify-content-center mt-10px">
                        <ul>
                            <li><a href="{{ route('beranda') }}" class="text-white">Home</a></li>
                            <li>Layanan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="service-page-section background-repeat position-relative pt-5 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="position-absolute right-minus-50px top-50px d-none d-lg-inline-block z-index-minus-1" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
            <img src="{{ asset('images/demo-spa-salon-bg-img-02.webp') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center mb-6">
                <div class="col-lg-4 md-mb-35px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                    <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Paket Perawatan</span>
                    <h3 class="alt-font ls-minus-1px text-base-color">Pilihan paket untuk relaksasi dan kecantikan.</h3>
                    <p class="mb-35px w-90 lg-w-100">Temukan paket spa dan beauty care yang sesuai untuk kebutuhan tubuh, kulit, dan momen istirahat Anda.</p>
                    <a href="#daftar-paket" class="btn btn-small btn-double-border btn-border-base-color section-link">
                        <span>
                            <span class="btn-double-text" data-text="Lihat daftar harga">Lihat daftar harga</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>

                <div class="col-lg-7 offset-lg-1">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-md-2 justify-content-center md-m-0" data-anime='{ "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                        <div class="col icon-with-text-style-01 p-6 border-bottom border-end sm-border-end-0 border-color-light-gray xl-p-5 sm-ps-0 sm-pe-0">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin service-feature-box">
                                <div class="feature-box-icon feature-box-icon-rounded w-30px h-30px rounded-circle me-15px bg-base-color">
                                    <i class="fa-solid fa-check icon-very-small text-white"></i>
                                </div>
                                <div class="feature-box-content">
                                    <span class="d-inline-block alt-font text-base-color mb-5px fs-22">Terapis Profesional</span>
                                    <p>Ditangani oleh tim yang memahami kebutuhan perawatan Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col icon-with-text-style-01 p-6 border-bottom border-color-light-gray xl-p-5 sm-ps-0 sm-pe-0">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin service-feature-box">
                                <div class="feature-box-icon feature-box-icon-rounded w-30px h-30px rounded-circle me-15px bg-base-color">
                                    <i class="fa-solid fa-check icon-very-small text-white"></i>
                                </div>
                                <div class="feature-box-content">
                                    <span class="d-inline-block alt-font text-base-color mb-5px fs-22">Bahan Berkualitas</span>
                                    <p>Menggunakan bahan pilihan untuk pengalaman perawatan yang nyaman.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col icon-with-text-style-01 p-6 border-end sm-border-end-0 sm-border-bottom border-color-light-gray xl-p-5 sm-ps-0 sm-pe-0">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin service-feature-box">
                                <div class="feature-box-icon feature-box-icon-rounded w-30px h-30px rounded-circle me-15px bg-base-color">
                                    <i class="fa-solid fa-check icon-very-small text-white"></i>
                                </div>
                                <div class="feature-box-content">
                                    <span class="d-inline-block alt-font text-base-color mb-5px fs-22">Higienis & Aman</span>
                                    <p>Area dan perlengkapan perawatan dijaga tetap bersih.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col icon-with-text-style-01 p-6 xl-p-5 sm-ps-0 sm-pe-0">
                            <div class="feature-box feature-box-left-icon last-paragraph-no-margin service-feature-box">
                                <div class="feature-box-icon feature-box-icon-rounded w-30px h-30px rounded-circle me-15px bg-base-color">
                                    <i class="fa-solid fa-check icon-very-small text-white"></i>
                                </div>
                                <div class="feature-box-content">
                                    <span class="d-inline-block alt-font text-base-color mb-5px fs-22">Hasil Memuaskan</span>
                                    <p>Paket dirancang untuk membantu tubuh terasa segar kembali.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="daftar-paket" class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Daftar Harga</span>
                    <h3 class="alt-font ls-minus-1px text-base-color mb-0">Semua paket layanan</h3>
                </div>
            </div>

            @if($spaPrograms->isNotEmpty())
                <div class="row justify-content-center">
                    @foreach([$leftPrograms, $rightPrograms] as $programs)
                        <div class="col-lg-6">
                            <ul class="pricing-table-style-12 service-pricing-list {{ $loop->first ? 'pe-15px' : 'ps-15px' }} md-pe-0 md-ps-0 {{ $loop->last ? 'md-pt-20px' : '' }}" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                @foreach($programs as $item)
                                    <li class="last-paragraph-no-margin">
                                        <img
                                            src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('web/images/demo-spa-salon.jpg') }}"
                                            class="w-120px border-radius-100 service-price-image"
                                            alt="{{ $item->nama_paket }}"
                                        >
                                        <div class="ms-30px xs-ms-0 flex-grow-1">
                                            <div class="service-price-row d-flex align-items-center w-120 fs-18">
                                                <span class="fs-22 alt-font text-dark-gray">{{ $item->nama_paket }}</span>
                                                <div class="divider-style-03 divider-style-03-02 border-color-light-gray flex-grow-1 ms-20px me-20px"></div>
                                                @if(!is_null($item->harga))
                                                    <div class="service-price ms-auto fs-26 alt-font text-dark-gray">
                                                        <sub>Rp</sub>{{ number_format($item->harga, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            </div>
                                            @if($item->deskripsi)
                                                <p>{{ $item->deskripsi }}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="bg-white border-radius-6px p-40px">
                            <span class="alt-font text-dark-gray fs-20 d-block mb-5px">Paket layanan belum tersedia</span>
                            <p class="mb-0">Tambahkan data paket aktif dari admin panel untuk menampilkan daftar harga.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
