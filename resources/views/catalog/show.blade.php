@extends('layouts.app')

@section('title', $product->name . ' - Toko Baju Adat Bali')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        {{-- Breadcrumb --}}
        <nav class="mb-6 flex items-center gap-2 text-sm text-warm-500">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('catalog.index') }}" class="hover:text-primary-600">Katalog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-warm-700">{{ $product->name }}</span>
        </nav>

        <div class="lg:flex lg:gap-12">
            {{-- Product Image --}}
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <div class="bg-white rounded-2xl overflow-hidden border border-warm-100 shadow-sm">
                    <div
                        class="aspect-square bg-gradient-to-br from-warm-100 to-primary-50 flex items-center justify-center">
                        @if($product->image && Storage::disk('public')->exists($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="text-center">
                                <svg class="w-24 h-24 text-primary-200 mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-primary-400 mt-2">{{ $product->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-warm-100 shadow-sm">
                    <span
                        class="inline-block bg-primary-50 text-primary-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">{{ $product->category->name }}</span>
                    <h1 class="font-display text-2xl md:text-3xl font-bold text-warm-900 mb-4">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-primary-700 mb-6">{{ $product->formatted_price }}</p>

                    <div class="prose prose-warm max-w-none mb-6">
                        <p class="text-warm-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-warm-100">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-warm-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="text-sm text-warm-600">Stok: <strong
                                    class="{{ $product->stock <= 5 ? 'text-accent-600' : 'text-green-600' }}">{{ $product->stock }}
                                    pcs</strong></span>
                        </div>
                    </div>

                    @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-end gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div>
                                <label class="block text-sm font-medium text-warm-700 mb-2">Jumlah</label>
                                <div class="flex items-center border border-warm-200 rounded-xl overflow-hidden">
                                    <button type="button" onclick="decrementQty()"
                                        class="px-4 py-2.5 text-warm-600 hover:bg-warm-50 transition-colors">−</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center py-2.5 border-x border-warm-200 focus:outline-none">
                                    <button type="button" onclick="incrementQty()"
                                        class="px-4 py-2.5 text-warm-600 hover:bg-warm-50 transition-colors">+</button>
                                </div>
                            </div>
                            <button type="submit"
                                class="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8l-1.68-8M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="bg-warm-100 rounded-xl p-4 text-center">
                            <p class="text-warm-500 font-medium">Stok habis</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="font-display text-2xl font-bold text-warm-900 mb-6">Produk Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('catalog.show', $related->slug) }}"
                            class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-warm-100">
                            <div
                                class="aspect-[4/3] bg-gradient-to-br from-warm-100 to-primary-50 flex items-center justify-center">
                                @if($related->image && Storage::disk('public')->exists($related->image))
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-12 h-12 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-display font-bold text-warm-900 group-hover:text-primary-700 transition-colors">
                                    {{ $related->name }}</h3>
                                <p class="text-lg font-bold text-primary-700 mt-1">{{ $related->formatted_price }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function incrementQty() {
                const input = document.getElementById('quantity');
                const max = parseInt(input.max);
                if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
            }
            function decrementQty() {
                const input = document.getElementById('quantity');
                if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
            }
        </script>
    @endpush
@endsection