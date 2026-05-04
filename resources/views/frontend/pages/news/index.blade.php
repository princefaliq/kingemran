@extends('frontend.layouts.app')
@section('title','Home')
@push('css')
    <style>
        .card-title {
            min-height: 52px; /* kira2 2 baris */
            line-height: 26px;
        }
        .card-body p {
            min-height: 72px; /* kira2 3 baris */
            line-height: 24px;
        }
        .blog-grid .grid-item {
            display: flex;
        }

        .blog-grid .grid-item .card {
            width: 100%;
        }

        /* Samakan tinggi gambar */
        .blog-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* Clamp text */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url({{ asset('images/kakbah.png') }})">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-12 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">{{ $title }}</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">{{$subtitle}}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- end page title -->
    <!-- start section -->
    <section class="mt-2 ps-11 pe-11 xl-ps-2 xl-pe-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <ul class="blog-grid blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                        <li class="grid-sizer"></li>
                        @foreach($beritas as $berita)
                        <!-- start blog item -->
                        <li class="grid-item d-flex">
                            <div class="card h-100 d-flex flex-column border-0 border-radius-4px box-shadow-extra-large box-shadow-extra-large-hover">

                                {{-- IMAGE --}}
                                <div class="blog-image">
                                    <a href="{{ route('news.show', $berita->slug) }}" class="d-block">
                                        <img src="{{ asset('storage/'.$berita->thumbnail) }}" alt="" class="w-100">
                                    </a>

                                    @if($berita->category)
                                        <div class="blog-categories">
                                            <a href="{{ route('news.category', $berita->category->slug) }}"
                                               class="categories-btn bg-white text-dark-gray text-uppercase alt-font fw-700">
                                                {{ $berita->category->name }}
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body d-flex flex-column p-12">

                                    {{-- TITLE --}}
                                    <a href="{{ route('news.show', $berita->slug) }}"
                                       class="card-title mb-15px fw-600 fs-17 lh-26 text-dark-gray text-dark-gray-hover d-inline-block line-clamp-2">
                                        {{ $berita->title }}
                                    </a>

                                    {{-- CONTENT --}}
                                    <p class="line-clamp-3 mb-3">
                                        {{ Str::limit(strip_tags($berita->content), 120) }}
                                    </p>

                                    {{-- FOOTER (DITARIK KE BAWAH) --}}
                                    <div class="author d-flex justify-content-between align-items-center position-relative overflow-hidden fs-14 text-uppercase mt-auto">
                                        <div>
                                            <span class="blog-date fw-500 d-inline-block">
                                                {{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}
                                            </span>
                                            <div class="d-inline-block author-name">
                                                By
                                                <a href="#" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom fw-600">
                                                    Admin
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <!-- end blog item -->
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 mt-4 d-flex justify-content-center">
                    {{ $beritas->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
