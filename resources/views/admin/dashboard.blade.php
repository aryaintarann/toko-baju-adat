@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Dashboard</h1>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                    <p class="text-xs text-green-600">{{ $stats['active_products'] }} aktif</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                    <p class="text-xs text-amber-600">{{ $stats['pending_orders'] }} pending</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Orders --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-900">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}"
                    class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 text-sm">{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $order->customer_name }} •
                                {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900 text-sm">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ $order->status->color() }}">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-gray-500 text-sm">Belum ada pesanan</div>
                @endforelse
            </div>
        </div>

        {{-- Low Stock --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">⚠️ Stok Menipis</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($lowStockProducts as $product)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 text-sm">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">{{ $product->category->name ?? 'N/A' }}</p>
                        </div>
                        <span class="px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">{{ $product->stock }}
                            pcs</span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-gray-500 text-sm">Semua stok cukup 👍</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection