<footer class="bg-base-color pb-40px">
    <div class="container">
        <div class="row mb-2 md-mb-4 overlap-section" data-anime='{ "el": "childs", "translateY": [-15, 0], "scale": [0.5, 1], "opacity": [0,1], "duration": 800, "delay": 300, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12 text-center">
                <img src="{{ asset('images/king_emran.png') }}" style="max-height: 160px" alt="" />
            </div>
        </div>
        <!-- start subscribe item -->
        <div class="row justify-content-center mb-6 md-mb-8 xs-mb-40px">
            <div class="col-xl-6 col-lg-8 col-md-10 text-center last-paragraph-no-margin">
                <h2 class="text-light alt-font fw-600 mb-40px mx-auto w-90 ls-minus-2px">Jangan lewatkan promo haji & umroh terbaru!</h2>
                <div class="d-inline-block w-100 position-relative mb-30px">
                    @php
                        $phone = preg_replace('/[^0-9]/', '', $settings['kontak_telepon'] ?? '');
                        $message = urlencode("Assalamu'alaikum, saya ingin informasi paket haji & umroh.");
                    @endphp
                    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" class="btn btn-large btn-round-edge btn-success btn-hover-animation btn-box-shadow me-25px"  target="_blank">
                        <span>
                            <span class="btn-text">WA Booking</span><span class="btn-icon"><i class="fa-brands fa-whatsapp"></i></span>
                        </span>
                    </a>

                </div>

            </div>
        </div>
        <!-- end subscribe item -->

        <!-- end instagram -->
        <div class="row align-items-center">
            <div class="col-xl-3 col-sm-6 text-center text-sm-start last-paragraph-no-margin fs-15 text-light order-3 order-md-1">
                <p>&COPY; Copyright 2026 <a href="/" target="_blank" class="text-light text-light-hover text-decoration-line-bottom fw-600">King Emran</a></p>
            </div>
            <div class="col-xl-6 text-center lg-mt-10px sm-mt-0 sm-mb-15px order-1 order-xl-2 order-md-3">
                <ul class="footer-navbar">
                    <li class="nav-item"><a href="{{ url('tentang-kami') }}" class="nav-link text-light">About</a></li>
                    <li class="nav-item"><a href="{{ url('galeri') }}" class="nav-link text-light">Galeri</a></li>
                    <li class="nav-item"><a href="{{ url('paket') }}" class="nav-link text-light">Tours</a></li>
                    <li class="nav-item"><a href="{{ url('/testimoni') }}" class="nav-link text-light">Reviews</a></li>
                    <li class="nav-item"><a href="{{ url('berita') }}" class="nav-link text-light">Berita</a></li>
                    <li class="nav-item"><a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" class="nav-link text-light">Contact</a></li>
                </ul>
            </div>
            <div class="col-xl-3 col-sm-6 position-relative text-center text-sm-end elements-social social-text-style-08 order-2 order-xl-3 xs-mb-10px">
                <ul class="small-icon dark">
                    <li><a class="facebook" href="{{ $settings['sosmed_facebook'] }}" target="_blank"><i class="text-light fa-brands fa-facebook-f"></i></a></li>
                    <li><a class="tiktok" href="{{ $settings['sosmed_tiktok'] }}" target="_blank"><i class="text-light fa-brands fa-tiktok"></i></a></li>
                    <li><a class="youtube" href="{{ $settings['sosmed_youtube'] }}" target="_blank"><i class="text-light fa-brands fa-youtube"></i></a></li>
                    <li><a class="instagram" href="{{ $settings['sosmed_instagram'] }}" target="_blank"><i class="text-light fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
{{--<footer class="half-footer pb-45px border-top border-color-light-gray background-repeat" style="background-image:url('/images/bg.png');">
    <div class="container">
        <div class="overlap-section position-absolute left-0px right-0px text-center d-none d-md-inline-block" data-anime='{ "el": "childs", "translateY": [0, 0], "scale": [0.7, 1], "rotateZ": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <img src="favicon.png" alt="" class="lg-w-20 h-280px">
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin me-auto z-index-1 text-center text-sm-start xs-mb-20px">
                <span class="fs-20 fw-500 text-dark-gray d-block mb-5px">Spa location</span>
                <p class="w-100">{{ $settings['kontak_alamat'] }}</p>
                @if(!empty($settings['jam_kerja']))
                    <span class="fs-20 fw-500 text-dark-gray d-block mb-5px mt-20px">Jam Kerja</span>
                    <p class="w-100">{!! nl2br(e($settings['jam_kerja'])) !!}</p>
                @endif
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 last-paragraph-no-margin text-center text-sm-end z-index-1">
                <span class="fs-20 fw-500 text-dark-gray d-block mb-5px">How can we help?</span>
                <a class="text-light" href="mailto:{{ $settings['kontak_email'] }}">{{ $settings['kontak_email'] }}</a><br>
                <a class="text-light" href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" target="_blank" rel="noopener">{{ $settings['kontak_telepon'] }}</a>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-20px mb-10px md-mb-20px">
            <div class="col d-none d-md-flex">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 text-center elements-social social-icon-style-04">
                <ul class="large-icon dark mb-0">
                    <li><a class="facebook" href="{{ $settings['sosmed_facebook'] }}" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                    <li><a class="youtube" href="{{ $settings['sosmed_youtube'] }}" target="_blank"><i class="fa-brands fa-youtube"></i><span></span></a></li>
                   --}}{{-- <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>--}}{{--
                    <li><a class="instagram" href="{{ $settings['sosmed_instagram'] }}" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                    <li><a class="tiktok" href="{{ $settings['sosmed_tiktok'] }}" target="_blank"><i class="fa-brands fa-tiktok"></i><span></span></a></li>
                </ul>
            </div>
            <div class="col d-none d-md-flex">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 last-paragraph-no-margin text-center text-md-start sm-mb-10px">
                <p>&COPY; 2026 <a href="/" target="_blank" class="text-decoration-line-bottom text-dark-gray fw-500">OmahChantik.</a> All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end last-paragraph-no-margin">
                <p><a href="/" target="_blank" class="text-decoration-line-bottom text-dark-gray fw-500">Luxury</a> Spa & Beauty Experience</p>
            </div>
        </div>
    </div>
</footer>--}}
