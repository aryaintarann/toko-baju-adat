<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan Refund Baru</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-w-2xl mx-auto p-4">
        <h2 style="color: #6b21a8;">Pengajuan Refund Baru</h2>

        <p>Halo Admin,</p>

        <p>Ada pengajuan refund baru dari pelanggan dengan detail berikut:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; width: 30%;">Nomor Pesanan</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $refund->order->order_number }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Tujuan Bank</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $refund->bank_name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">No. Rekening</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $refund->account_number }} a.n
                    {{ $refund->account_name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Alasan</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $refund->reason }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px;">
            Silakan cek panel admin untuk memproses pengajuan ini.
        </p>

        <a href="{{ route('admin.refunds.index') }}"
            style="display: inline-block; padding: 10px 20px; background-color: #6b21a8; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px;">Masuk
            ke Admin Panel</a>
    </div>
</body>

</html>