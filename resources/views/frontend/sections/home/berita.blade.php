
<!-- start section -->
<section class="position-relative overflow-hidden sm-pb-20px">
    <div class="separator-line-9px bg-base-color position-absolute top-0px right-0px" data-bottom-top="width: 15%" data-center-top="width: 50%;"></div>
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-xl-7 col-lg-9 col-md-10 text-center">
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Berita Terbaru</span>
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Tetap terinformasi dengan berita terbaru</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-md-0">
                <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <li class="grid-sizer"></li>
                    @foreach($beritas as $berita)
                        <!-- start blog item -->
                        <li class="grid-item">
                            <div class="card bg-transparent border-0 h-100">
                                <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                    <a href="{{ url('berita/'.$berita->slug) }}"><img src="{{ url($berita->image_url) }}" alt="" /></a>
                                </div>
                                <div class="card-body px-0 pb-30px pt-30px xs-pb-15px">
                                    <span class="fs-14 text-uppercase mb-5px d-block"><a href="{{ url('berita/kategori/'.optional($berita->category)->slug) }}" class="text-dark-gray fw-600 categories-text">{{ optional($berita->category)->name ?? 'Tanpa Kategori' }}</a><a href="#" class="blog-date">{{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}</a></span>
                                    <a href="{{ url('berita/'.$berita->slug) }}" class="card-title mb-0 fw-500 fs-18 lh-30 text-dark-gray d-inline-block">{{ $berita->title }}</a>
                                </div>
                            </div>
                        </li>
                        <!-- end blog item -->
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
