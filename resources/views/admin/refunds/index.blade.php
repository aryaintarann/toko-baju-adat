@extends('admin.layouts.app')

@section('title', 'Kelola Refund')

@section('header', 'Kelola Pengajuan Refund')

@section('content')
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

        @if(session('success'))
            <div class="p-4 bg-green-50 border-b border-green-100 text-green-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-medium">No. Pesanan / Tgl</th>
                        <th class="px-6 py-4 font-medium">Nominal Refund</th>
                        <th class="px-6 py-4 font-medium">Data Rekening</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($refunds as $refund)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900 border-b border-dashed border-gray-300 inline-block mb-1"
                                    title="Lihat pesanan">
                                    <a href="{{ route('admin.orders.show', $refund->order) }}" class="hover:text-amber-600">
                                        {{ $refund->order->order_number }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500">{{ $refund->created_at->format('d M Y, H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-amber-700">
                                {{ $refund->order->formatted_total }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $refund->bank_name }}</div>
                                <div class="text-gray-500">{{ $refund->account_number }} a.n {{ $refund->account_name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($refund->status === 'pending')
                                    <span
                                        class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-medium">Pending</span>
                                @elseif($refund->status === 'approved')
                                    <span
                                        class="px-2.5 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">Disetujui</span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openRefundModal({{ $refund->toJson() }}, {{ $refund->order->toJson() }})"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-50 hover:text-amber-600 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Proses Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">Belum ada pengajuan refund</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($refunds->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $refunds->links() }}
            </div>
        @endif
    </div>

    <!-- Refund Processing Modal -->
    <div id="refundModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="closeRefundModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative z-10 inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                <form id="refundProcessForm" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 text-center">
                        <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                            Proses Pengajuan Refund
                        </h3>
                    </div>

                    <div class="px-6 py-4 bg-gray-50/50 text-sm space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-3 rounded border border-gray-100">
                                <span class="block text-xs text-gray-500 mb-1">Nomor Pesanan</span>
                                <span class="font-bold text-gray-800" id="modalOrderNumber">ORD-...</span>
                            </div>
                            <div class="bg-white p-3 rounded border border-gray-100">
                                <span class="block text-xs text-gray-500 mb-1">Nominal Dikembalikan</span>
                                <span class="font-bold text-amber-700" id="modalTotalAmount">Rp ...</span>
                            </div>
                        </div>

                        <div class="bg-white p-3 rounded border border-gray-100 space-y-2">
                            <span class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Tujuan
                                Transfer</span>
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <span class="block text-xs text-gray-500">Bank/E-Wallet</span>
                                    <span class="font-medium text-gray-800" id="modalBank">...</span>
                                </div>
                                <div class="col-span-2">
                                    <span class="block text-xs text-gray-500">No. Rekening & Atas Nama</span>
                                    <span class="font-medium text-gray-800" id="modalAccount">...</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-3 rounded border border-gray-100">
                            <span class="block text-xs text-gray-500 mb-1">Alasan Refund (dari Pelanggan)</span>
                            <p class="text-gray-700 italic border-l-2 border-amber-200 pl-2" id="modalReason">...</p>
                        </div>

                        <!-- Admin Processing Section -->
                        <div id="processingSection" class="pt-2 border-t border-gray-200 mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keputusan Admin</label>
                            <div class="flex gap-4 mb-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="approved"
                                        class="text-green-600 focus:ring-green-500" required>
                                    <span class="font-medium text-green-700">Setujui (Ubah pesanan jadi Refunded)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="rejected"
                                        class="text-red-600 focus:ring-red-500">
                                    <span class="font-medium text-red-700">Tolak Permintaan</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin (Opsional)</label>
                                <textarea name="admin_notes" id="modalAdminNotes" rows="2"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                    placeholder="Catatan internal atau alasan penolakan..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" id="submitBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-amber-800 text-base font-medium text-white hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Keputusan
                        </button>
                        <button type="button" onclick="closeRefundModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRefundModal(refund, order) {
            // Set Action URL securely with route helper
            const rawUrl = "{{ route('admin.refunds.process', ':id') }}";
            document.getElementById('refundProcessForm').action = rawUrl.replace(':id', refund.id);

            // Populate Data
            document.getElementById('modalOrderNumber').textContent = order.order_number;
            // Basic format, in real app better to ensure order object has formatted property available in JS
            document.getElementById('modalTotalAmount').textContent = 'Rp ' + Number(order.total_amount).toLocaleString('id-ID');
            document.getElementById('modalBank').textContent = refund.bank_name;
            document.getElementById('modalAccount').textContent = refund.account_number + ' a.n ' + refund.account_name;
            document.getElementById('modalReason').textContent = refund.reason;

            // Handle Status
            const processingSection = document.getElementById('processingSection');
            const submitBtn = document.getElementById('submitBtn');
            const radios = document.querySelectorAll('input[name="status"]');
            const notesInput = document.getElementById('modalAdminNotes');

            // Reset
            radios.forEach(r => r.checked = false);
            notesInput.value = refund.admin_notes || '';

            if (refund.status === 'pending') {
                processingSection.style.display = 'block';
                submitBtn.style.display = 'inline-flex';
            } else {
                // Already processed, hide controls but show notes
                processingSection.style.display = 'block';
                submitBtn.style.display = 'none';
                radios.forEach(r => {
                    if (r.value === refund.status) r.checked = true;
                    r.disabled = true;
                });
                notesInput.disabled = true;
            }

            document.getElementById('refundModal').classList.remove('hidden');
        }

        function closeRefundModal() {
            document.getElementById('refundModal').classList.add('hidden');
        }
    </script>
@endsection