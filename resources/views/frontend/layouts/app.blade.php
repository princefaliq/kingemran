
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>@yield('title', 'Home')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Afi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="Website resmi {{ config('app.name') }} Kabupaten Bondowoso">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon.png">
    @hasSection('berita')
        @yield('berita')
    @else
        <meta property="og:title" content="@yield('title') - {{ config('app.name') }}"/>
        <meta property="og:type" content="Website"/>
        <meta property="og:url" content="{{ url('/') }}"/>
        <meta property="og:image" content="{{ url('/') }}/favicon.png"/>
        <meta property="og:description" content="Website resmi {{ config('app.name') }} Kabupaten Bondowoso"/>
        <meta property="og:image:type" content="image/jpeg"/>
        <meta property="og:image:width" content="400"/>
        <meta property="og:image:height" content="400"/>
    @endif
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ url('/web/css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/demos/business/business.css') }}" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4GLR97Q4PK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4GLR97Q4PK');
    </script>
    @stack('css')
</head>
<body data-mobile-nav-style="classic">
<!-- start header -->
@include('frontend.partials.navbar')
<!-- end header -->
@yield('content')






{{--<!-- start section -->
<section class="bg-solitude-blue pt-4 pb-4 lg-pt-6 lg-pb-6" data-parallax-background-ratio="0.5" style="background-image: url('/web/images/vertical-line-bg-medium-gray.svg')" data-anime='{ "translateX": [0, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
    <div class="opacity-medium bg-dark-slate-blue"></div>
    <div class="container z-index-1 position-relative">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h4 class="alt-font text-white mb-0 fw-300 fancy-text-style-4">We make the creative solutions for
                    <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "down", "string": ["business!", "problems!", "brands!"], "duration": 3500 }'></span>
                </h4>
            </div>
        </div>
    </div>
</section>--}}
<!-- end section -->
@include('frontend.partials.footer')
<!-- start sticky column -->
<div class="sticky-wrap z-index-1 d-none d-xl-inline-block" data-animation-delay="100" data-shadow-animation="true">
    <span class="fs-15 fw-500"><i class="feather icon-feather-home icon-small me-10px align-middle"></i>Kecamatan Tlogosari — <a href="https://bondowosokab.go.id" target="_blank" class="text-decoration-line-bottom fw-600">Kabupaten Bondowoso</a></span>
</div>
<!-- end sticky column -->
<!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
    <a href="#" class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </a>
</div>
<!-- end scroll progress -->
<!-- javascript libraries -->
<script type="text/javascript" src="{{ asset('web/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

@stack('js')
</body>
</html>
