@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pesanan</h1>
        <div class="flex gap-2">
            @php $statuses = ['all' => 'Semua', 'pending' => 'Pending', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai', 'cancelled' => 'Batal']; @endphp
            @foreach($statuses as $key => $label)
                <a href="{{ route('admin.orders.index', $key === 'all' ? [] : ['status' => $key]) }}"
                    class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ (request('status') === $key || (!request('status') && $key === 'all')) ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">No. Pesanan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Pelanggan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Tanggal</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $order->order_number }}</td>
                            <td class="px-5 py-3">
                                <p class="text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->customer_phone }}</p>
                            </td>
                            <td class="px-5 py-3 font-medium text-gray-900">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                <span
                                    class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $order->status->color() }}">
                                    {{ $order->status->label() }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="text-primary-600 hover:text-primary-700 font-medium text-sm">Detail →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-gray-500">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection