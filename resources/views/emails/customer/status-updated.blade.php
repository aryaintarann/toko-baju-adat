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
            text-align: center;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }

        .status-box {
            background-color: #fce4ec;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            color: #8B5A2B;
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
            <h2 style="margin: 0; color: #8B5A2B;">Update Status Pesanan</h2>
        </div>
        <div class="content">
            <p>Halo {{ $order->customer_name }},</p>
            <p>Ada pembaruan untuk pesanan Anda <strong>{{ $order->order_number }}</strong>.</p>

            <p>Status pesanan Anda saat ini adalah:</p>
            <div class="status-box">
                {{ $order->status->label() }}
            </div>

            @if($order->status === \App\Enums\OrderStatus::Shipped)
                <p style="margin-top: 20px;">Pesanan Anda telah diserahkan ke kurir ({{ strtoupper($order->courier) }}).
                    Harap menunggu kedatangan paket Anda.</p>
            @endif

            <p style="margin-top: 30px;">
                <a href="{{ route('checkout.success', $order->id) }}" class="btn">Lihat Pesanan</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Toko Baju Adat Bali.
        </div>
    </div>
</body>

</html>