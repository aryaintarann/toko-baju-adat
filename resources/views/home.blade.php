@extends('layouts.app')

@section('title', 'Toko Baju Adat Bali - Warisan Budaya Nusantara')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-warm-950 via-warm-900 to-primary-950 text-white">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23d4882e&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-primary-500/20 border border-primary-500/30 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                    <span class="text-primary-300 text-sm font-medium">Koleksi Terbaru 2026</span>
                </div>
                <h1 class="font-display text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    Keindahan <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-300">Busana Adat</span> Bali
                </h1>
                <p class="text-lg md:text-xl text-warm-300 mb-8 leading-relaxed max-w-2xl">
                    Temukan koleksi pakaian adat Bali terlengkap. Dari udeng hingga kebaya, semua dibuat dengan bahan berkualitas dan sentuhan tradisional yang autentik.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-8 py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40 hover:-translate-y-0.5">
                        Lihat Katalog
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#featured" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-8 py-3.5 rounded-xl font-semibold transition-all">
                        Produk Unggulan
                    </a>
                </div>
            </div>
        </div>
        {{-- Decorative elements --}}
        <div class="absolute top-20 right-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-40 w-48 h-48 bg-accent-500/10 rounded-full blur-3xl"></div>
    </section>

    {{-- Categories Section --}}
    <section class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm tracking-wider uppercase">Kategori</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-warm-900 mt-2">Jelajahi Koleksi Kami</h2>
                <p class="text-warm-500 mt-3 max-w-xl mx-auto">Berbagai pilihan pakaian adat Bali untuk segala keperluan upacara dan acara tradisional</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-warm-100">
                        <div class="aspect-square bg-gradient-to-br from-primary-100 to-warm-100 flex items-center justify-center p-6">
                            <div class="text-center">
                                <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    @if($category->slug === 'pakaian-pria')
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    @elseif($category->slug === 'pakaian-wanita')
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    @elseif($category->slug === 'aksesoris')
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    @else
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </div>
                                <h3 class="font-display text-lg font-bold text-warm-900">{{ $category->name }}</h3>
                                <p class="text-warm-500 text-sm mt-1">{{ $category->products_count }} produk</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section id="featured" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm tracking-wider uppercase">Pilihan Terbaik</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-warm-900 mt-2">Produk Unggulan</h2>
                <p class="text-warm-500 mt-3 max-w-xl mx-auto">Koleksi terbaik yang paling diminati pelanggan kami</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($featuredProducts as $product)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-warm-100">
                        <a href="{{ route('catalog.show', $product->slug) }}" class="block">
                            <div class="aspect-[4/3] bg-gradient-to-br from-warm-100 to-primary-50 relative overflow-hidden">
                                @if($product->image && Storage::disk('public')->exists($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-16 h-16 text-primary-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <p class="text-primary-400 text-sm mt-2">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($product->is_featured)
                                    <div class="absolute top-3 left-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        ⭐ Unggulan
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <span class="text-primary-600 text-xs font-semibold tracking-wider uppercase">{{ $product->category->name }}</span>
                                <h3 class="font-display text-lg font-bold text-warm-900 mt-1 group-hover:text-primary-700 transition-colors">{{ $product->name }}</h3>
                                <p class="text-warm-500 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>
                                <div class="flex items-center justify-between mt-4 pt-4 border-t border-warm-100">
                                    <span class="text-xl font-bold text-primary-700">{{ $product->formatted_price }}</span>
                                    <span class="text-xs text-warm-400">Stok: {{ $product->stock }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 bg-warm-900 hover:bg-warm-800 text-white px-8 py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-warm-900/40">
                    Lihat Semua Produk
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm tracking-wider uppercase">Keunggulan</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-warm-900 mt-2">Mengapa Memilih Kami?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-warm-100 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-warm-900 mb-2">Kualitas Premium</h3>
                    <p class="text-warm-500 text-sm">Bahan terbaik dengan jahitan rapi dari pengrajin berpengalaman</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-warm-100 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-warm-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-warm-500 text-sm">Dikemas dengan aman dan dikirim ke seluruh Indonesia</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-warm-100 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-warm-900 mb-2">Tanpa Ribet</h3>
                    <p class="text-warm-500 text-sm">Belanja mudah tanpa perlu daftar atau login, langsung checkout!</p>
                </div>
            </div>
        </div>
    </section>
@endsection
