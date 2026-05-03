<!-- start section -->
<section class="pt-0">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fw-500 text-base-color text-uppercase d-inline-block">Foto dan Video</span>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Momen Perjalanan Ibadah</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 justify-content-center mb-5 md-mb-3 xs-mb-40px" data-anime='{ "el": "childs", "scale":[0.9,1], "opacity": [0,1], "duration": 500, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
            @forelse($gallerie as $item)
                @if($item->type == 'image')
                    <div class="gallery-box">
                        <!-- start interactive banners item -->
                        <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                            <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                                <a href="{{ asset($item->image_url) }}" data-group="lightbox-gallery">
                                    <div class="feature-box-icon position-relative">
                                        <img class="custom-image-icon mt-30px mb-20px" style="aspect-ratio: 16/9;"
                                             src="{{ asset($item->image_url) }}"
                                             alt="{{ $item->title }}" />

                                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 w-100 h-100 gallery-hover move-bottom-top">
                                            <i class="feather icon-feather-search icon-very-medium text-white"></i>
                                        </div>
                                    </div>
                                </a>
                            </figure>
                        </div>
                    </div>
                @elseif($item->type == 'youtube')
                    {{-- jika youtube --}}
                    @php
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^?&]+)/', $item->youtube_url, $match);
                        $youtubeId = $match[1] ?? null;
                    @endphp
                    <!-- start interactive banners item -->
                    <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                        <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden">
                            <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" class="popup-youtube">
                                <div class="feature-box-icon position-relative">
                                    <img class="custom-image-icon mt-30px mb-20px" style="aspect-ratio: 16/9;"
                                         src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                                         alt="{{ $item->title }}" />

                                    <div class="d-flex align-items-center justify-content-center position-absolute top-0 w-100 h-100 gallery-hover move-bottom-top">
                                        <i class="feather icon-feather-play-circle icon-very-medium text-white"></i>
                                    </div>
                                </div>
                            </a>
                        </figure>
                    </div>
                @endif
            <!-- end interactive banners item -->
            @empty
                <div class="col-12 text-center text-muted">
                    Belum ada Galeri yang ditampilkan.
                </div>
            @endforelse
        </div>
        <div class="row text-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <h4 class="alt-font text-dark-gray mb-0 ls-minus-1px fancy-text-style-4">
                Perjalanan terbaik menuju <span class="fw-600" data-fancy-text='{
        "effect": "wave",
        "direction": "up",
        "speed": 10,
        "string": ["Tanah Suci.", "Baitullah.", "ibadah yang khusyuk."],
        "duration": 2500
    }'></span>
            </h4>
        </div>
    </div>
</section>
<!-- end section -->

