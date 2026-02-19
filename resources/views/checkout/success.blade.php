@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Toko Baju Adat Bali')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="bg-white rounded-2xl shadow-sm border border-warm-100 p-8 md:p-12 text-center">
            <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="font-display text-3xl font-bold text-warm-900 mb-3">Pesanan Berhasil!</h1>
            <p class="text-warm-500 mb-8">Terima kasih telah berbelanja di Toko Baju Adat Bali</p>

            <div class="bg-warm-50 rounded-xl p-6 text-left mb-8">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-warm-500">No. Pesanan</span>
                        <p class="font-bold text-warm-900">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <span class="text-warm-500">Status</span>
                        <p class="font-bold text-primary-600 capitalize">{{ $order->status }}</p>
                    </div>
                    <div>
                        <span class="text-warm-500">Nama</span>
                        <p class="font-medium text-warm-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <span class="text-warm-500">Telepon</span>
                        <p class="font-medium text-warm-900">{{ $order->customer_phone }}</p>
                    </div>
                </div>

                <div class="border-t border-warm-200 mt-4 pt-4">
                    <span class="text-warm-500 text-sm">Alamat Pengiriman</span>
                    <p class="font-medium text-warm-900 text-sm mt-1">{{ $order->customer_address }}</p>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="text-left mb-6">
                <h3 class="font-semibold text-warm-900 mb-3">Detail Pesanan</h3>
                <div class="divide-y divide-warm-100 border border-warm-100 rounded-xl overflow-hidden">
                    @foreach($order->items as $item)
                        <div class="px-4 py-3 flex justify-between items-center bg-white">
                            <div>
                                <p class="font-medium text-warm-900 text-sm">{{ $item->product_name }}</p>
                                <p class="text-xs text-warm-500">{{ $item->quantity }}x @ Rp
                                    {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <span class="font-semibold text-warm-900 text-sm">Rp
                                {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div class="col-span-2 mt-4 border-t border-warm-200 pt-4">
                        <div class="flex justify-between items-center text-sm text-warm-600 mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-warm-600 mb-2">
                            <span>Ongkir ({{ strtoupper($order->courier) }} - {{ $order->shipping_service }})</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-warm-900">Total</span>
                            <span class="text-xl font-bold text-primary-700">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                @if($order->status === \App\Enums\OrderStatus::Pending && $order->snap_token)
                    <button id="pay-button"
                        class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40">
                        Bayar Sekarang
                    </button>
                @endif

                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center justify-center gap-2 border border-warm-300 text-warm-700 hover:bg-warm-50 px-6 py-3 rounded-xl font-medium transition-all">
                    Belanja Lagi
                </a>
            </div>
        </div>
    </div>

    @if($order->status === \App\Enums\OrderStatus::Pending && $order->snap_token)
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function () {
                snap.pay('{{ $order->snap_token }}', {
                    onSuccess: function (result) {
                        window.location.reload();
                    },
                    onPending: function (result) {
                        window.location.reload();
                    },
                    onError: function (result) {
                        alert("Pembayaran gagal!");
                    }
                });
            };
        </script>
    @endif
    </div>
    </div>
@endsection