@extends('layouts.app')

@section('title', 'Keranjang Belanja - Toko Baju Adat Bali')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <h1 class="font-display text-3xl font-bold text-warm-900 mb-8">Keranjang Belanja</h1>

        @if(count($cartItems) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-warm-100 overflow-hidden">
                <div class="divide-y divide-warm-100">
                    @foreach($cartItems as $item)
                        <div class="p-5 md:p-6 flex flex-col sm:flex-row sm:items-center gap-4">
                            {{-- Product Image --}}
                            <div
                                class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-gradient-to-br from-warm-100 to-primary-50">
                                @if($item['product']->image && Storage::disk('public')->exists($item['product']->image))
                                    <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Product Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('catalog.show', $item['product']->slug) }}"
                                    class="font-display font-bold text-warm-900 hover:text-primary-700 transition-colors">{{ $item['product']->name }}</a>
                                <p class="text-primary-700 font-semibold mt-1">{{ $item['product']->formatted_price }}</p>
                            </div>

                            {{-- Quantity --}}
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.update') }}" method="POST"
                                    class="flex items-center border border-warm-200 rounded-xl overflow-hidden">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}"
                                        class="px-3 py-2 text-warm-600 hover:bg-warm-50 transition-colors">−</button>
                                    <span
                                        class="px-3 py-2 text-sm font-medium border-x border-warm-200 min-w-[40px] text-center">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity"
                                        value="{{ min($item['product']->stock, $item['quantity'] + 1) }}"
                                        class="px-3 py-2 text-warm-600 hover:bg-warm-50 transition-colors">+</button>
                                </form>

                                <span class="font-bold text-warm-900 min-w-[100px] text-right">Rp
                                    {{ number_format($item['subtotal'], 0, ',', '.') }}</span>

                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-warm-400 hover:text-accent-600 transition-colors"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <div class="bg-warm-50 px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <span class="text-warm-600">Total:</span>
                        <span class="text-2xl font-bold text-warm-900 ml-2">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('catalog.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 border border-warm-300 rounded-xl text-warm-700 hover:bg-white font-medium transition-all">
                            ← Lanjut Belanja
                        </a>
                        <a href="{{ route('checkout.index') }}"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-8 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40">
                            Checkout
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-warm-100 shadow-sm">
                <svg class="w-20 h-20 text-warm-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8l-1.68-8M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
                <h2 class="font-display text-xl font-bold text-warm-900 mb-2">Keranjang Kosong</h2>
                <p class="text-warm-500 mb-6">Belum ada produk di keranjang belanja Anda</p>
                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg">
                    Mulai Belanja
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
@endsection