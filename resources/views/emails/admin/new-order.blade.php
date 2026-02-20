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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0; color: #8B5A2B;">Pesanan Baru #{{ $order->order_number }}</h2>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Ada pesanan baru yang baru saja masuk dengan rincian sebagai berikut:</p>

            <ul>
                <li><strong>Nama Pelanggan:</strong> {{ $order->customer_name }}</li>
                <li><strong>Email Pelanggan:</strong> {{ $order->customer_email }}</li>
                <li><strong>No Telepon:</strong> {{ $order->customer_phone }}</li>
                <li><strong>Total Pesanan:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</li>
            </ul>

            <h3>Item Pesanan:</h3>
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
                </tbody>
            </table>

            <p style="margin-top: 20px;">Silakan cek <a href="{{ url('/admin/orders/' . $order->id) }}">halaman
                    admin</a> untuk melihat detail lengkap.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Toko Baju Adat Bali.
        </div>
    </div>
</body>

</html>