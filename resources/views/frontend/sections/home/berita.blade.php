
<!-- end section -->
<!-- end section -->
<section class="bg-very-light-gray background-position-center-top background-no-repeat overlap-height" style="background-image:url('web/images/demo-travel-agency-home-bg-04.png');">
    <div class="container overlap-gap-section">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-base-color text-uppercase d-inline-block">Kisah Inspiratif</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Perjalanan Jamaah</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="blog-modern blog-wrapper grid-loading grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>

                    <li class="grid-sizer"></li>

                    @foreach($beritas as $berita)
                        <li class="grid-item md-mb-20px">
                            <div class="box-hover text-center">
                                <figure class="mb-0 position-relative">

                                    <!-- IMAGE -->
                                    <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                        <a href="{{ url('berita/'.$berita->slug) }}">
                                            <img src="{{ url($berita->image_url) }}" alt="{{ $berita->title }}" />
                                        </a>
                                    </div>

                                    <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">

                                        <!-- TITLE -->
                                        <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                            <a href="{{ url('berita/'.$berita->slug) }}" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">
                                                {{ $berita->title }}
                                            </a>
                                            <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                        </div>

                                        <!-- META -->
                                        <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial">
                                        <span class="d-inline-block">
                                            By
                                            <a href="{{ url('berita/kategori/'.optional($berita->category)->slug) }}">
                                                {{ optional($berita->category)->name ?? 'Tanpa Kategori' }}
                                            </a>
                                        </span>
                                            <span class="separator d-inline-block">|</span>
                                            <a href="#">
                                                {{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}
                                            </a>
                                        </div>

                                    </figcaption>
                                </figure>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>
<!-- start section -->
