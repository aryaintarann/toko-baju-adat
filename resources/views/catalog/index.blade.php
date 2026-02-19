@extends('layouts.app')

@section('title', 'Katalog - Toko Baju Adat Bali')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="font-display text-3xl md:text-4xl font-bold text-warm-900">Katalog Produk</h1>
        <p class="text-warm-500 mt-2">Temukan pakaian adat Bali impianmu</p>
    </div>

    <div class="lg:flex lg:gap-8">
        {{-- Sidebar Filters --}}
        <aside class="lg:w-64 shrink-0 mb-6 lg:mb-0">
            <div class="bg-white rounded-2xl shadow-sm border border-warm-100 p-5 sticky top-24">
                <h3 class="font-semibold text-warm-900 mb-4">Filter</h3>

                {{-- Search --}}
                <form method="GET" action="{{ route('catalog.index') }}" class="mb-5">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-warm-400 hover:text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </form>

                {{-- Categories --}}
                <div class="mb-5">
                    <h4 class="text-sm font-semibold text-warm-700 mb-3">Kategori</h4>
                    <div class="space-y-1">
                        <a href="{{ route('catalog.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                            class="block px-3 py-2 rounded-lg text-sm transition-colors {{ !request('category') ? 'bg-primary-50 text-primary-700 font-medium' : 'text-warm-600 hover:bg-warm-50' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('catalog.index', array_filter(['category' => $category->slug, 'search' => request('search'), 'sort' => request('sort')])) }}"
                                class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request('category') === $category->slug ? 'bg-primary-50 text-primary-700 font-medium' : 'text-warm-600 hover:bg-warm-50' }}">
                                {{ $category->name }}
                                <span class="text-warm-400">({{ $category->products_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Sort --}}
                <div>
                    <h4 class="text-sm font-semibold text-warm-700 mb-3">Urutkan</h4>
                    <div class="space-y-1">
                        @php $sorts = ['newest' => 'Terbaru', 'price_low' => 'Harga Terendah', 'price_high' => 'Harga Tertinggi']; @endphp
                        @foreach($sorts as $key => $label)
                            <a href="{{ route('catalog.index', array_filter(['category' => request('category'), 'search' => request('search'), 'sort' => $key])) }}"
                                class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request('sort') === $key ? 'bg-primary-50 text-primary-700 font-medium' : 'text-warm-600 hover:bg-warm-50' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        {{-- Products Grid --}}
        <div class="flex-1">
            @if($products->isEmpty())
                <div class="text-center py-20 bg-white rounded-2xl border border-warm-100">
                    <svg class="w-16 h-16 text-warm-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <p class="text-warm-500 text-lg">Tidak ada produk ditemukan</p>
                    <a href="{{ route('catalog.index') }}" class="inline-block mt-4 text-primary-600 hover:text-primary-700 font-medium">← Kembali ke katalog</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-warm-100">
                            <a href="{{ route('catalog.show', $product->slug) }}" class="block">
                                <div class="aspect-[4/3] bg-gradient-to-br from-warm-100 to-primary-50 relative overflow-hidden">
                                    @if($product->image && Storage::disk('public')->exists($product->image))
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-14 h-14 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    @if($product->stock <= 5 && $product->stock > 0)
                                        <div class="absolute top-3 right-3 bg-accent-500 text-white text-xs font-bold px-2 py-1 rounded-full">Stok Terbatas</div>
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

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
