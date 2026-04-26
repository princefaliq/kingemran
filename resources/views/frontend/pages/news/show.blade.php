@extends('frontend.layouts.app')
@section('title','Home')
@section('content')
    <section class="bg-extra-medium-slate-blue pb-0 ipad-top-space-margin md-pt-0">
        <div class="container">

        </div>
    </section>
    <!-- start section -->
    <section class="top-space-margin right-side-bar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 blog-standard md-mb-50px sm-mb-40px">
                    <!-- start blog details  -->
                    <div class="col-12 blog-details mb-12">
                        <div class="entry-meta mb-20px fs-15">
                            <span><i class="text-dark-gray feather icon-feather-calendar"></i><a href="">{{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}</a></span>
                            <span><i class="text-dark-gray feather icon-feather-user"></i><a href="">Admin</a></span>
                            <span><i class="text-dark-gray feather icon-feather-folder"></i><a href="{{ url('berita/kategori/'.$berita->category->slug) ?? '#' }}">{{ $berita->category->name ?? '-' }}</a></span>
                        </div>
                        <h5 class="text-dark-gray fw-600 w-80 sm-w-100 mb-6">{{ $berita->title }}</h5>
                        <img src="{{ $berita->image_url }}" alt="" class="w-100 border-radius-6px mb-7">
                        <p>{!! $berita->content !!}</p>
                    </div>
                    <div class="col-12">
                        <div class="row mb-50px sm-mb-30px">
                            <div class="tag-cloud col-12 col-md-9 text-center text-md-start sm-mb-15px">
                                @if($berita->tags->count())
                                    @foreach($berita->tags as $tag)
                                        <a href="{{ url('berita/tag/'.$tag->slug) }}">{{ $tag->name }}</a>
                                    @endforeach
                                @endif
                            </div>
                            {{--<div class="tag-cloud col-12 col-md-3 text-uppercase text-center text-md-end">
                                <a class="likes-count fw-500 mx-0" href="#"><i class="fa-regular fa-heart text-red me-10px"></i><span class="text-dark-gray text-dark-gray-hover">05 Likes</span></a>
                            </div>--}}
                        </div>

                    </div>
                    <!-- end blog details -->
                </div>
                <!-- start sidebar -->
                <aside class="col-12 col-xl-4 col-lg-4 col-md-7 ps-55px xl-ps-50px lg-ps-15px sidebar">
                    <div class="mb-15 md-mb-50px xs-mb-35px">
                        <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">Popular posts</div>
                        <ul class="popular-post-sidebar position-relative">
                            @foreach($related as $relate)
                                <li class="d-flex align-items-center">
                                    <figure>
                                        <a href="{{ url('berita/'. $relate->slug ) }}"><img src="{{ $relate->image_url }}" alt=""></a>
                                    </figure>
                                    <div class="col media-body">
                                        <a href="{{ url('berita/'. $relate->slug ) }}" class="fw-600 fs-17 text-dark-gray d-inline-block mb-10px">{{ $relate->title }}</a>
                                        <div><a href="{{ url('berita/'. $relate->slug ) }}" class="d-inline-block fs-15">{{ \Carbon\Carbon::parse($relate->published_at)->format('d F Y') }}</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-15 md-mb-50px xs-mb-35px">
                        <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">
                            Explore category
                        </div>

                        <ul class="category-list-sidebar position-relative">
                            @foreach($categories as $cat)
                                <li class="d-flex align-items-center h-80px cover-background ps-35px pe-35px">

                                    <div class="opacity-medium bg-gradient-dark-transparent"></div>

                                    <a href="{{ url('berita/kategori/'.$cat->slug) }}"
                                       class="d-flex align-items-center position-relative w-100 h-100">

                                    <span class="text-white mb-0 fs-20 fw-500 fancy-text-style-4">
                                        {{ $cat->name }}
                                    </span>
                                    <span class="btn text-white position-absolute">
                                        <i class="bi bi-arrow-right ms-0 fs-24"></i>
                                    </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-15 md-mb-50px xs-mb-35px">
                        <div class="fw-600 fs-19 lh-22 ls-minus-05px text-dark-gray border-bottom border-color-dark-gray border-2 d-block mb-30px pb-15px position-relative">
                            Tags cloud
                        </div>
                        <div class="tag-cloud">
                            @foreach($tags as $tag)
                                <a href="{{ url('berita/tag/'.$tag->slug) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>
                <!-- end sidebar -->
            </div>
        </div>
    </section>
    <!-- end section -->

@endsection
