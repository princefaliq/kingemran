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
    <section class="page-title-parallax-background bg-dark-gray ipad-top-space-margin"
             style="background-image: url('{{ asset('web/images/demo-spa-salon-contact-title-bg.jpg') }}')">
        <div class="opacity-very-light bg-gradient-nero-grey-brown"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="text-white alt-font mb-0 fw-400 ls-minus-1px">{{ $page->title }}</h1>
                    <div class="breadcrumb breadcrumb-style-01 text-white justify-content-center mt-10px">
                        <ul>
                            <li><a href="{{ route('beranda') }}" class="text-white">Home</a></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-detail-section background-repeat pt-5 pb-5 md-pt-8 md-pb-8" style="background-image:url('{{ asset('images/bg.png') }}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">
                    <div class="page-detail-card bg-white border-radius-6px p-50px md-p-35px sm-p-25px">
                        <div class="text-center mb-35px">
                            <span class="fs-15 mb-10px text-base-color fw-500 d-block text-uppercase ls-2px">{{ $page->name }}</span>
                            <h3 class="alt-font ls-minus-1px text-dark-gray mb-15px">{{ $page->title }}</h3>
                            <div class="page-detail-meta fs-15">
                                <i class="feather icon-feather-calendar text-base-color me-5px"></i>
                                {{ $page->created_at->format('d F Y') }}
                            </div>
                        </div>

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
