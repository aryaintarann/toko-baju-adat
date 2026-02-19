@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.orders.index') }}"
                class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $order->order_number }}</h1>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Order Info --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Customer Info --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 mb-4">Informasi Pelanggan</h2>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Nama</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Email</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_email }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Telepon</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Alamat</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                    @if($order->notes)
                        <div class="mt-4 pt-4 border-t border-gray-100 text-sm">
                            <span class="text-gray-500">Catatan</span>
                            <p class="font-medium text-gray-900">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>

                {{-- Order Items --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Item Pesanan</h2>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left px-5 py-2.5 font-medium text-gray-600">Produk</th>
                                <th class="text-left px-5 py-2.5 font-medium text-gray-600">Harga</th>
                                <th class="text-left px-5 py-2.5 font-medium text-gray-600">Qty</th>
                                <th class="text-right px-5 py-2.5 font-medium text-gray-600">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-5 py-3 font-medium text-gray-900">{{ $item->product_name }}</td>
                                    <td class="px-5 py-3 text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-5 py-3 text-gray-600">{{ $item->quantity }}</td>
                                    <td class="px-5 py-3 text-right font-medium text-gray-900">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t border-gray-200">
                            <tr>
                                <td colspan="3" class="px-5 py-3 text-right font-bold text-gray-900">Total</td>
                                <td class="px-5 py-3 text-right text-lg font-bold text-primary-700">Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Status Update --}}
            <div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 sticky top-24">
                    <h2 class="font-semibold text-gray-900 mb-4">Status Pesanan</h2>

                    <div class="mb-4">
                        <span class="inline-block px-3 py-1.5 rounded-full text-sm font-medium
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-700' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                            ">{{ ucfirst($order->status) }}</span>
                    </div>

                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="space-y-3">
                        @csrf @method('PATCH')
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Ubah Status</label>
                            <select name="status" id="status"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection