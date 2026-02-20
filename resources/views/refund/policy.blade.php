@extends('layouts.app')

@section('title', 'Kebijakan Pengembalian Dana (Refund)')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-amber-800 text-white px-6 py-4">
                <h1 class="text-2xl font-bold">Kebijakan Pengembalian Dana (Refund)</h1>
            </div>

            <div class="p-6 md:p-8 text-gray-700 leading-relaxed">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg" role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <p class="mb-4">Terima kasih telah berbelanja di Toko Baju Adat Bali. Kepuasan Anda adalah prioritas kami.
                    Jika Anda mengalami kendala dengan pesanan Anda dan ingin mengajukan pengembalian dana (refund), mohon
                    baca ketentuan berikut dengan seksama.</p>

                <h2 class="text-xl font-semibold text-amber-900 mt-8 mb-3 border-b-2 border-amber-100 pb-2">1. Syarat
                    Pengajuan Refund</h2>
                <ul class="list-disc pl-5 mb-6 space-y-2">
                    <li>Refund <strong>hanya dapat diajukan dalam waktu 1x24 jam</strong> setelah pembayaran berhasil
                        dilakukan.</li>
                    <li>Status pesanan Anda harus masih dalam status <strong>"Diproses"</strong>. Jika pesanan sudah
                        berstatus "Dikirim" atau "Selesai", pengajuan refund tidak dapat diproses melalui sistem dan Anda
                        harus menghubungi layanan pelanggan kami.</li>
                    <li>Refund hanya akan disetujui untuk alasan yang sah (misal: stok kosong mendadak, kesalahan sistem,
                        barang cacat bawaan dari foto/bukti sebelum dikirim).</li>
                    <li>Setiap pesanan hanya dapat mengajukan refund sebanyak <strong>satu kali</strong>.</li>
                </ul>

                <h2 class="text-xl font-semibold text-amber-900 mt-8 mb-3 border-b-2 border-amber-100 pb-2">2. Proses
                    Pengajuan</h2>
                <ol class="list-decimal pl-5 mb-6 space-y-2">
                    <li>Isi formulir pengajuan refund melalui tombol di bawah halaman ini.</li>
                    <li>Pastikan memasukkan <strong>Nomor Pesanan</strong> dan <strong>Email</strong> yang digunakan saat
                        checkout dengan benar.</li>
                    <li>Jelaskan alasan pengajuan refund dengan detail.</li>
                    <li>Masukkan data rekening bank (Nama Bank, Nomor Rekening, Nama Pemilik Rekening) untuk tujuan
                        pengembalian dana. Kami tidak bertanggung jawab atas kesalahan transfer akibat salah input data
                        rekening.</li>
                </ol>

                <h2 class="text-xl font-semibold text-amber-900 mt-8 mb-3 border-b-2 border-amber-100 pb-2">3. Waktu Proses
                </h2>
                <p class="mb-6">Tim kami akan meninjau pengajuan Anda dalam waktu 1-2 hari kerja. Jika disetujui, dana akan
                    ditransfer ke rekening yang Anda berikan dalam waktu maksimal 3-5 hari kerja (tergantung kebijakan bank
                    masing-masing).</p>

                <div class="mt-10 text-center bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="mb-4 text-gray-600">Sudah membaca dan memahami syarat dan ketentuan di atas?</p>
                    <a href="{{ route('refund.create') }}"
                        class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-700 hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 ease-in-out shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        Isi Formulir Pengajuan Refund
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection