<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Lokarasa') }} - Marketplace Kuliner Nusantara</title>
    <meta name="description"
        content="{{ $description ?? 'Lokarasa - Platform e-commerce terpercaya untuk kuliner khas dan makanan lokal Indonesia. Nikmati kelezatan Nusantara langsung di rumah Anda.' }}">
    <meta name="keywords" content="Kuliner Nusantara, makanan lokal, oleh-oleh Indonesia, jajanan pasar, Lokarasa">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_lokarasa.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_lokarasa.png') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'Lokarasa') }} - Marketplace Kuliner Nusantara">
    <meta property="og:description"
        content="{{ $description ?? 'Platform e-commerce terpercaya untuk kuliner khas dan makanan lokal Indonesia' }}">
    <meta property="og:image" content="{{ asset('images/logo_lokarasa.png') }}">
    <meta property="og:site_name" content="Lokarasa">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? config('app.name', 'Lokarasa') }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'Platform e-commerce terpercaya untuk kuliner khas dan makanan lokal Indonesia' }}">
    <meta name="twitter:image" content="{{ asset('images/logo_lokarasa.png') }}">

    <!-- Structured Data for Organization & Logo -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Lokarasa",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo_lokarasa.png') }}",
        "description": "Platform e-commerce terpercaya untuk kuliner khas dan makanan lokal Indonesia",
        "sameAs": [
            "https://github.com/Rahmat-dkh/localgocommerce"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-857-1296-6082",
            "contactType": "Customer Service",
            "email": "lokarasa@gmail.com"
        }
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased text-neutral-dark bg-neutral-light">
    <div class="min-h-screen" x-data="{ open: false, openMobileSearch: false }">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')

        <!-- Global Components -->
        <livewire:cart-panel />
        <livewire:wishlist-panel />

        <!-- Chat Widget Global -->
        <livewire:chat-widget />
    </div>

    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
    @stack('scripts')
</body>

</html>