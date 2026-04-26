@push('css')
    <style>
        /* Desktop tetap absolute + animasi */
        @media (min-width: 992px) {
            .pimpinan-img {
                position: absolute;
                bottom: -250px;
                right: 15px;
            }
        }

        /* Mobile: jadi normal + animasi tetap */
        @media (max-width: 991px) {
            .pimpinan-img {
                position: relative !important;
                bottom: 0 !important;
                right: 0 !important;
                margin: 20px auto;
                width: 100% !important;
                transform: none !important; /* reset posisi awal */
            }
        }
    </style>
@endpush

@php
    $foto = !empty($settings['pimpinan_foto'])
        ? asset('storage/' . $settings['pimpinan_foto'])
        : asset('web/images/demo-lawyer.jpg');
@endphp
<!-- start section -->
<section class="pb-8 md-pb-17 xs-pb-28">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9 md-mb-50px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Camat Tlogosari</span>
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px mb-20px sm-w-85 xs-w-100 mx-auto">{{ $settings['pimpinan_nama'] }}</h3>
                <p>{!! $settings['pimpinan_sambutan'] !!}</p>

            </div>
            <div class="col-xl-6 col-lg-6 offset-xl-1 position-relative">
                <div class="text-end" data-animation-delay="500" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                    <img src="{{ $foto }}" alt="" class="border-radius-5px">
                </div>
                {{--<div class="w-60 md-w-50 xs-w-55 overflow-hidden position-absolute left-15px bottom-minus-50px" data-shadow-animation="true" data-animation-delay="500" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
                    <img src="https://placehold.co/638x638" alt="" class="border-radius-5px box-shadow-quadruple-large" />
                </div>--}}
            </div>
        </div>
    </div>
</section>
<!-- end section -->
