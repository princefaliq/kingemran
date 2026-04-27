<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent bg-transparent center-logo disable-fixed">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 menu-logo">
                <div class="d-none d-lg-block">
                    <a href="tel:{{ $settings['kontak_telepon'] }}" class="widget-text text-white-hover fs-16 lg-fs-15"><i class="feather icon-feather-phone icon-small me-5px lg-me-2px"></i>{{ $settings['kontak_telepon'] }}</a>
                </div>
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('favicon.png') }}" data-at2x="{{ asset('favicon.png') }}" alt="logo chantik spa & salon" class="default-logo">
                    <img src="{{ asset('favicon.png') }}" data-at2x="{{ asset('favicon.png') }}" alt="logo chantik spa & salon" class="alt-logo">
                    <img src="{{ asset('images/logo_putih.png') }}" data-at2x="{{ asset('images/logo_putih.png') }}" alt="logo chantik spa & salon" class="mobile-logo">
                </a>
            </div>
            <div class="col-auto col-lg-8 menu-order">
                <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                @include('frontend.partials.menu-item')
            </div>
            <div class="col-auto col-lg-2 text-end">
                <div class="header-icon">
                    <div class="header-social-icon icon">
                        <a href="{{ $settings['sosmed_facebook'] }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="{{ $settings['sosmed_instagram'] }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="{{ $settings['sosmed_tiktok'] }}" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
