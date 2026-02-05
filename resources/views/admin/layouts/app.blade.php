<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Admin Dashboard - Acadimy Sham'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('admin.partials.styles')
    @stack('styles')
</head>
<body class="min-h-screen">
    @include('admin.partials.header')

    <div class="flex">
        @include('admin.partials.sidebar')

        <main class="flex-1 p-6 md:ml-0">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    @include('admin.partials.scripts')
    @livewireScripts
</body>
</html>