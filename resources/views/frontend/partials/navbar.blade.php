<header class="header-with-topbar">
    <div class="header-top-bar top-bar-light bg-white md-border-bottom border-color-transparent-dark-very-light disable-fixed">
        <div class="container-fluid">
            <div class="row h-45px align-items-center m-0">
                <div class="col-xl-6 col-lg-8 justify-content-center justify-content-lg-start">
                    <div class="fs-15 text-dark-gray">We have a selection of over 50 tour programs! <a href="demo-travel-agency-destinations.html" class="text-base-color fw-500 text-decoration-line-bottom">Popular Destinations</a></div>
                </div>
                <div class="col-xl-6 col-lg-4 text-end d-none d-lg-flex">
                    <a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" class="widget fs-15 text-dark-gray text-dark-gray-hover"><i class="fa-brands fa-whatsapp text-base-color"></i> {{ $settings['kontak_telepon'] }}</a>
                    <div class="widget fs-15 ms-30px text-dark-gray d-none d-xl-inline-block"><i class="feather icon-feather-map-pin text-base-color"></i> {{ $settings['kontak_alamat'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent disable-fixed">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 me-auto">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/kingemran.png') }}" data-at2x="{{ asset('images/kingemran.png') }}" style="max-height: 45px!important;" alt="" class="default-logo ">
                    <img src="{{ asset('images/kingemran.png') }}" data-at2x="{{ asset('images/kingemran.png') }}" alt="" class="alt-logo">
                    <img src="{{ asset('images/kingemran.png') }}" data-at2x="{{ asset('images/kingemran.png') }}" alt="" class="mobile-logo rounded-3">
                </a>
            </div>
            <div class="col-auto col-lg-8 menu-order position-static">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line text-white"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                @include('frontend.partials.menu-item')
            </div>
            <div class="col-auto col-lg-2 text-end">
                <div class="header-icon">

                    <div class="header-push-button icon">
                        <div class="push-button">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="push-menu push-menu-style-1 p-35px bg-dark-gray">
        <span class="close-menu text-white bg-dark-gray"><i class="fa-solid fa-xmark"></i></span>
        <div class="text-center push-menu-wrapper text-dark-gray" data-scroll-options='{ "theme": "dark" }'>
            <div class="w-100">
                <img src="{{ asset('images/kingemran.png') }}" data-at2x="{{ asset('images/kingemran.png') }}" class="mb-20" alt="" />
                <div class="d-inline-block align-middle bg-very-light-gray fw-600 text-dark-gray text-uppercase border-radius-22px ps-25px pe-25px fs-13 mb-15px">Perjalanan Suci</div>
                <h3 class="fw-600 mb-0 alt-font text-golden-yellow ls-minus-1px lh-38">Mitra Perjalanan Terpercaya</h3>
            </div>
            <div class="row align-items-center justify-content-center mt-20 mb-20 row-cols-3 row-cols-md-3 gutter-very-small row-cols-sm-3 instagram-follow-api position-relative">
                <div class="col instafeed-grid mb-10px">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
                <div class="col instafeed-grid mb-10px">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
                <div class="col instafeed-grid mb-10px">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
                <div class="col instafeed-grid">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
                <div class="col instafeed-grid">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
                <div class="col instafeed-grid">
                    <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                </div>
            </div>
            <div class="col-12 text-center newsletter-style-02 position-relative mb-0">
                <span class="fs-18 w-80 mx-auto text-golden-yellow lh-26 d-inline-block mb-25px">Hubungi kami sekarang</span>
            </div>
            <div class="col btn-dual text-center mb-20">
                <a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" class="btn btn-extra-large fw-600 btn-rounded with-rounded btn-white btn-box-shadow d-table d-lg-inline-block lg-mb-15px md-mx-auto">Mulai Ibadah<span class="bg-dark-gray text-white"><i class="fa-brands fa-whatsapp text-green" aria-hidden="true"></i></span></a>
            </div>

            <div class="col-12 text-center elements-social social-icon-style-01">
                <ul class="small-icon dark mb-0">
                    <li><a class="facebook" href="{{ $settings['sosmed_facebook'] }}" target="_blank"><i class="text-golden-yellow fa-brands fa-facebook-f"></i></a></li>
                    <li><a class="tiktok" href="{{ $settings['sosmed_tiktok'] }}" target="_blank"><i class="text-golden-yellow fa-brands fa-tiktok"></i></a></li>
                    <li><a class="youtube" href="{{ $settings['sosmed_youtube'] }}" target="_blank"><i class="text-golden-yellow fa-brands fa-youtube"></i></a></li>
                    <li><a class="instagram" href="{{ $settings['sosmed_instagram'] }}" target="_blank"><i class="text-golden-yellow fa-brands fa-instagram"></i></a></li>
                    <li><a class="mail" href="{{ $settings['kontak_email'] }}" target="_blank"><i class="text-golden-yellow fa fa-envelope"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.navbar-toggler, .navbar-collapse').forEach(function (element) {
                element.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        });
    </script>
@endpush
