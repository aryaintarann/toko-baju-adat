@extends('layouts.app')

@section('title', 'Cek Status Pesanan')

@section('content')
<div class="bg-stone-50 py-16 min-h-[calc(100vh-400px)]">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-serif text-neutral-900 mb-4 tracking-tight">Cek Status Pesanan</h1>
                <p class="text-neutral-600 max-w-2xl mx-auto">
                    Masukkan Nomor Pesanan Anda (contoh: ORD-...) untuk melacak status pesanan terkini.
                </p>
            </div>

            {{-- Flash Messages --}}
            @if(session('error'))
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    <p class="font-medium">Pencarian Gagal</p>
                    <p class="text-sm mt-1">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Tracking Form --}}
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-200 p-6 md:p-8 mb-8">
                <form action="{{ route('tracking.track') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-grow">
                        <label for="order_number" class="sr-only">Nomor Pesanan</label>
                        <input type="text" name="order_number" id="order_number" required
                            class="w-full px-5 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors"
                            placeholder="Contoh: ORD-17084..."
                            value="{{ old('order_number', request('order_number')) }}">
                        @error('order_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="px-8 py-3 bg-amber-800 hover:bg-neutral-900 text-white font-medium rounded-lg transition-colors shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Lacak Pesanan
                    </button>
                </form>
            </div>

            {{-- Order Result --}}
            @if(isset($order))
                <div class="bg-white rounded-2xl shadow-sm border border-neutral-200 overflow-hidden">
                    <div class="border-b border-neutral-200 bg-neutral-50 p-6 md:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-neutral-500 mb-1">Nomor Pesanan</p>
                            <h2 class="text-xl md:text-2xl font-bold tracking-tight text-neutral-900">{{ $order->order_number }}</h2>
                        </div>
                        <div class="text-left md:text-right">
                            <p class="text-sm text-neutral-500 mb-1">Status</p>
                            <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $order->status->color() }}">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div>
                                <h3 class="font-semibold text-neutral-900 mb-4 pb-2 border-b border-neutral-100">Informasi Pengiriman</h3>
                                <p class="text-neutral-800 font-medium">{{ $order->customer_name }}</p>
                                <p class="text-neutral-600 mt-1">{{ $order->customer_phone }}</p>
                                <p class="text-neutral-600 mt-1">{{ $order->customer_address }}</p>
                                @if($order->courier)
                                    <p class="text-neutral-600 mt-3"><span class="font-medium">Kurir:</span> {{ strtoupper($order->courier) }}</p>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900 mb-4 pb-2 border-b border-neutral-100">Ringkasan Pembayaran</h3>
                                <div class="flex justify-between mb-2">
                                    <span class="text-neutral-600">Total Harga Item</span>
                                    <span class="font-medium text-neutral-900">Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</span>
                                </div>
                                @if($order->shipping_cost)
                                <div class="flex justify-between mb-2">
                                    <span class="text-neutral-600">Ongkos Kirim</span>
                                    <span class="font-medium text-neutral-900">Rp {{ number_format((float)($order->shipping_cost ?? 0), 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between pt-3 mt-3 border-t border-neutral-100">
                                    <span class="font-semibold text-neutral-900">Total Belanja</span>
                                    <span class="font-bold text-amber-800 text-lg">Rp {{ number_format((float)$order->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-neutral-900 mb-4 pb-2 border-b border-neutral-100">Detail Item</h3>
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between items-center py-2">
                                        <div class="flex items-start gap-4">
                                            <div class="w-16 h-16 bg-neutral-100 rounded-lg overflow-hidden flex-shrink-0">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-neutral-400">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-neutral-900">{{ $item->product_name }}</p>
                                                <p class="text-neutral-500 text-sm mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="font-medium text-neutral-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
