<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800">
    
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        <main class="flex-1 p-4">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
