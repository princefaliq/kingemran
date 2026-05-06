@extends('frontend.layouts.app')
@section('title', 'Tentang Kami')

@push('css')
    <style>
        .gallery-box img {
            width: 100%;
            height: 100%; /* atau sesuaikan */
            object-fit: cover;
        }
    </style>
@endpush
@section('content')
    <div class="about-page">
        <section class="page-title-button-style cover-background position-relative ipad-top-space-margin md-pt-20px" style="background-image: url({{ asset('images/kakbah_bg.png') }})">
            <div class="opacity-light bg-bay-of-many-blue"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center extra-small-screen mt-4">
                    <div class="col-lg-12 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Halaman</h2>
                        <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Galeri</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="ps-2 pe-2 position-relative">
            <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset('web/images/demo-travel-agency-about-bg-02.png') }})"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col sm-p-0">
                        <div class="justified-gallery image-gallery-style-06" data-justified-options='{ "rowHeight": 500, "maxRowHeight": false, "captions": false, "margins": 15, "waitThumbnailsLoad": true }' data-anime='{ "el": "childs", "translateY": [0, 0],"opacity": [0,1], "duration": 500, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            @forelse ($galeri as $item)
                                @if($item->type == 'image')
                                <!-- start gallery item -->
                                <div class="gallery-box transition-inner-all">
                                    <a href="{{ asset($item->image_url) }}" data-group="lightbox-group-gallery-item-6" title="{{ $item->title }}">
                                        <div class="position-relative bg-dark-gray">
                                            <img src="{{ asset($item->image_url) }}"  alt="{{ $item->title }}" />
                                            <div class="d-flex align-items-center flex-column justify-content-end h-100 w-100 gallery-hover p-45px">
                                                <i class="icon feather icon-feather-search icon-very-medium text-white absolute-middle-center"></i>
                                                <span class="gallery-title text-white fs-18"> {{ $item->title }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- end gallery item -->
                                @elseif($item->type == 'youtube')
                                    {{-- jika youtube --}}
                                    @php
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^?&]+)/', $item->youtube_url, $match);
                                        $youtubeId = $match[1] ?? null;
                                    @endphp
                                        <!-- start gallery item -->
                                    <div class="gallery-box transition-inner-all">
                                        <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" class="popup-youtube" title="{{ $item->title }}">
                                            <div class="position-relative bg-dark-gray">
                                                <img
                                                    src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg"
                                                    onerror="this.onerror=null;this.src='https://img.youtube.com/vi/{{ $youtubeId }}/sddefault.jpg';"
                                                    alt="{{ $item->title }}"
                                                />
                                                <div class="d-flex align-items-center flex-column justify-content-end h-100 w-100 gallery-hover p-45px">
                                                    <i class="icon feather icon-feather-play icon-very-medium text-white absolute-middle-center"></i>
                                                    <span class="gallery-title text-white fs-18"> {{ $item->title }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end gallery item -->
                                @endif
                            @empty
                                    <div class="swiper-slide text-center">
                                        <h6 class="alt-font lh-40 text-dark-gray mb-20px">
                                            Belum ada Galeri yang ditampilkan.
                                        </h6>
                                        <span class="fs-15 text-base-color fw-500 d-block text-uppercase ls-2px">
                                    King Emran
                                    </span>
                                        <span class="fs-14 lh-20 text-dark-gray fw-500 text-uppercase d-block ls-05px">
                                        Galeri
                                    </span>
                                        </div>
                            @endforelse
                        </div>
                        <div class="col-12 mt-4 d-flex justify-content-center">
                            {{ $galeri->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </section>
@endsection
