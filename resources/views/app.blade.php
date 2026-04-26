<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="../../../" />
        <meta charset="utf-8">
        <title inertia> {{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Halaman Admin untuk website dinas" />
        <meta name="keywords" content="Halaman admin website" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="Admin Website" />
        <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
        <meta property="og:url" content="https://bondowosokab.go.id" />
        <meta property="og:site_name" content="Admin Website" />
        <!-- Fonts -->

        <link rel="shortcut icon" href="/favicon.png" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <link href="{{ url('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">

        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body id="kt_body" class="{{ $page['props']['bodyClass'] ?? '' }}" >
        <!--begin::Theme mode setup on page load-->
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <!--end::Theme mode setup on page load-->
        <!--begin::Main-->
        @inertia
        <script>var hostUrl = "assets/";</script>
        <script src="{{ url('/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ url('/assets/js/scripts.bundle.js') }}"></script>

    </body>
</html>
