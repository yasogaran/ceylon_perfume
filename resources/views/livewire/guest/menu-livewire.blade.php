<header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-4">
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">PerfumeCo</a>

        <nav>
            <ul class="flex space-x-6">
                @foreach ($menus as $menu)
                    <li>
                        <a href="{{ url($menu->url) }}" class="hover:text-indigo-500">
                            {{ $menu->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div>
            {{-- <a href="{{ route('cart.index') }}" class="relative">
                <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"></path>
                </svg>
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full text-xs px-1">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a> --}}
        </div>
    </div>
</header>
