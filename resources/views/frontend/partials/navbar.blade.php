<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light">
        <div class="container-fluid">
            <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="/">
                    <img src="{{ url('/web/images/logokec.png') }}" data-at2x="{{ url('/web/images/logokec.png') }}" alt="" class="default-logo">
                    <img src="{{ url('/web/images/logokec.png') }}" data-at2x="{{ asset('web/images/demo-business-logo-black@2x.png') }}" alt="" class="alt-logo">
                    <img src="{{ url('/web/images/logokec.png') }}" data-at2x="{{ asset('web/images/demo-business-logo-black@2x.png') }}" alt="" class="mobile-logo">
                </a>
            </div>
            <div class="col-auto menu-order position-static">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                @include('frontend.partials.menu-item')
            </div>
            <div class="col-auto col-xxl-3 col-lg-2 text-end d-none d-sm-flex">
                <div class="header-icon">
                    <div class="d-none d-xxl-inline-block me-25px xxl-me-10px"><div class="alt-font fs-15 xl-fs-13 widget-text fw-500"><span class="w-35px h-35px bg-base-color d-inline-block lh-36 me-10px border-radius-100px"><i class="feather icon-feather-phone me-10px"></i></span><a href="tel:{{ $settings['kontak_telepon'] }}" class="widget-text text-white-hover">{{ $settings['kontak_telepon'] }}</a></div></div>
                    <div class="header-button"><a href="https://kanda.bondowosokab.go.id" target="_blank" title="Kanda" class="btn btn-very-small btn-transparent-white-light btn-rounded">Pengaduan</a></div>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
