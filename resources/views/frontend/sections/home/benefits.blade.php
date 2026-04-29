<!-- start section -->
<section class="background-repeat border-top border-color-light-gray position-relative overlap-height z-index-1" style="background-image:url('/images/bg.png');">
    <div class="overlap-section text-center mb-6 z-index-minus-1 d-none d-md-block">
        <img src="{{ asset('images/logo_putih.png') }}" class="w-85px" alt="">
    </div>
    <div class="position-absolute right-minus-100px top-50 z-index-minus-1 d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
        <img src="{{ asset('images/demo-spa-salon-bg-img-05.png') }}" alt="">
    </div>
    <div class="container overlap-gap-section">
        <div class="row align-items-center position-relative justify-content-center justify-content-lg-start">
            <div class="position-absolute left-0px top-0px h-100 w-130px d-none d-lg-inline-block">
                <div class="vertical-title-center align-items-center justify-content-center">
                    <div class="title fs-16 ls-2px text-uppercase">
                        Perawatan untuk
                        <span class="text-dark-gray fw-600 fancy-text-style-4">
                            <span data-fancy-text='{ "effect": "rotate", "string": ["Relaksasi", "Kecantikan", "Kepercayaan Diri"], "speed": 50 }'></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-11 position-relative offset-lg-1 md-mb-35px">
                <img src="{{ asset('images/benefit_spa2.png') }}" class="w-100 border-radius-4px" alt="">
            </div>
            <div class="col-xl-5 col-lg-6 col-md-11 ps-8 md-ps-15px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="fs-15 lg-10px mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Spa & Beauty Experience</span>
                <h3 class="alt-font ls-minus-1px text-dark-gray">Perawatan alami untuk tubuh yang rileks dan tampilan yang lebih cantik.</h3>
                <p class="w-80 xl-w-90 md-w-100 mb-10px">Omah Chantik Spa & Beauty menghadirkan pengalaman perawatan yang menenangkan dengan sentuhan profesional, suasana nyaman, dan pilihan treatment untuk membantu Anda merasa segar, rileks, dan lebih percaya diri.</p>
                <ul class="p-0 list-style-01 fs-20 alt-font mb-25px">
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Relaksasi tubuh dan pikiran</li>
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Perawatan kulit lebih terawat</li>
                    <li class="border-color-light-gray pt-15px pb-15px text-dark-gray">Membantu tampil segar dan percaya diri</li>
                </ul>
                <div class="d-inline-block w-100">
                    <a href="{{ $whatsappUrl($settings['kontak_telepon'] ?? '') }}" target="_blank" rel="noopener" class="btn btn-small btn-double-border btn-border-base-color">
                        <span>
                            <span class="btn-double-text" data-text="Booking Sekarang">Booking Sekarang</span>
                            <span><i class="fa-solid fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="background-repeat p-0" style="background-image:url('/images/bg.png');">
    <div class="container-fluid p-0">
        <div class="row align-items-center g-0 justify-content-center">
            <div class="col">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
            <div class="col-5 col-lg-2 col-sm-3 text-center position-relative">
                <img src="{{ asset('images/melingkar.png') }}" class="animation-rotation" alt="">
                <div class="absolute-middle-center lg-w-75"><img class="w-75" src="/favicon.png" alt=""></div>
            </div>
            <div class="col">
                <div class="divider-style-03 divider-style-03-01 border-color-light-gray"></div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
