
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>@yield('title', 'Home') - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Afi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="Website resmi {{ config('app.name') }}">
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
        <meta property="og:description" content="Website resmi {{ config('app.name') }}"/>
        <meta property="og:image:type" content="image/jpeg"/>
        <meta property="og:image:width" content="400"/>
        <meta property="og:image:height" content="400"/>
    @endif
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- slider revolution CSS files -->
    {{--<link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('web/revolution/css/navigation.css') }}">--}}
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ url('/web/css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ url('/web/demos/travel-agency/travel-agency.css') }}" />
    {{--<script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('web/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>--}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4GLR97Q4PK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4GLR97Q4PK');
    </script>
    <style>
        .top-decoration {
            position: relative;
            z-index: 10;
        }
    </style>
    @stack('css')

</head>
<body data-mobile-nav-style="classic">
<!-- start header -->
@include('frontend.partials.navbar')
<!-- end header -->
<!-- start section -->
@yield('content')



<!-- start footer -->
@include('frontend.partials.footer')
<!-- end footer -->
<!-- start scroll progress -->
<div class="scroll-progress d-none d-xxl-block">
    <a href="#" class="scroll-top" aria-label="scroll">
        <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
    </a>
</div>
<!-- end scroll progress -->
<!-- javascript libraries -->
<!-- javascript libraries -->
<script type="text/javascript" src="{{ asset('web/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/js/vendors.min.js') }}"></script>

<!-- slider revolution core javaScript files -->
{{--<script type="text/javascript" src="{{ asset('web/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>--}}

<!-- slider revolution extension scripts. ONLY NEEDED FOR LOCAL TESTING -->
{{--<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>--}}
<!-- Slider Revolution add on files -->
{{--<script type='text/javascript' src="{{ asset('web/revolution/revolution-addons/particles/js/revolution.addon.particles.min.js?ver=1.0.3') }}"></script>--}}
<!-- Slider's main "init" script -->


<script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

@stack('js')
</body>
</html>
