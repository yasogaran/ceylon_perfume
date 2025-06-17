<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Perfume Company' }}</title>

    {{-- Meta SEO tags (optional dynamic) --}}
    <meta name="description" content="{{ $metaDescription ?? 'Best Perfume Products' }}" />
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- or your asset setup --}}
    @livewireStyles
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- @include('guest.partials.header') --}}
    @livewire('guest.menu-livewire')

    <main class="flex-grow container mx-auto px-4 py-6">
        {{ $slot }}
    </main>

    @include('guest.partials.footer')

    @livewireScripts
</body>

</html>
