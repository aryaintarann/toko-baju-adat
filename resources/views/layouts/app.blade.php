<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toko Baju Adat Bali - Koleksi pakaian tradisional Bali berkualitas tinggi">
    <title>@yield('title', 'Toko Baju Adat Bali')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-warm-50 text-warm-950 min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-primary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-primary-500 to-accent-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-primary-400/50 transition-shadow">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="font-display text-lg md:text-xl font-bold text-primary-800 leading-tight block">Baju
                            Adat Bali</span>
                        <span class="text-xs text-warm-500 hidden sm:block">Warisan Budaya Nusantara</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"
                        class="text-warm-700 hover:text-primary-600 font-medium transition-colors {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">Beranda</a>
                    <a href="{{ route('catalog.index') }}"
                        class="text-warm-700 hover:text-primary-600 font-medium transition-colors {{ request()->routeIs('catalog.*') ? 'text-primary-600' : '' }}">Katalog</a>
                    <a href="{{ route('tracking.index') }}"
                        class="text-warm-700 hover:text-primary-600 font-medium transition-colors {{ request()->routeIs('tracking.*') ? 'text-primary-600' : '' }}">Cek
                        Pesanan</a>
                    <a href="{{ route('refund.policy') }}"
                        class="text-warm-700 hover:text-primary-600 font-medium transition-colors {{ request()->routeIs('refund.*') ? 'text-primary-600' : '' }}">Refund</a>
                    <a href="{{ route('cart.index') }}" class="relative group">
                        <div
                            class="flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-primary-500/40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8l-1.68-8M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <span>Keranjang</span>
                            @if(session('cart') && count(session('cart')) > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-accent-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold animate-pulse">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </div>
                    </a>
                </div>

                {{-- Mobile Menu --}}
                <div class="md:hidden flex items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="relative p-2">
                        <svg class="w-6 h-6 text-warm-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8l-1.68-8M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-accent-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                    <button id="mobile-menu-btn" class="p-2 text-warm-700 hover:text-primary-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Dropdown --}}
            <div id="mobile-menu" class="md:hidden hidden pb-4 border-t border-primary-100 px-4">
                <a href="{{ route('home') }}"
                    class="block py-3 text-warm-700 hover:text-primary-600 font-medium">Beranda</a>
                <a href="{{ route('catalog.index') }}"
                    class="block py-3 text-warm-700 hover:text-primary-600 font-medium">Katalog</a>
                <a href="{{ route('tracking.index') }}"
                    class="block py-3 text-warm-700 hover:text-primary-600 font-medium">Cek Pesanan</a>
                <a href="{{ route('refund.policy') }}"
                    class="block py-3 text-warm-700 hover:text-primary-600 font-medium">Refund</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-warm-950 text-warm-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-display text-xl font-bold text-primary-400 mb-4">Baju Adat Bali</h3>
                    <p class="text-warm-400 text-sm leading-relaxed">Menyediakan berbagai koleksi pakaian adat Bali
                        berkualitas tinggi untuk upacara keagamaan, pernikahan, dan acara tradisional.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}"
                                class="text-warm-400 hover:text-primary-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('catalog.index') }}"
                                class="text-warm-400 hover:text-primary-400 transition-colors">Katalog</a></li>
                        <li><a href="{{ route('tracking.index') }}"
                                class="text-warm-400 hover:text-primary-400 transition-colors">Cek Status Pesanan</a>
                        </li>
                        <li><a href="{{ route('cart.index') }}"
                                class="text-warm-400 hover:text-primary-400 transition-colors">Keranjang</a></li>
                        <li><a href="{{ route('refund.policy') }}"
                                class="text-warm-400 hover:text-primary-400 transition-colors">Kebijakan Pengembalian
                                Dana</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-warm-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Jl. Raya Sukawati, Gianyar, Bali
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@bajuadatbali.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-warm-800 mt-8 pt-8 text-center text-sm text-warm-500">
                <p>&copy; {{ date('Y') }} Toko Baju Adat Bali. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>