@extends('frontend.layouts.app')
@section('title', 'Kirim Testimoni')
@push('css')
    <link href="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet"/>

    <style>
        #cropperModal .modal-body {
            max-height: 70vh;
            overflow: hidden;
        }

        #cropperImage {
            max-width: 100%;
            display: block;
        }

        /* tampilkan garis crop */
        .cropper-view-box {
            outline: 2px solid #fff !important;
        }

        .cropper-dashed {
            border-color: #fff !important;
        }

        .cropper-face {
            background-color: rgba(255,255,255,0.1) !important;
        }
    </style>
@endpush

@section('content')
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url({{ asset('images/kakbah.png') }})">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-12 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Pengalaman</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Jamaah kami</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="background-repeat py-5 pt-4 md-pt-8" style="background-image:url('/images/bg.png');">
        <div class="container mb-6">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <span class="fs-15 mb-5px text-base-color fw-500 d-block text-uppercase ls-2px">Testimoni Pengunjung</span>
                    <h3 class="alt-font ls-minus-1px text-dark-gray">Bagikan pengalaman Anda</h3>
                    <p class="text-dark-gray">Testimoni yang dikirim akan kami tinjau terlebih dahulu sebelum ditampilkan di website.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8">
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="contact-form-style-03 position-relative overflow-hidden p-40px lg-p-30px mb-30px">
                    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data"
                          class="no-ajax" autocomplete="off">
                        @csrf

                        {{-- Nama --}}
                        <div class="position-relative form-group mb-10px">
                            <span class="form-icon"><i class="bi bi-emoji-smile"></i></span>
                            <input class="ps-0 border-radius-0px border-bottom border-color-extra-medium-gray form-control required"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nama Anda*" required>
                        </div>

                        {{-- Paket Tour --}}
                        <div class="position-relative form-group mb-10px">
                            <span class="form-icon"><i class="bi bi-journals"></i></span>
                            <select name="tour_package_id"
                                    class="ps-0 border-radius-0px border-bottom border-color-extra-medium-gray form-control">
                                <option value="">Pilih paket tour</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}" {{ old('tour_package_id') == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Rating --}}
                        <div class="position-relative form-group mb-15px text-center">
                            <div id="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star fs-3 star" data-value="{{ $i }}" style="cursor:pointer"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="5">
                        </div>

                        {{-- Upload --}}
                        <div class="position-relative form-group mb-10px">
                            <span class="form-icon"><i class="bi bi-image"></i></span>
                            <input type="file"
                                   id="imageInput"
                                   class="ps-0 border-radius-0px border-bottom border-color-extra-medium-gray form-control">
                            <input type="hidden" name="image" id="croppedImage">
                        </div>

                        {{-- Preview Crop --}}
                        <div class="position-relative form-group mb-10px text-center">
                            <img id="preview" style="max-width:150px; display:none; border-radius:10px;">
                        </div>

                        {{-- Testimoni --}}
                        <div class="position-relative form-group form-textarea mt-15px mb-10px">
                        <textarea class="ps-0 border-radius-0px border-bottom border-color-extra-medium-gray form-control"
                          name="content"
                          placeholder="Tulis pengalaman Anda*"
                          rows="3"
                          required>{{ old('content') }}</textarea>
                            <span class="form-icon"><i class="bi bi-chat-square-dots"></i></span>
                        </div>

                        {{-- Submit --}}
                        <button class="btn btn-medium btn-dark-gray btn-box-shadow btn-round-edge mt-30px"
                                type="submit">
                            Kirim Testimoni
                        </button>

                        <div class="form-results mt-20px d-none"></div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="cropperModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <img id="cropperImage">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="cropBtn">Crop & Gunakan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.no-ajax');

            form.addEventListener('submit', function(e) {
                // 🔥 MATIKAN SEMUA AJAX
                e.preventDefault();

                // submit manual (native browser)
                this.submit();
            });
            // ===============================
            // ⭐ RATING BINTANG
            // ===============================
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            function setRating(value) {
                ratingInput.value = value;

                stars.forEach((star, index) => {
                    if (index < value) {
                        star.classList.remove('bi-star');
                        star.classList.add('bi-star-fill');
                    } else {
                        star.classList.remove('bi-star-fill');
                        star.classList.add('bi-star');
                    }
                });
            }

            // default
            setRating(5);

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const value = parseInt(this.getAttribute('data-value'));
                    setRating(value);
                });
            });

            // ===============================
            // 🖼️ CROPPER
            // ===============================
            let cropper = null;
            let currentUrl = null;

            const imageInput = document.getElementById('imageInput');
            const cropperImage = document.getElementById('cropperImage');
            const preview = document.getElementById('preview');
            const croppedInput = document.getElementById('croppedImage');

            const modalEl = document.getElementById('cropperModal');
            const modal = new bootstrap.Modal(modalEl);

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }

                if (currentUrl) {
                    URL.revokeObjectURL(currentUrl);
                }

                cropperImage.src = '';

                currentUrl = URL.createObjectURL(file);
                cropperImage.src = currentUrl;

                setTimeout(() => {
                    modal.show();
                }, 100);
            });

            modalEl.addEventListener('shown.bs.modal', function () {

                if (!cropperImage.src) return;

                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCrop: true,
                    autoCropArea: 0.8,
                    responsive: true,
                    background: false,
                    guides: true,
                    center: true,
                    highlight: true,
                });
            });

            modalEl.addEventListener('hidden.bs.modal', function () {

                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }

                if (currentUrl) {
                    URL.revokeObjectURL(currentUrl);
                    currentUrl = null;
                }

                cropperImage.src = '';
            });

            document.getElementById('cropBtn').addEventListener('click', function () {

                if (!cropper) {
                    alert('Cropper belum siap, pilih gambar ulang.');
                    return;
                }

                const canvas = cropper.getCroppedCanvas({
                    width: 500,
                    height: 500
                });

                const base64 = canvas.toDataURL('image/jpeg');

                preview.src = base64;
                preview.style.display = 'block';

                croppedInput.value = base64;

                modal.hide();
            });

        });
    </script>
@endpush
