 <!-- start section -->
 <section class="bg-solitude-blue background-position-center-top sm-background-image-none" style="background-image: url('/web/images/vertical-line-bg-medium-gray.svg')">
     <div class="container">
         <div class="row justify-content-center mb-3">
             <div class="col-xl-6 col-lg-8 text-center">
                 <h3 class="fw-600 text-dark-gray ls-minus-1px">STAFF KECAMATAN TLOGOSARI</h3>
             </div>
         </div>
         <div class="row" data-anime='{ "el": "childs", "translateX": [-50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>

             <div class="col swiper slider-four-slide clients-style-01 light pb-10 sm-pb-15" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "pagination": { "el": ".slider-four-slide-pagination-1", "clickable": true }, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-four-slide-next-1", "prevEl": ".slider-four-slide-prev-1" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 4 }, "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 } }, "effect": "slide" }'>
                 <div class="swiper-wrapper">
                     @foreach($employee as $employees)
                        <div class="swiper-slide">
                         <!-- start team member item -->
                         <div class="col text-center team-style-01 md-mb-30px">
                             <figure class="mb-0 hover-box box-hover position-relative">
                                 <img src="{{ $employees->photo_url }}" alt="" class="border-radius-6px" />
                                 <figcaption class="w-100 p-30px lg-p-20px bg-white">
                                     <div class="position-relative z-index-1 overflow-hidden lg-pb-5px">
                                         <span class="fs-18 d-block fw-600 text-dark-gray lh-26 ls-minus-05px">{{ $employees->name }}</span>
                                         <p class="m-0">{{ $employees->position }}</p>
                                         <div class="social-icon hover-text mt-20px lg-mt-10px social-icon-style-05">
                                             <a href="tel:{{ $employees->phone }}" target="_blank" class="fw-600 text-dark-gray">{{ $employees->phone }}</a>

                                         </div>
                                     </div>
                                     <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                                 </figcaption>
                             </figure>
                         </div>
                         <!-- end team member item -->
                     </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- end section -->
