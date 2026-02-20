@extends('layouts.app')

@section('title', 'Formulir Pengajuan Refund')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden relative">
            <!-- Decorative Header -->
            <div class="h-2 bg-gradient-to-r from-amber-600 via-amber-800 to-amber-900"></div>

            <div class="p-6 md:p-8">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 font-serif mb-2">Formulir Pengajuan Refund</h1>
                    <p class="text-gray-500">Silakan isi formulir di bawah ini dengan data yang sesuai dengan pesanan Anda.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" role="alert">
                        <p class="font-bold mb-1">Terjadi Kesalahan</p>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('refund.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-100 space-y-5">
                        <h3 class="font-semibold text-gray-700 border-b pb-2">Informasi Pesanan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="order_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Pesanan
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="order_number" id="order_number" value="{{ old('order_number') }}"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('order_number') border-red-500 @enderror"
                                    placeholder="Contoh: ORD-20240101-ABCDEF">
                                <p class="text-xs text-gray-500 mt-1">Dapat ditemukan di email invoice Anda.</p>
                            </div>
                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="customer_email" id="customer_email"
                                    value="{{ old('customer_email') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('customer_email') border-red-500 @enderror"
                                    placeholder="Email saat checkout">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Alasan Refund <span
                                class="text-red-500">*</span></label>
                        <textarea name="reason" id="reason" rows="4" required minlength="10"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('reason') border-red-500 @enderror"
                            placeholder="Jelaskan secara detail alasan Anda mengajukan refund (minimal 10 karakter)...">{{ old('reason') }}</textarea>
                    </div>

                    <div class="bg-amber-50 p-5 rounded-lg border border-amber-100 space-y-5">
                        <h3
                            class="font-semibold text-amber-900 border-b border-amber-200 pb-2 hover:text-amber-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Tujuan Pengembalian Dana
                        </h3>
                        <p class="text-sm text-amber-800/80 mb-3">Pastikan data rekening sudah benar. Kesalahan transfer
                            akibat salah input bukan tanggung jawab kami.</p>

                        <div class="space-y-4">
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank /
                                    E-Wallet <span class="text-red-500">*</span></label>
                                <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                    placeholder="Contoh: BCA, Mandiri, Dana, OVO">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        Rekening / No. HP<span class="text-red-500">*</span></label>
                                    <input type="text" name="account_number" id="account_number"
                                        value="{{ old('account_number') }}" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div>
                                    <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Pemilik Rekening <span class="text-red-500">*</span></label>
                                    <input type="text" name="account_name" id="account_name"
                                        value="{{ old('account_name') }}" required
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t">
                        <a href="{{ route('refund.policy') }}"
                            class="text-sm text-gray-500 hover:text-gray-800 hover:underline">
                            &larr; Kembali ke Kebijakan
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-amber-800 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                            Kirim Pengajuan
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection