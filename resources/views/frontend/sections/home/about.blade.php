@php
    $about_image_1 = !empty($settings['about_image_1'])
        ?  asset('storage/' .$settings['about_image_1'])
        : asset('web/images/demo-lawyer.jpg');
    $about_image_2 = !empty($settings['about_image_2'])
        ?  asset('storage/' .$settings['about_image_2'])
        : asset('web/images/demo-lawyer.jpg');
@endphp
<!-- start section -->
<section class="extra-big-section background-position-center-bottom background-size-contain background-no-repeat position-relative pt-0" style="background-image:url('web/images/demo-travel-agency-home-bg-02.png');">
    <div class="position-absolute left-0px bottom-minus-50px d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/king_emran.png') }}" class="w-85px" alt="" />
    </div>
    <div class="container background-position-right background-no-repeat sm-mb-10 xs-mb-15" style="background-image:url('{{ asset('images/demo-travel-agency-home-bg.png') }}');">
        <div class="row align-items-center position-relative mb-7">
            <div class="position-absolute left-0px top-0px h-100 w-130px border-end border-color-extra-medium-gray d-none d-md-inline-block" data-anime='{ "translateX": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="vertical-title-center align-items-center justify-content-center">
                    <div class="title fs-24 alt-font text-base-color fw-600 text-uppercase">Langkah pasti ke Baitullah</div>
                </div>
            </div>
            <div class="col-lg-1 col-md-2 d-none d-md-inline-block"><div class="divider-dot d-flex align-items-center w-100 h-200px"></div></div>
            <div class="col-lg-5 col-md-9 offset-md-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h1 class="alt-font fw-600 text-dark-gray ls-minus-3px w-90 xl-w-100 mb-30px">{{ $settings['motto'] }}</h1>
                <p class="w-75 lg-w-100">{!! $settings['about'] !!}</p>
                <div class="d-inline-block mt-5px">
                    <a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" class="btn btn-large btn-round-edge btn-dark-gray btn-hover-animation btn-box-shadow me-25px">
                                <span>
                                    <span class="btn-text">Customer Service</span><span class="btn-icon"><i class="fa-brands fa-whatsapp"></i></span>
                                </span>
                    </a>
                    <a href="{{ url('/tentang-kami') }}" class="btn btn-link-gradient expand btn-extra-large text-dark-gray text-dark-gray-hover ls-0px">Tentang Kami<span class="bg-dark-gray"></span></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 position-relative offset-lg-1 offset-md-4 ps-0 sm-ps-15px md-mt-50px" data-anime='{ "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <img src="{{ $about_image_1 }}" class="border-radius-6px md-w-100" alt="">
                <img class="position-absolute left-minus-120px top-80px sm-top-0px sm-w-160px sm-left-0px w-240px" src="{{ $about_image_2 }}" alt="" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center" data-anime='{ "el": "childs", "rotateZ": [5, 0], "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <!-- start features box item -->
            <div class="col icon-with-text-style-01 md-mb-30px">
                <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                    <div class="feature-box-icon">
                        <i class="line-icon-Medal-2 icon-large text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-22 lg-fs-20 ls-minus-05px">Pelayanan Terbaik</span>
                        <p class="lh-24">Melayani sepenuh hati</p>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-01 md-mb-30px">
                <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                    <div class="feature-box-icon">
                        <i class="line-icon-Money icon-large text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-22 lg-fs-20 ls-minus-05px">Harga Terjangkau</span>
                        <p class="lh-24">Paket sesuai kebutuhan</p>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-01 xs-mb-30px">
                <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                    <div class="feature-box-icon">
                        <i class="line-icon-Add-UserStar icon-large text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-22 lg-fs-20 ls-minus-05px">Pembimbing Ahli</span>
                        <p class="lh-24">Ibadah lebih terarah</p>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-01">
                <div class="feature-box feature-box-left-icon-middle last-paragraph-no-margin">
                    <div class="feature-box-icon">
                        <i class="line-icon-Police icon-large text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-22 lg-fs-20 ls-minus-05px">Aman & Terpercaya</span>
                        <p class="lh-24">Perjalanan lebih tenang</p>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
        </div>
    </div>
</section>
<!-- end section -->
