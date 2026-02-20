<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan Refund Diproses</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-w-2xl mx-auto p-4">
        <h2 style="color: #6b21a8;">Pembaruan Pengajuan Refund</h2>

        <p>Halo {{ $refund->order->customer_name }},</p>

        <p>Pengajuan refund Anda untuk pesanan <strong>{{ $refund->order->order_number }}</strong> telah ditinjau oleh
            tim kami.</p>

        <div
            style="margin: 20px 0; padding: 15px; border-radius: 5px; text-align: center; border: 2px solid {{ $refund->status === 'approved' ? '#16a34a' : '#dc2626' }}; background-color: {{ $refund->status === 'approved' ? '#f0fdf4' : '#fef2f2' }}; color: {{ $refund->status === 'approved' ? '#166534' : '#991b1b' }};">
            <h3 style="margin: 0; text-transform: uppercase;">
                STATUS: {{ $refund->status === 'approved' ? 'DISETUJUI' : 'DITOLAK' }}
            </h3>
        </div>

        @if($refund->status === 'approved')
            <p>Dana refund sedang dalam proses transfer ke rekening tujuan Anda:</p>
            <ul>
                <li><strong>Bank:</strong> {{ $refund->bank_name }}</li>
                <li><strong>No. Rekening:</strong> {{ $refund->account_number }}</li>
                <li><strong>Atas Nama:</strong> {{ $refund->account_name }}</li>
            </ul>
            <p>Estimasi dana masuk adalah 1-3 hari kerja.</p>
        @else
            <p>Mohon maaf, pengajuan refund Anda tidak dapat kami setujui.</p>
            @if($refund->admin_notes)
                <div style="background-color: #f9fafb; padding: 15px; border-left: 4px solid #f59e0b; margin-top: 15px;">
                    <p style="margin: 0;"><strong>Catatan dari Admin:</strong></p>
                    <p style="margin: 5px 0 0 0; font-style: italic;">{{ $refund->admin_notes }}</p>
                </div>
            @endif
        @endif

        <p style="margin-top: 30px;">
            Atas perhatiannya kami ucapkan terima kasih.
            <br>
            Tim Toko Baju Adat Bali
        </p>
    </div>
</body>

</html>