@props(['focused' => false, 'title' => 'Virtual Tech Vibes Academy | Tuition Classes & AI Learning for Kids', 'description' => 'Virtual Tech Vibes Academy offers tuition classes for Prep–Class 8, all-subject academic support, AI learning for kids Age 7+, small batches, personal attention and future-ready skills.'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#10254f">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('images/academy-learning.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="{{ asset('images/vtv-logo.webp') }}" type="image/webp">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body @class(['booking-page' => $focused])>
    <a class="skip-link" href="#main">Skip to content</a>
    @if($focused)
        <header class="focused-header">
            <div class="wrap">
                <x-brand/>
                <nav class="booking-support" aria-label="Booking support">
                    <a href="{{ route('home') }}">Back to home</a>
                    <a href="tel:+919999373837" aria-label="Call support on 9999373837"><x-icon name="phone"/><span class="support-label">Need help? 9999373837</span></a>
                </nav>
            </div>
        </header>
    @else
        @include('partials.header')
    @endif
    <main id="main">{{ $slot }}</main>
    @if($focused)
        <footer class="focused-footer"><div class="wrap"><span>© {{ date('Y') }} Virtual Tech Vibes Academy</span><a href="{{ route('privacy') }}">Privacy notice</a></div></footer>
    @else
        @include('partials.footer')
    @endif
</body>
</html>
