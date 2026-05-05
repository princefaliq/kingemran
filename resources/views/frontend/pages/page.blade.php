@extends('frontend.layouts.app')
@section('title', $title)

@push('css')
    <style>
        .page-detail-section {
            color: #232323;
        }

        .page-detail-card {
            border: 1px solid rgba(212, 175, 55, 0.25);
            box-shadow: 0 18px 45px rgba(35, 28, 22, 0.08);
        }

        .page-detail-meta {
            color: #6f655c;
        }

        .page-detail-content,
        .page-detail-content p,
        .page-detail-content li,
        .page-detail-content span {
            color: #3f3a35;
            font-size: 17px;
            line-height: 1.85;
        }

        .page-detail-content h1,
        .page-detail-content h2,
        .page-detail-content h3,
        .page-detail-content h4,
        .page-detail-content h5,
        .page-detail-content h6 {
            color: #232323;
            margin-bottom: 18px;
        }

        .page-detail-content img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }

        .page-detail-content table {
            width: 100%;
            color: #3f3a35;
        }

        .page-pdf-frame {
            width: 100%;
            min-height: 680px;
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: 6px;
            background-color: #ffffff;
        }

        @media (max-width: 767px) {
            .page-pdf-frame {
                min-height: 520px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin md-pt-20px" style="background-image: url({{ asset('images/kakbah_bg.png') }})">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen mt-4">
                <div class="col-lg-12 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Halaman</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">{{ $page->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="page-detail-section pt-5 pb-5 md-pt-8 md-pb-8 position-relative" >
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset( 'web/images/demo-travel-agency-about-bg-02.png' ) }})"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="page-detail-card bg-white border-radius-6px p-50px md-p-35px sm-p-25px">
                        @if($viewType == 'editor')
                            <div class="page-detail-content">
                                {!! $page->content !!}
                            </div>
                        @endif

                        @if($viewType == 'pdf')
                            @if($page->pdf_path)
                                <div class="mb-30px">
                                    <iframe
                                        class="page-pdf-frame"
                                        src="{{ asset('storage/' . $page->pdf_path) }}">
                                    </iframe>
                                </div>

                                <div class="text-center">
                                    <a href="{{ asset('storage/' . $page->pdf_path) }}"
                                       target="_blank"
                                       class="btn btn-small btn-double-border btn-border-base-color left-icon">
                                        <span>
                                            <span><i class="bi bi-download"></i></span>
                                            <span class="btn-double-text" data-text="Download PDF">Download PDF</span>
                                        </span>
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    File PDF tidak tersedia.
                                </div>
                            @endif
                        @endif

                        @if($viewType == 'editor_pdf')
                            @if($page->content)
                                <div class="page-detail-content mb-40px">
                                    {!! $page->content !!}
                                </div>
                            @endif

                            @if($page->pdf_path)
                                <div class="mb-30px">
                                    <iframe
                                        class="page-pdf-frame"
                                        src="{{ asset('storage/' . $page->pdf_path) }}">
                                    </iframe>
                                </div>

                                <div class="text-center">
                                    <a href="{{ asset('storage/' . $page->pdf_path) }}"
                                       target="_blank"
                                       class="btn btn-small btn-double-border btn-border-base-color left-icon">
                                        <span>
                                            <span><i class="bi bi-download"></i></span>
                                            <span class="btn-double-text" data-text="Download PDF">Download PDF</span>
                                        </span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
