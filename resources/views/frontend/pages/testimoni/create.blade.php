@extends('frontend.layouts.app')
@section('title', 'Kirim Testimoni')
@push('css')
    <style>
        .testimonial-form label {
            color: #ffffff !important;
        }

        .testimonial-form .form-control {
            color: #ffffff !important;
            border-color: #d4af37 !important;
        }

        .testimonial-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .testimonial-form .form-icon i {
            color: #d4af37 !important;
        }

        .testimonial-form select.form-control {
            color: #ffffff !important;
        }

        .testimonial-form select.form-control option {
            color: #000000;
        }
    </style>
@endpush

@section('content')
    <section class="page-title-parallax-background bg-dark-gray ipad-top-space-margin"
             style="background-image: url('{{ asset('web/images/demo-spa-salon-contact-title-bg.jpg') }}')">
        <div class="opacity-very-light bg-gradient-nero-grey-brown"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center position-relative page-title-extra-large">
                    <h1 class="text-white alt-font mb-0 fw-400 ls-minus-1px">Kirim Testimoni</h1>
                    <div class="breadcrumb breadcrumb-style-01 text-white justify-content-center mt-10px">
                        <ul>
                            <li><a href="{{ route('beranda') }}" class="text-white">Home</a></li>
                            <li>Testimoni</li>
                        </ul>
                    </div>
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
                    <form action="{{ route('testimonials.store') }}" method="POST" class="contact-form-style-03 testimonial-form" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-25px">
                                <label class="form-label fs-13 ls-1px text-uppercase text-dark-gray fw-500 mb-0">Nama</label>
                                <div class="position-relative form-group">
                                    <span class="form-icon"><i class="bi bi-emoji-smile text-dark-gray"></i></span>
                                    <input
                                        class="fs-17 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Masukkan nama Anda"
                                    />
                                </div>
                            </div>

                            <div class="col-md-12 mb-25px">
                                <label class="form-label fs-13 ls-1px text-uppercase text-dark-gray fw-500 mb-0">Program Spa</label>
                                <div class="position-relative form-group">
                                    <span class="form-icon"><i class="bi bi-journals text-dark-gray"></i></span>
                                    <select
                                        name="spa_program_id"
                                        class="fs-17 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control"
                                    >
                                        <option value="">Pilih program</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" {{ old('spa_program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->nama_paket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-35px">
                                <label class="form-label fs-13 ls-1px text-uppercase text-dark-gray fw-500 mb-0">Testimoni</label>
                                <div class="position-relative form-group form-textarea mb-0">
                                <textarea
                                    class="fs-17 ps-0 border-radius-0px border-color-dark-gray bg-transparent form-control"
                                    name="content"
                                    rows="5"
                                    placeholder="Tulis pengalaman Anda"
                                >{{ old('content') }}</textarea>
                                    <span class="form-icon"><i class="bi bi-chat-square-dots text-dark-gray"></i></span>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-small btn-double-border btn-border-base-color left-icon" type="submit">
                                <span>
                                    <span><i class="fa-regular fa-paper-plane"></i></span>
                                    <span class="btn-double-text" data-text="Kirim testimoni">Kirim testimoni</span>
                                </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
