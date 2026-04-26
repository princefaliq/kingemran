<!-- start footer -->
<footer class="pt-5 pb-5 sm-pt-40px sm-pb-45px footer-dark bg-extra-medium-slate-blue">
    <div class="container">
        <div class="row justify-content-center">
            <!-- start footer column -->
            <div class="col-lg-3 col-sm-6 last-paragraph-no-margin order-5 order-sm-4 order-lg-1 text-center text-sm-start">
                <a href="/" class="mb-15px d-block d-lg-inline-block"><img class="h-60px" src="{{ url('/web/images/logokec.png') }}" data-at2x="{{ url('/web/images/logokec.png') }}" alt=""></a>
                <p class="w-90 sm-w-100 d-inline-block mb-15px">Media informasi dan pelayanan publik Kecamatan Tlogosari.</p>
                <p>&COPY;  2026 <a href="" target="_blank" class="text-white text-decoration-line-bottom">Kec. Tlogosari.</a></p>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-5 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-1 order-lg-2">
                <span class="alt-font d-block text-white mb-5px">Jam Layanan</span>
                <ul>
                    <li><a href="#">Senin - Kamis</a></li>
                    <li><a href="#">{{ $settings['jam_kerja_senin_kamis'] }}</a></li>
                    <li><a href="#">Jum'at</a></li>
                    <li><a href="#">{{ $settings['jam_kerja_jumat'] }}</a></li>
                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-7 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-2 order-lg-3">
                <span class="alt-font d-block text-white mb-5px">Link Terkait</span>
                <ul>
                    <li><a href="https://bondowosokab.go.id" target="_blank">Bondowoso</a></li>
                    <li><a href="https://kanda.bondowosokab.go.id" target="_blank">Kanda</a></li>
                    <li><a href="https://dishub.bondowosokab.go.id/cctv" target="_blank">CCTV</a></li>
                    <li><a href="https://sadab.bondowosokab.go.id">Satu Data</a></li>
                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-5 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-3 order-lg-4">
                <span class="alt-font d-block text-white mb-5px">Social connect</span>
                <ul>
                    <li><a href="{{ $settings['sosmed_facebook'] }}" target="_blank">Facebook</a></li>
                    <li><a href="{{ $settings['sosmed_youtube'] }}" target="_blank">Youtube</a></li>
                    <li><a href="{{ $settings['sosmed_tiktok'] }}" target="_blank">Tiktok</a></li>
                    <li><a href="{{ $settings['sosmed_instagram'] }}" target="_blank">Instagram</a></li>
                </ul>
            </div>
            <!-- end footer column -->
            <!-- start footer column -->
            <div class="col-7 col-lg-3 col-sm-6 xs-mb-30px last-paragraph-no-margin order-4 order-sm-5 order-lg-5">
                <span class="alt-font d-block text-white mb-5px">Get in touch</span>
                <p class="w-80 lg-w-100 md-w-70 sm-w-100 mb-10px">{{ $settings['kontak_alamat'] }}</p>
                <div><i class="feather icon-feather-phone-call icon-very-small text-white me-10px"></i><a href="tel:{{ $settings['kontak_telepon'] }}" class="text-white">{{ $settings['kontak_telepon'] }}</a></div>
                <div><i class="feather icon-feather-mail icon-very-small text-white me-10px"></i><a href="mailto:{{ $settings['kontak_email'] }}" class="text-white text-decoration-line-bottom">{{ $settings['kontak_email'] }}</a></div>
            </div>
            <!-- end footer column -->
        </div>
    </div>
</footer>
<!-- end footer -->

