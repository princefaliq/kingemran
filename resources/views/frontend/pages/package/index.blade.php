@extends('frontend.layouts.app')
@section('title', 'Semua paket')

@push('css')

@endpush

@section('content')
<section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url({{ asset('images/kakbah.png') }})">
    <div class="opacity-light bg-bay-of-many-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Paket perjalanan</h2>
            </div>
            <div class="row justify-content-center " style="z-index:10;">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('tour.index') }}">
                        <div class="row g-2">
                            <!-- CATEGORY -->
                            <div class="col-md-4">
                                <select name="category" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    <option value="haji" {{ request('category') == 'haji' ? 'selected' : '' }}>Haji</option>
                                    <option value="umroh" {{ request('category') == 'umroh' ? 'selected' : '' }}>Umroh</option>
                                </select>
                            </div>

                            <!-- BULAN -->
                            <div class="col-md-4">
                                <select name="month" class="form-select">
                                    <option value="">Semua Bulan</option>
                                    @for($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- TAHUN -->
                            <div class="col-md-3">
                                <select name="year" class="form-select">
                                    <option value="">Semua Tahun</option>
                                    @for($y = now()->year; $y <= now()->year + 3; $y++)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- BUTTON -->
                            <div class="col-md-1 d-grid">
                                <button class="btn btn-dark">
                                    🔍
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start section -->
<section class="position-relative">
    <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset( 'web/images/demo-travel-agency-about-bg-02.png' ) }})"></div>
    <div class="container">

        <div class="row row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 justify-content-center">

            @foreach($packages as $item)
                <div class="col mb-30px">
                    <div class="overflow-hidden border-radius-6px box-shadow-large">

                        <!-- IMAGE + BADGE -->
                        <div class="image position-relative">
                            <a href="{{ route('tour.show', $item->slug) }}">
                                <img class="w-100"
                                     src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'images/default.jpg' }}"
                                     alt="">
                            </a>

                            <!-- CATEGORY BADGE -->
                            <span class="position-absolute top-0 start-0 m-2 badge
                                {{ $item->category == 'haji' ? 'bg-success' : 'bg-primary' }}">
                                {{ ucfirst($item->category) }}
                            </span>

                            <!-- FEATURED -->
                            @if($item->is_featured)
                                <span class="position-absolute top-0 end-0 m-2 badge bg-warning">
                                    <i class="feather icon-feather-star text-dark-gray"></i>
                                </span>
                            @endif
                        </div>

                        <!-- CONTENT -->
                        <div class="bg-white p-40px md-p-30px position-relative">

                            <!-- DURATION -->
                            <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">
                                {{ $item->duration }} {{ $item->duration_type }}
                            </div>

                            <!-- PRICE -->
                            <div class="fs-24 fw-700 text-dark-gray">
                                <span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">From</span>

                                {{ $item->currency }} {{ number_format($item->price) }}

                                @if($item->price_discount)
                                <span class="ms-5px position-relative text-red fs-22 fw-500">
                                    {{ number_format($item->price_discount) }}
                                    <span class="w-100 h-1px position-absolute left-0px top-50 bg-red"></span>
                                </span>
                                @endif
                            </div>

                            <!-- TITLE -->
                            <a href="{{ route('tour.show', $item->slug) }}" class="mt-10px fs-18 text-dark-gray fw-600 d-block">
                                {{ $item->title }}
                            </a>

                            <!-- DESC -->
                            <p class="m-0 lh-30">
                                {{ \Illuminate\Support\Str::limit($item->short_description, 80) }}
                            </p>
                            @php
                                $rating = $item->rating_avg ?? 5;
                            @endphp

                            <!-- FOOTER -->
                            <div class="d-flex align-items-center pt-20px mt-25px border-top border-color-extra-medium-gray">
                                <a href="#" class="fw-600 text-dark-gray me-auto"><i class="feather icon-feather-map-pin me-5px"></i>{{ $item->location ?? '-' }}</a>
                                <div class="review-star-icon me-5px">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi
                                            {{ $i <= $rating ? 'bi-star-fill text-warning' : 'bi-star' }}">
                                        </i>
                                    @endfor
                                </div>
                                <span class="fs-14 fw-500 text-uppercase d-inline-block">{{ $item->reviews_count }} Reviews</span>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col-12 mt-6 d-flex justify-content-center">
                {{ $packages->links('vendor.pagination.bootstrap-5') }}
                <!-- end pagination -->
            </div>
        </div>
    </div>
</section>
@endsection
