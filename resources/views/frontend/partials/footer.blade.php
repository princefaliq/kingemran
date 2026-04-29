
<!-- end footer -->
<footer class="half-footer pb-45px border-top border-color-light-gray background-repeat" style="background-image:url('/images/bg.png');">
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
                   {{-- <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>--}}
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
</footer>
