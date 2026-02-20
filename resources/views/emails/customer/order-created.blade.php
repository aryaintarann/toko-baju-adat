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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
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
            <h2 style="margin: 0; color: #8B5A2B;">Pesanan Diterima</h2>
        </div>
        <div class="content">
            <p>Halo {{ $order->customer_name }},</p>
            <p>Terima kasih telah berbelanja di Toko Baju Adat Bali. Pesanan Anda dengan nomor
                <strong>{{ $order->order_number }}</strong> telah kami terima dan sedang <strong>menunggu
                    pembayaran</strong>.</p>

            <h3>Detail Pesanan:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2" style="text-align: right;">Ongkir ({{ strtoupper($order->courier) }} -
                            {{ $order->shipping_service }}):</th>
                        <td>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: right;">Total Bayar:</th>
                        <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>

            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('checkout.success', $order->id) }}" class="btn">Bayar Sekarang / Cek Status</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Toko Baju Adat Bali.
        </div>
    </div>
</body>

</html>