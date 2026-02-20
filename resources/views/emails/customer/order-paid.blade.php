<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            border-bottom: 2px solid #8B5A2B;
        }

        .content {
            padding: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }

        .success {
            color: #28a745;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8B5A2B;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0; color: #8B5A2B;">Pembayaran Berhasil</h2>
        </div>
        <div class="content">
            <p>Halo {{ $order->customer_name }},</p>
            <p>Kabar gembira! Pembayaran untuk pesanan <strong>{{ $order->order_number }}</strong> telah kami terima.
            </p>
            <p>Pesanan Anda saat ini sedang <span class="success">Diproses</span> dan akan segera kami siapkan untuk
                pengiriman.</p>

            <p style="margin-top: 20px;">Anda dapat melihat detail dan melacak status pesanan Anda melalui tombol di
                bawah ini:</p>
            <p style="text-align: center; margin-top: 20px;">
                <a href="{{ route('checkout.success', $order->id) }}" class="btn">Detail Pesanan</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Toko Baju Adat Bali.
        </div>
    </div>
</body>

</html>