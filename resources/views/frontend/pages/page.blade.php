@extends('frontend.layouts.app')
@section('title', $title)

@section('content')
    <section class="bg-extra-medium-slate-blue pb-0 ipad-top-space-margin md-pt-0">
        <div class="container">

        </div>
    </section>
    <section class="top-space-margin right-side-bar">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12 col-lg-8 blog-standard md-mb-50px sm-mb-40px">

                    <div class="col-12 blog-details mb-12">

                        {{-- META --}}
                        <div class="entry-meta mb-20px fs-15">
                        <span>
                            <i class="text-dark-gray feather icon-feather-calendar"></i>
                            {{ $page->created_at->format('d F Y') }}
                        </span>
                        </div>

                        {{-- TITLE --}}
                        <h5 class="text-dark-gray fw-600 w-80 sm-w-100 mb-6">
                            {{ $page->title }}
                        </h5>

                        {{-- ========================= --}}
                        {{-- TYPE: EDITOR --}}
                        {{-- ========================= --}}
                        @if($viewType == 'editor')

                            <div class="content-editor">
                                {!! $page->content !!}
                            </div>

                        @endif


                        {{-- ========================= --}}
                        {{-- TYPE: PDF --}}
                        {{-- ========================= --}}
                        @if($viewType == 'pdf')

                            @if($page->pdf_path)
                                <div class="mb-4">
                                    <iframe
                                        src="{{ asset('storage/'.$page->pdf_path) }}"
                                        width="100%"
                                        height="600px"
                                        style="border:1px solid #eee; border-radius:8px;">
                                    </iframe>
                                </div>

                                <div class="text-center">
                                    <a href="{{ asset('storage/'.$page->pdf_path) }}"
                                       target="_blank"
                                       class="btn btn-dark-gray btn-small">
                                        Download PDF
                                    </a>
                                </div>
                            @else
                                <p>File PDF tidak tersedia.</p>
                            @endif

                        @endif


                        {{-- ========================= --}}
                        {{-- TYPE: EDITOR + PDF --}}
                        {{-- ========================= --}}
                        @if($viewType == 'editor_pdf')

                            {{-- CONTENT --}}
                            @if($page->content)
                                <div class="content-editor mb-5">
                                    {!! $page->content !!}
                                </div>
                            @endif

                            {{-- PDF --}}
                            @if($page->pdf_path)
                                <div class="mb-4">
                                    <iframe
                                        src="{{ asset('storage/'.$page->pdf_path) }}"
                                        width="100%"
                                        height="600px"
                                        style="border:1px solid #eee; border-radius:8px;">
                                    </iframe>
                                </div>

                                <div class="text-center">
                                    <a href="{{ asset('storage/'.$page->pdf_path) }}"
                                       target="_blank"
                                       class="btn btn-dark-gray btn-small">
                                        Download PDF
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
